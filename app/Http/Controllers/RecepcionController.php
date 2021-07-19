<?php

namespace SIS\Http\Controllers;

use Illuminate\Http\Request;

use SIS\Http\Requests;
use SIS\Http\Requests\RecepcionRequest;
use SIS\Http\Requests\RecepcionStoreRequest;

use SIS\Recepcion;
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

class RecepcionController extends Controller
{
    
    public function apiRecepcions($gestion)
    {
        if(auth()->user()->isRole('admin')){
            $recepcions = Recepcion::with('ticket')
            ->with('ticket.unidad')
            ->with('ticket.componente')
            ->with('ticket.user')            
            ->where('gestion', $gestion)
            ->orderBy('recepcions.id','desc');
        }            
        elseif(auth()->user()->isRole('encargado')){
            $slug = slugTipoEncargado(auth()->user());
            $recepcions = Recepcion::
                whereHas('ticket.user.roles',function($query) use($slug){
                    $query->where('slug', $slug );
                    //->orWhere('slug','guest');
                })
                ->with('ticket')
                ->with('ticket.unidad')
                ->with('ticket.componente')
                ->with('ticket.user')
                ->where('gestion', $gestion)
                ->orderBy('recepcions.id','desc');
        }            
        elseif(auth()->user()->isRole('cambio-fecha')){
            $recepcions = Recepcion::with('ticket')
            ->with('ticket.unidad')
            ->with('ticket.componente')
            ->with('ticket.user')
            ->where('gestion', $gestion) 
            ->orderBy('recepcions.id','desc');
        }            
        else{
            $recepcions = Recepcion::where('user_id',auth()->id())
            ->where('gestion', $gestion)
            ->with('ticket')->with('ticket.unidad')
            ->with('ticket.componente')
            ->with('ticket.user')                        
            ->orderBy('recepcions.id','desc');
        }            
        // return Datatables::of($recepcions)
        return datatables() 
                    ->eloquent($recepcions)
                    ->addIndexColumn()
                    ->editColumn('ticket.nro_ticket', function($recepcion){
                        return $recepcion->ticket->fullticket;
                    })
                    ->editColumn('fecha_informe', function($recepcion){
                        return $recepcion->fecha_informe->format('d/m/Y');
                    })
                    ->editColumn('ticket.fecha_asignada', function($recepcion){
                        return $recepcion->ticket->fecha_asignada->format('d/m/Y');
                    })
                    ->editColumn('ticket.solicitante', function($recepcion){
                        return $recepcion->ticket->solicitante.'<br><strong>'.$recepcion->ticket->unidad->nombre.'</strong><br><small>Cel. Ref: '.$recepcion->ticket->celular_referencia.'</small>';
                    })
                    ->editColumn('ticket.user.nickname', function($recepcion){
                        return '<span class="label label-success">'.$recepcion->user->nickname.'</span>';
                    })
                    ->addColumn('btn','recepcions.partials.acciones')
                    ->rawColumns(['btn','ticket.user.nickname','ticket.solicitante'])
                    ->toJson();
    }
    
    /**
     * 
    */
    public function index(Request $request)
    {
        $gestion = ($request->gestion!=null)?$request->gestion:Carbon::now()->year;
        return view('recepcions.index', compact('gestion') );
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
        return view('recepcions.create',compact('tickets','fecha', 'usuario','unidades','componentes'));
    }

