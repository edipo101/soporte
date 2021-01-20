<?php

namespace SIS\Http\Controllers;

use Illuminate\Http\Request;

use SIS\Http\Requests;
use SIS\Http\Requests\ReparacionRequest;

use SIS\Reparacion;
use SIS\Ticket;
use SIS\Unidad;
use SIS\Componente;

use Carbon\Carbon;
use App;
use SIS\Funcionario;
use SIS\Http\Requests\CambioFechaRequest;
use Toastr;
use Yajra\DataTables\DataTables;

class ReparacionController extends Controller
{
    
    public function apiReparacions()
    {
        if(auth()->user()->isRole('admin'))
            $reparacions = Reparacion::with('ticket')->with('ticket.unidad')->with('ticket.componente')->with('ticket.user')->get();
        elseif(auth()->user()->isRole('encargado'))
            $reparacions = Reparacion::with('ticket')->with('ticket.unidad')->with('ticket.componente')->with('ticket.user')->where('gestion',Carbon::now()->year)->get();
        elseif(auth()->user()->isRole('cambio-fecha'))
            $reparacions = Reparacion::with('ticket')->with('ticket.unidad')->with('ticket.componente')->with('ticket.user')->where('gestion',Carbon::now()->year)->get();
        else
            $reparacions = Reparacion::where('user_id',auth()->id())->where('gestion',Carbon::now()->year)->with('ticket')->with('ticket.unidad')->with('ticket.componente')->with('ticket.user')->get();
        return Datatables::of($reparacions)
                            ->addIndexColumn()
                            ->editColumn('ticket.nro_ticket', function($reparacion){
                                return $reparacion->ticket->fullticket;
                            })
                            ->editColumn('fecha_informe', function($reparacion){
                                return $reparacion->fecha_informe->format('d/m/Y');
                            })
                            ->editColumn('ticket.fecha_asignada', function($reparacion){
                                return $reparacion->ticket->fecha_asignada->format('d/m/Y');
                            })
                            ->editColumn('ticket.solicitante', function($reparacion){
                                return $reparacion->ticket->solicitante.'<br><strong>'.$reparacion->ticket->unidad->nombre.'</strong>';
                            })
                            ->editColumn('ticket.user.nickname', function($reparacion){
                                return '<span class="label label-success">'.$reparacion->user->nickname.'</span>';
                            })
                            ->addColumn('btn','reparacions.partials.acciones')
                            ->rawColumns(['btn','ticket.user.nickname','ticket.solicitante'])
                            ->toJson();
    }
    
    public function index()
    {
        return view('reparacions.index');
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
        return view('reparacions.create',compact('tickets','fecha', 'usuario','unidades','componentes'));
    }

    public function store(ReparacionRequest $request)
    {
        if(Reparacion::withTrashed()->where('gestion',Carbon::now()->year)->get()->last()==null)
            $fullnumero = "1/".Carbon::now()->year;
        else{
            $reparacion = Reparacion::withTrashed()->where('gestion',Carbon::now()->year)->get()->last();
            $numero = explode("/",$reparacion->nro_informe);
            $ninforme = $numero[0] + 1 ;
            $fullnumero = $ninforme ."/". Carbon::now()->year;
        }
        $reparacion = new Reparacion();
        $reparacion->fill($request->all());
        $reparacion->fill([
            'nro_informe' => $fullnumero,
            'user_id' => auth()->id(),
            'gestion' => Carbon::now()->year,
            'fecha_informe' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $reparacion->save();
        // Cambiando el estado del ticket a Finalizado
        $ticket = Ticket::find($reparacion->ticket_id);
        $ticket->fill($request->all());
        $ticket->estado = 'F';
        $ticket->save();
        // Mandando un mensaje de confirmacion
        Toastr::success('Informe Tecnico de Reparacion guardado correctamente','Correcto!');
        return redirect()->route('reparacions.edit',$reparacion);
    }

    public function edit($id)
    {
        $reparacion = Reparacion::find($id);
        $ticket = Ticket::find($reparacion->ticket_id);
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $unidades = Unidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $componentes = Componente::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('reparacions.edit',compact('reparacion','ticket','fecha', 'usuario','unidades','componentes'));
    }

    public function update(ReparacionRequest $request, $id)
    {
        $reparacion = Reparacion::find($id);
        $reparacion->fill($request->all());
        $reparacion->fill([
            'gestion' => Carbon::now()->year,
        ]);
        $reparacion->save();
        // Cambia el estado del ticket a finalizado
        $ticket = Ticket::find($reparacion->ticket_id);
        $ticket->fill($request->all());
        $ticket->estado = 'F';
        $ticket->save();
        // Manda un mensaje de confirmacion
        Toastr::info('Informe Tecnico de Reparacion actualizado con exito','Correcto!');
        return redirect()->route('reparacions.edit',$reparacion);
    }

    public function destroy($id)
    {
        $reparacion = Reparacion::find($id);
        $ticket = Ticket::find($reparacion->ticket->id);
        $ticket->estado = 'A';
        $ticket->save();
        $reparacion->delete();

        return response()->json();
    }

    public function imprimir($id){
        $reparacion = Reparacion::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0,0,595.276,935.433]);
        $pdf->loadView('reparacions.imprimir.informe',compact('reparacion'));
        return $pdf->stream($reparacion->nro_informe.'.pdf');
    }

    public function apartir($id){
        $reparacion_apartir = Reparacion::find($id);
        if(auth()->user()->isRole('admin') || auth()->user()->isRole('encargado'))
            $tickets = Ticket::where('estado','A')->where('gestion',Carbon::now()->year)->orderBy('id','DESC')->get()->pluck('fullticket','id');
        else
            $tickets = Ticket::where('user_id',auth()->id())->where('estado','A')->where('gestion',Carbon::now()->year)->orderBy('id','DESC')->get()->pluck('fullticket','id');
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $unidades = Unidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $componentes = Componente::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('reparacions.apartir',compact('reparacion_apartir','tickets','fecha', 'usuario','unidades','componentes'));
    }

    public function cambiarFecha($id){
        $reparacion = Reparacion::find($id);
        $expeditos = ['CH'=>'CHUQUISACA','LP'=>'LA PAZ','PT'=>'POTOSI','OR'=>'ORURO','CB'=>'COCHABAMBA','TJ'=>'TARIJA','SC'=>'SANTA CRUZ','PD'=>'PANDO','BN'=>'BENI','EXT'=>'EXTRANJERO'];
        $usuario = auth()->user()->tecnico->fullnombre;

        // dd($reparacion);

        return view('reparacions.cambiarFecha',compact('reparacion','expeditos'));
    }

    public function storeCambiarFecha(CambioFechaRequest $request, $id){
        $funcionario = Funcionario::firstOrCreate(['carnet' => $request->carnet],['exp'=>$request->exp,'nombre'=>$request->nombre,'apellidos'=>$request->apellidos,'cargo'=>$request->cargo]);

        $reparacion = Reparacion::find($id);
        $reparacion->fill($request->all());
        $reparacion->fill([
            'fecha_informe' => $request->fecha_informe,
            'funcionario_id' => $funcionario->id,
            'userfecha' => auth()->id(),
            'fecha_solicitud' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $reparacion->save();

        // dd($request->all(),$funcionario->id,$id,$reparacion);
        
        Toastr::info('Fecha Modificado con exito','Modificado!');
        return redirect()->route('reparacions.index');
        
    }
}
