<?php

namespace SIS\Http\Controllers;

use Illuminate\Http\Request;

use SIS\Http\Requests;
use SIS\Http\Requests\BajaRequest;

use SIS\Baja;
use SIS\Ticket;
use SIS\Unidad;
use SIS\Componente;

use Carbon\Carbon;
use App;
use SIS\Funcionario;
use SIS\Http\Requests\CambioFechaRequest;
use Toastr;
use Yajra\DataTables\DataTables;

class BajaController extends Controller
{
    
    public function apiBajas($gestion)
    {
        if(auth()->user()->isRole('admin')){
            $bajas = Baja::with('ticket')->with('ticket.unidad')
            ->with('ticket.componente')->with('ticket.user')->get();
        }            
        elseif(auth()->user()->isRole('encargado')){
            $slug = slugTipoEncargado(auth()->user());
            $bajas = Baja::
            whereHas('ticket.user.roles',function($query) use($slug){
                $query->where('slug', $slug );
            })
            ->with('ticket')
            ->with('ticket.unidad')
            ->with('ticket.componente')
            ->with('ticket.user')
            ->where('gestion', $gestion )
            ->get();
        }            
        elseif(auth()->user()->isRole('cambio-fecha')){
            $bajas = Baja::with('ticket')->with('ticket.unidad')
            ->with('ticket.componente')->with('ticket.user')
            ->where('gestion', $gestion )->get();
        }            
        else{
            $bajas = Baja::where('user_id',auth()->id())
            ->with('ticket')->with('ticket.unidad')
            ->with('ticket.componente')->with('ticket.user')
            ->where('gestion', $gestion )->get();
        }            
        return Datatables::of($bajas)
                            ->addIndexColumn()
                            ->editColumn('ticket.nro_ticket', function($baja){
                                return $baja->ticket->fullticket;
                            })
                            ->editColumn('fecha_informe', function($baja){
                                return $baja->fecha_informe->format('d/m/Y');
                            })
                            ->editColumn('ticket.fecha_asignada', function($baja){
                                return $baja->ticket->fecha_asignada->format('d/m/Y');
                            })
                            ->editColumn('ticket.solicitante', function($baja){
                                return $baja->ticket->solicitante.'<br><strong>'.$baja->ticket->unidad->nombre.'</strong><br><small>Cel. Ref: '.$baja->ticket->celular_referencia.'</small>';
                            })
                            ->editColumn('ticket.user.nickname', function($baja){
                                return '<span class="label label-success">'.$baja->user->nickname.'</span>';
                            })
                            ->addColumn('btn','bajas.partials.acciones')
                            ->rawColumns(['btn','ticket.user.nickname','ticket.solicitante'])
                            ->toJson();
    }
    
    public function index(Request $request)
    {
        $gestion = ($request->gestion!=null)?$request->gestion:2021;
        return view('bajas.index', compact('gestion'));
    }

    public function create()
    {
        if(auth()->user()->isRole('admin') || auth()->user()->isRole('encargado'))
            $tickets = Ticket::where('estado','A')->where('gestion',Carbon::now()->year)->orderBy('id','DESC')->get()->pluck('fullticket','id');
        else
            $tickets = Ticket::where('user_id',auth()->id())->where('estado','A')->where('gestion',Carbon::now()->year)->orderBy('id','DESC')->get()->pluck('fullticket','id');
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $unidades = Unidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $componentes = Componente::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('bajas.create',compact('tickets','fecha', 'usuario','unidades','componentes'));
    }