    public function store(RecepcionStoreRequest $request)
    {
        if(Recepcion::withTrashed()->where('gestion',Carbon::now()->year)->get()->last()==null)
            $fullnumero = "1/".Carbon::now()->year;
        else{
            $recepcion = Recepcion::withTrashed()->where('gestion',Carbon::now()->year)->get()->last();
            $numero = explode("/",$recepcion->nro_informe);
            $ninforme = $numero[0] + 1 ;
            $fullnumero = $ninforme ."/". Carbon::now()->year;
        }
        $recepcion = new Recepcion();
        $recepcion->fill($request->all());
        $recepcion->fill([
            'nro_informe' => $fullnumero,
            'user_id' => auth()->id(),
            'gestion' => Carbon::now()->year,
            'fecha_informe' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $recepcion->save();
        // Subiendo el reporte de Fotografias
        if($request->file('photo') && $request->file('photo')[0]!=null){
            $archivos = $request->file('photo');
            $contador = 1;
            $nombre = explode("/",$recepcion->nro_informe);
            foreach ($archivos as $foto) {
                $extension = $foto->guessExtension();
                $carpeta = Carbon::now()->year.'/'.$nombre[0];
                $size = round($foto->getClientSize()/1024,2)."kB";
                $nombrefile = $contador. ".".$extension;
                Storage::disk('public')->put('fotos/recepcion/' .$carpeta.'/'.$nombrefile,\File::get($foto));
                $recepcion->fotos()->create([
                    'nombre' => $nombrefile,
                    'carpeta' => $carpeta,
                    'tamanio' => $size,
                    'tipo' => $extension,
                ]);
                $contador++;
            }   
        }
        // Cambiando el estado del ticket a Finalizado
        $ticket = Ticket::find($recepcion->ticket_id);
        $ticket->fill($request->all());
        $ticket->estado = 'F';
        $ticket->save();
        // Mandando un mensaje de confirmacion
        Toastr::success('Informe Tecnico de Recepcion guardado correctamente','Correcto!');
        return redirect()->route('recepcions.edit',$recepcion);
    }

    public function edit($id)
    {
        $recepcion = Recepcion::find($id);
        $ticket = Ticket::find($recepcion->ticket_id);
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $unidades = Unidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $componentes = Componente::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('recepcions.edit',compact('recepcion','ticket','fecha', 'usuario','unidades','componentes'));
    }

    public function update(RecepcionRequest $request, $id)
    {
        $recepcion = Recepcion::find($id);
        $recepcion->fill($request->all());
        $recepcion->fill([
            'gestion' => Carbon::now()->year,
        ]);
        $recepcion->save();
        // Verifica si se va a subir nuevas fotos al editar
        if($request->file('photo') && $request->file('photo')[0]!=null){
            $archivos = $request->file('photo');
            $ultimo = $recepcion->fotos()->get()->last();
            if($ultimo==null){
                $contador = 1;
            }
            else
            {
                $nombre = explode('.',$ultimo->nombre);
                $numero = $nombre[0];
                $contador = $numero + 1;
            }
            $nombre = explode("/",$recepcion->nro_informe);
            foreach ($archivos as $foto) {
                $extension = $foto->guessExtension();
                $carpeta = Carbon::now()->year.'/'.$nombre[0];
                $size = round($foto->getClientSize()/1024,2)."kB";
                $nombrefile = $contador. ".".$extension;
                Storage::disk('public')->put('fotos/recepcion/' .$carpeta.'/'.$nombrefile,\File::get($foto));
                $recepcion->fotos()->create([
                    'nombre' => $nombrefile,
                    'carpeta' => $carpeta,
                    'tamanio' => $size,
                    'tipo' => $extension,
                ]);
                $contador++;
            }   
        }
        // Cambia el estado del ticket a finalizado
        $ticket = Ticket::find($recepcion->ticket_id);
        $ticket->fill($request->all());
        $ticket->estado = 'F';
        $ticket->save();
        // Manda un mensaje de confirmacion
        Toastr::info('Informe Tecnico de Recepcion actualizado con exito','Correcto!');
        return redirect()->route('recepcions.edit',$recepcion);
    }

    public function destroy($id)
    {
        $recepcion = Recepcion::find($id);
        $ticket = Ticket::find($recepcion->ticket->id);
        $ticket->estado = 'A';
        $ticket->save();
        $recepcion->delete();

        return response()->json();
    }

    /**
     * 
    */
    public function imprimir($id){
        $recepcion = Recepcion::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0,0,595.276,935.433]);
        $pdf->loadView('recepcions.imprimir.informe',compact('recepcion'));
        return $pdf->stream($recepcion->nro_informe.'.pdf');
    }

    public function apartir($id){
        $recepcion_apartir = Recepcion::find($id);
        if(auth()->user()->isRole('admin') || auth()->user()->isRole('encargado'))
            $tickets = Ticket::where('estado','A')->where('gestion',Carbon::now()->year)->orderBy('id','DESC')->get()->pluck('fullticket','id');
        else
            $tickets = Ticket::where('user_id',auth()->id())->where('estado','A')->where('gestion',Carbon::now()->year)->orderBy('id','DESC')->get()->pluck('fullticket','id');
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $unidades = Unidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $componentes = Componente::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('recepcions.apartir',compact('recepcion_apartir','tickets','fecha', 'usuario','unidades','componentes'));
    }

    public function cambiarFecha($id){
        $recepcion = Recepcion::find($id);
        $expeditos = ['CH'=>'CHUQUISACA','LP'=>'LA PAZ','PT'=>'POTOSI','OR'=>'ORURO','CB'=>'COCHABAMBA','TJ'=>'TARIJA','SC'=>'SANTA CRUZ','PD'=>'PANDO','BN'=>'BENI','EXT'=>'EXTRANJERO'];
        $usuario = auth()->user()->tecnico->fullnombre;

        // dd($recepcion);

        return view('recepcions.cambiarFecha',compact('recepcion','expeditos'));
    }

    public function storeCambiarFecha(CambioFechaRequest $request, $id){
        $funcionario = Funcionario::firstOrCreate(['carnet' => $request->carnet],['exp'=>$request->exp,'nombre'=>$request->nombre,'apellidos'=>$request->apellidos,'cargo'=>$request->cargo]);

        $recepcion = Recepcion::find($id);
        $recepcion->fill($request->all());
        $recepcion->fill([
            'fecha_informe' => $request->fecha_informe,
            'funcionario_id' => $funcionario->id,
            'userfecha' => auth()->id(),
            'fecha_solicitud' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $recepcion->save();

        // dd($request->all(),$funcionario->id,$id,$recepcion);
        
        Toastr::info('Fecha Modificado con exito','Modificado!');
        return redirect()->route('recepcions.index');
        
    }
}
