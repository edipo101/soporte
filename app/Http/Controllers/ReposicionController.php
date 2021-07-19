<?php

namespace SIS\Http\Controllers;

use Illuminate\Http\Request;

use SIS\Http\Requests;
use SIS\Http\Requests\ReposicionRequest;
use SIS\Http\Requests\ReposicionStoreRequest;

use SIS\Reposicion;
use SIS\Ticket;
use SIS\Unidad;
use SIS\Componente;
use SIS\Foto;

use Carbon\Carbon;
use App;
use Toastr;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use SIS\Funcionario;
use SIS\Http\Requests\CambioFechaRequest;

class ReposicionController extends Controller
{

    /**
     * 
    */
    public function apiReposicions($gestion)
    {
        if(auth()->user()->isRole('admin')){
            $reposicions = Reposicion::with('ticket')
            ->with('ticket.unidad')
            ->with('ticket.componente')
            ->with('ticket.user')
            ->where('gestion', $gestion) 
            ->get();
        }            
        elseif(auth()->user()->isRole('encargado')){
            $slug = slugTipoEncargado(auth()->user());
            $reposicions = Reposicion::
            whereHas('ticket.user.roles',function($query) use($slug){
                $query->where('slug', $slug );
            })
            ->with('ticket')
            ->with('ticket.unidad')
            ->with('ticket.componente')
            ->with('ticket.user')
            ->where('gestion', $gestion)
            ->get();
        }            
        elseif(auth()->user()->isRole('cambio-fecha')){
            $reposicions = Reposicion::with('ticket')
            ->with('ticket.unidad')
            ->with('ticket.componente')
            ->with('ticket.user')
            ->where('gestion',$gestion)->get();
        }            
        else{
            $reposicions = Reposicion::where('user_id',auth()->id())
            ->where('gestion', $gestion)
            ->with('ticket')
            ->with('ticket.unidad')
            ->with('ticket.componente')
            ->with('ticket.user')->get();
        }            
            
        return Datatables::of($reposicions)
                                ->addIndexColumn()
                                ->editColumn('ticket.nro_ticket', function($reposicion){
                                    //return $reposicion->ticket->gestion;
                                    return $reposicion->ticket->fullticket;
                                })
                                ->editColumn('fecha_informe', function($reposicion){
                                    return $reposicion->fecha_informe->format('d/m/Y');
                                })
                                ->editColumn('ticket.fecha_asignada', function($reposicion){
                                    return $reposicion->ticket->fecha_asignada->format('d/m/Y');
                                })
                                ->editColumn('ticket.solicitante', function($reposicion){
                                    return $reposicion->ticket->solicitante.'<br><strong>'.$reposicion->ticket->unidad->nombre.'</strong><br><small>Cel. Ref: '.$reposicion->ticket->celular_referencia.'</small>';
                                })
                                ->editColumn('ticket.user.nickname', function($reposicion){
                                    return '<span class="label label-success">'.$reposicion->user->nickname.'</span>';
                                })
                            ->addColumn('btn','reposicions.partials.acciones')
                            ->rawColumns(['btn','ticket.user.nickname','ticket.solicitante'])
                            ->toJson();
    }
    
    /**
     * 
    */
    public function index(Request $request)
    {
        $gestion = ($request->gestion!=null)?$request->gestion:Carbon::now()->year;
        return view('reposicions.index', compact('gestion'));
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
        return view('reposicions.create',compact('tickets','fecha', 'usuario','unidades','componentes'));
    }