    public function store(BajaRequest $request)
    {
        if(Baja::withTrashed()->where('gestion',Carbon::now()->year)->get()->last()==null)
            $fullnumero = "1/".Carbon::now()->year;
        else{
            $baja = Baja::withTrashed()->where('gestion',Carbon::now()->year)->get()->last();
            $numero = explode("/",$baja->nro_informe);
            $ninforme = $numero[0] + 1 ;
            $fullnumero = $ninforme ."/". Carbon::now()->year;
        }
        $baja = new Baja();
        $baja->fill($request->all());
        $baja->fill([
            'nro_informe' => $fullnumero,
            'user_id' => auth()->id(),
            'gestion' => Carbon::now()->year,
            'fecha_informe' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $baja->save();
        // Cambiando el estado del ticket a Finalizado
        $ticket = Ticket::find($baja->ticket_id);
        $ticket->fill($request->all());
        $ticket->estado = 'F';
        $ticket->save();
        // Mandando un mensaje de confirmacion
        Toastr::success('Informe Tecnico de Baja guardado correctamente','Correcto!');
        return redirect()->route('bajas.edit',$baja);
    }

    public function edit($id)
    {
        $baja = Baja::find($id);
        $ticket = Ticket::find($baja->ticket_id);
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $unidades = Unidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $componentes = Componente::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('bajas.edit',compact('baja','ticket','fecha', 'usuario','unidades','componentes'));
    }

    public function update(BajaRequest $request, $id)
    {
        $baja = Baja::find($id);
        $baja->fill($request->all());
        $baja->fill([
            'gestion' => Carbon::now()->year,
        ]);
        $baja->save();
        // Cambia el estado del ticket a finalizado
        $ticket = Ticket::find($baja->ticket_id);
        $ticket->fill($request->all());
        $ticket->estado = 'F';
        $ticket->save();
        // Manda un mensaje de confirmacion
        Toastr::info('Informe Tecnico de Baja actualizado con exito','Correcto!');
        return redirect()->route('bajas.edit',$baja);
    }

    public function destroy($id)
    {
        $baja = Baja::find($id);
        $ticket = Ticket::find($baja->ticket->id);
        $ticket->estado = 'A';
        $ticket->save();
        $baja->delete();

        return response()->json();
    }

    public function imprimir($id){
        $baja = Baja::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0,0,595.276,935.433]);
        $pdf->loadView('bajas.imprimir.informe',compact('baja'));
        return $pdf->stream($baja->nro_informe.'.pdf');
    }

    public function apartir($id){
        $baja_apartir = Baja::find($id);
        if(auth()->user()->isRole('admin') || auth()->user()->isRole('encargado'))
            $tickets = Ticket::where('estado','A')->where('gestion',Carbon::now()->year)->orderBy('id','DESC')->get()->pluck('fullticket','id');
        else
            $tickets = Ticket::where('user_id',auth()->id())->where('estado','A')->where('gestion',Carbon::now()->year)->orderBy('id','DESC')->get()->pluck('fullticket','id');
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $unidades = Unidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $componentes = Componente::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('bajas.apartir',compact('baja_apartir','tickets','fecha', 'usuario','unidades','componentes'));
    }

    public function cambiarFecha($id){
        $baja = Baja::find($id);
        $expeditos = ['CH'=>'CHUQUISACA','LP'=>'LA PAZ','PT'=>'POTOSI','OR'=>'ORURO','CB'=>'COCHABAMBA','TJ'=>'TARIJA','SC'=>'SANTA CRUZ','PD'=>'PANDO','BN'=>'BENI','EXT'=>'EXTRANJERO'];
        $usuario = auth()->user()->tecnico->fullnombre;

        // dd($baja);

        return view('bajas.cambiarFecha',compact('baja','expeditos'));
    }

    public function storeCambiarFecha(CambioFechaRequest $request, $id){
        $funcionario = Funcionario::firstOrCreate(['carnet' => $request->carnet],['exp'=>$request->exp,'nombre'=>$request->nombre,'apellidos'=>$request->apellidos,'cargo'=>$request->cargo]);

        $baja = Baja::find($id);
        $baja->fill($request->all());
        $baja->fill([
            'fecha_informe' => $request->fecha_informe,
            'funcionario_id' => $funcionario->id,
            'userfecha' => auth()->id(),
            'fecha_solicitud' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $baja->save();

        // dd($request->all(),$funcionario->id,$id,$baja);
        
        Toastr::info('Fecha Modificado con exito','Modificado!');
        return redirect()->route('bajas.index');
        
    }
}