    public function store(ReposicionStoreRequest $request)
    {
        if(Reposicion::withTrashed()->where('gestion',Carbon::now()->year)->get()->last()==null)
            $fullnumero = "1/".Carbon::now()->year;
        else{
            $reposicion = Reposicion::withTrashed()->where('gestion',Carbon::now()->year)->get()->last();
            $numero = explode("/",$reposicion->nro_informe);
            $ninforme = $numero[0] + 1 ;
            $fullnumero = $ninforme ."/". Carbon::now()->year;
        }
        $reposicion = new Reposicion();
        $reposicion->fill($request->all());
        $reposicion->fill([
            'nro_informe' => $fullnumero,
            'user_id' => auth()->id(),
            'gestion' => Carbon::now()->year,
            'fecha_informe' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $reposicion->save();
        // Subiendo el reporte de Fotografias
        if($request->file('photo') && $request->file('photo')[0]!=null){
            $archivos = $request->file('photo');
            $contador = 1;
            $nombre = explode("/",$reposicion->nro_informe);
            foreach ($archivos as $foto) {
                $extension = $foto->guessExtension();
                $carpeta = Carbon::now()->year.'/'.$nombre[0];
                $size = round($foto->getClientSize()/1024,2)."kB";
                $nombrefile = $contador. ".".$extension;
                Storage::disk('public')->put('fotos/reposicion/' .$carpeta.'/'.$nombrefile,\File::get($foto));
                $reposicion->fotos()->create([
                    'nombre' => $nombrefile,
                    'carpeta' => $carpeta,
                    'tamanio' => $size,
                    'tipo' => $extension,
                ]);
                $contador++;
            }   
        }
        // Cambiando el estado del ticket a Finalizado
        $ticket = Ticket::find($reposicion->ticket_id);
        $ticket->fill($request->all());
        $ticket->estado = 'F';
        $ticket->save();
        // Mandando un mensaje de confirmacion
        Toastr::success('Informe Tecnico de Reposicion guardado correctamente','Correcto!');
        return redirect()->route('reposicions.edit',$reposicion);
    }

    public function edit($id)
    {
        $reposicion = Reposicion::find($id);
        $ticket = Ticket::find($reposicion->ticket_id);
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $unidades = Unidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $componentes = Componente::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('reposicions.edit',compact('reposicion','ticket','fecha', 'usuario','unidades','componentes'));
    }

    public function update(ReposicionRequest $request, $id)
    {
        $reposicion = Reposicion::find($id);
        $reposicion->fill($request->all());
        $reposicion->fill([
            'gestion' => Carbon::now()->year,
        ]);
        $reposicion->save();
        // Verifica si se va a subir nuevas fotos al editar
        if($request->file('photo') && $request->file('photo')[0]!=null){
            $archivos = $request->file('photo');
            $ultimo = $reposicion->fotos()->get()->last();
            if($ultimo==null){
                $contador = 1;
            }
            else
            {
                $nombre = explode('.',$ultimo->nombre);
                $numero = $nombre[0];
                $contador = $numero + 1;
            }
            $nombre = explode("/",$reposicion->nro_informe);
            foreach ($archivos as $foto) {
                $extension = $foto->guessExtension();
                $carpeta = Carbon::now()->year.'/'.$nombre[0];
                $size = round($foto->getClientSize()/1024,2)."kB";
                $nombrefile = $contador. ".".$extension;
                Storage::disk('public')->put('fotos/reposicion/' .$carpeta.'/'.$nombrefile,\File::get($foto));
                $reposicion->fotos()->create([
                    'nombre' => $nombrefile,
                    'carpeta' => $carpeta,
                    'tamanio' => $size,
                    'tipo' => $extension,
                ]);
                $contador++;
            }   
        }
        // Cambia el estado del ticket a finalizado
        $ticket = Ticket::find($reposicion->ticket_id);
        $ticket->fill($request->all());
        $ticket->estado = 'F';
        $ticket->save();
        // Manda un mensaje de confirmacion
        Toastr::info('Informe Tecnico de Reposicion actualizado con exito','Correcto!');
        return redirect()->route('reposicions.edit',$reposicion);
    }

    public function destroy($id)
    {
        $reposicion = Reposicion::find($id);
        $ticket = Ticket::find($reposicion->ticket->id);
        $ticket->estado = 'A';
        $ticket->save();
        $reposicion->delete();
        
        return response()->json();
    }

    public function imprimir($id){
        $reposicion = Reposicion::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0,0,595.276,935.433]);
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('reposicions.imprimir.informe',compact('reposicion'));
        return $pdf->stream($reposicion->nro_informe.'.pdf');
    }

    public function apartir($id){
        $reposicion_apartir = Reposicion::find($id);
        if(auth()->user()->isRole('admin') || auth()->user()->isRole('encargado'))
            $tickets = Ticket::where('estado','A')->where('gestion',Carbon::now()->year)->orderBy('id','DESC')->get()->pluck('fullticket','id');
        else
            $tickets = Ticket::where('user_id',auth()->id())->where('estado','A')->where('gestion',Carbon::now()->year)->orderBy('id','DESC')->get()->pluck('fullticket','id');
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $unidades = Unidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $componentes = Componente::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('reposicions.apartir',compact('reposicion_apartir','tickets','fecha', 'usuario','unidades','componentes'));
    }

    public function cambiarFecha($id){
        $reposicion = Reposicion::find($id);
        $expeditos = ['CH'=>'CHUQUISACA','LP'=>'LA PAZ','PT'=>'POTOSI','OR'=>'ORURO','CB'=>'COCHABAMBA','TJ'=>'TARIJA','SC'=>'SANTA CRUZ','PD'=>'PANDO','BN'=>'BENI','EXT'=>'EXTRANJERO'];
        $usuario = auth()->user()->tecnico->fullnombre;

        // dd($reposicion);

        return view('reposicions.cambiarFecha',compact('reposicion','expeditos'));
    }

    public function storeCambiarFecha(CambioFechaRequest $request, $id){
        $funcionario = Funcionario::firstOrCreate(['carnet' => $request->carnet],['exp'=>$request->exp,'nombre'=>$request->nombre,'apellidos'=>$request->apellidos,'cargo'=>$request->cargo]);

        $reposicion = Reposicion::find($id);
        $reposicion->fill($request->all());
        $reposicion->fill([
            'fecha_informe' => $request->fecha_informe,
            'funcionario_id' => $funcionario->id,
            'userfecha' => auth()->id(),
            'fecha_solicitud' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $reposicion->save();

        // dd($request->all(),$funcionario->id,$id,$reposicion);
        
        Toastr::info('Fecha Modificado con exito','Modificado!');
        return redirect()->route('reposicions.index');
        
    }
}
