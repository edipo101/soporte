<?php

namespace SIS\Http\Controllers;

use SIS\Ticket;
use SIS\Diagnostico;
use SIS\Unidad;
use SIS\Componente;
use SIS\User;
use SIS\Tecnico;
use Illuminate\Http\Request;

use Toastr;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App;

class TicketController extends Controller
{

    public function apiTickets($tipo)
    {
        if(auth()->user()->isRole('admin'))
            $tickets = Ticket::with('unidad')->with('componente')->with('user')->where('estado',$tipo)->get();
        elseif(auth()->user()->isRole('encargado'))
            $tickets = Ticket::with('unidad')->with('componente')->with('user')->where('estado',$tipo)->where('gestion',Carbon::now()->year)->get();
        else
            $tickets = Ticket::with('unidad')->with('componente')->with('user')->where('user_id',auth()->id())->where('estado',$tipo)->where('gestion',Carbon::now()->year)->get();
        return Datatables::of($tickets)
                            ->addIndexColumn()
                            ->editColumn('nro_ticket', function($ticket){
                                return $ticket->nro_ticket."/" .$ticket->gestion;
                            })
                            ->editColumn('created_at', function($ticket){
                                return $ticket->created_at->format('d/m/Y H:i:s');
                            })
                            ->editColumn('fecha_asignada', function($ticket){
                                return $ticket->fecha_asignada == null ? "Sin Asignar" : $ticket->fecha_asignada->format('d/m/Y H:i:s');
                            })
                            ->editColumn('fecha_entrega', function($ticket){
                                return $ticket->fecha_entrega == null ? "Sin Asignar" : $ticket->fecha_entrega->format('d/m/Y H:i:s');
                            })
                            ->editColumn('solicitante', function($ticket){
                                return $ticket->solicitante==""? $ticket->empresa.'<br><strong>'.$ticket->unidad->nombre.'</strong>' : $ticket->solicitante.'<br><strong>'.$ticket->unidad->nombre.'</strong>';
                            })
                            ->editColumn('celular_referencia', function($ticket){
                                $telefono = $ticket->telef_referencia==""? "S/N": $ticket->telef_referencia;
                                $celular = $ticket->celular_referencia==""? "S/N": $ticket->celular_referencia;
                                return $telefono ."<br>". $celular;
                            })
                            ->editColumn('observacion', function($ticket){
                                return $ticket->observacion==""? "SIN OBSERVACION": str_limit($ticket->observacion,35);
                            })
                            ->editColumn('user.nickname', function($ticket){
                                return '<strong>'. $ticket->nombreestado .'</strong><br><span class="label bg-lg bg-black">'. $ticket->user->nickname.'</span>';
                            })
                            ->addColumn('btn','tickets.partials.acciones')
                            ->rawColumns(['btn','celular_referencia','user.nickname','solicitante'])
                            ->toJson();
    }

    public function index($estado)
    {
        switch ($estado) {
            case 'recepcionados':
                $tipo = 'R';
                break;
            case 'asignados':
                $tipo = 'A';
                break;
            case 'finalizados':
                $tipo = 'F';
                break;
        }
        return view('tickets.index',compact('estado','tipo'));
    }

    public function create($tipo)
    {
        // $tip = $tipo;
        if(Ticket::withTrashed()->where('gestion',Carbon::now()->year)->get()->last()==null)
            $nticket = 1;
        else{
            $ticket = Ticket::withTrashed()->where('gestion',Carbon::now()->year)->get()->last();
            $nticket = $ticket->nro_ticket + 1;
        }
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $diagnosticos = Diagnostico::where('estado','A')->orderBy('id','ASC')->get();
        return view('tickets.create', compact('diagnosticos','fecha','usuario','nticket','tipo'));
    }

    public function store(Request $request)
    {
        //Verifica si existe la unidad si no lo crea
        $unidad = Unidad::firstOrCreate(['nombre' => $request->unidad]);
        //Verifica si extiste el componente si no lo crea
        $componente = Componente::firstOrCreate(['nombre' => $request->componente]);
        // Crear un nuevo Ticket
        $ticket = new Ticket();
        $ticket->fill($request->all());
        $ticket->fill([
            'gestion' => Carbon::now()->year,
            'user_id' => \Auth::user()->id,
            'estado'=> 'R',
            'unidad_id' => $unidad->id,
            'componente_id' => $componente->id,
        ]);
        $ticket->save();
        // Guardar los diagnosticos ticket
        $ticket->diagnosticos()->attach($request->diagnosticos);

        Toastr::success('Ticket creado con exito','Correcto!');
        return redirect()->route('tickets.index','recepcionados');
        
    }

    public function edit(Ticket $ticket)
    {
        if($ticket->solicitante=="")
            $tipo="empresa";
        else
            $tipo="gams";
        $nticket = $ticket->nro_ticket;
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = $ticket->user->tecnico->fullnombre;
        $diagnosticos = Diagnostico::where('estado','A')->orderBy('nombre','ASC')->get();
        return view('tickets.edit',compact('ticket','diagnosticos','nticket','fecha','usuario','tipo'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        //Verifica si existe la unidad si no lo crea
        $unidad = Unidad::firstOrCreate(['nombre' => $request->unidad]);
        //Verifica si extiste el componente si no lo crea
        $componente = Componente::firstOrCreate(['nombre' => $request->componente]);
        // Editar el ticket
        $ticket->fill($request->all());
        $ticket->fill([
            'unidad_id' => $unidad->id,
            'componente_id' => $componente->id,
        ]);
        $ticket->save();
        //Guardar los diagnosticos ticket
        $ticket->diagnosticos()->sync($request->diagnosticos);

        Toastr::info('Ticket actualizado con exito','Actualizado!');
        return redirect()->route('tickets.index','recepcionados');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        
        return response()->json();
    }

    public function imprimir(Ticket $ticket)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('letter');
        $pdf->loadView('tickets.imprimir.volante',compact('ticket'));
        return $pdf->stream($ticket->id.'-'.$ticket->gestion.'.pdf');
    }

    public function asignar(Ticket $ticket)
    {
        if(auth()->user()->isRole('externos'))
        {
            $ticket->user_id = auth()->id();
            $ticket->prioridad = 'normal';
            $ticket->fecha_asignada = Carbon::now();
            $hora = '18:30:00';
            $fecha = date('Y-m-d', strtotime(Carbon::now()->addWeekdays(3)->format('d-m-Y')));
            $fechahora = str_finish($fecha,' '.$hora);
            $ticket->fecha_entrega = $fechahora;
            $ticket->estado = "A";
            $ticket->save();
            return redirect()->route('tickets.index','asignados');
        }
        else{
            $soporte = User::whereHas('roles',function($query){
                $query->where('slug','tecnico');
            })->get();
            $tecnicos = Tecnico::orderBy('nombre','ASC')->get();
            $fechasugerida = Carbon::now()->addWeekdays(3)->format('d-m-Y');
            return view('tickets.asignar', compact('ticket','tecnicos','soporte','fechasugerida'));
        }
    }
    public function storeasignar(Request $request, Ticket $ticket){
        $user = User::where('tecnico_id',$request->tecnico_id)->first();
        $ticket->user_id = $user->id;
        $ticket->prioridad = $request->prioridad;
        $ticket->fecha_asignada = Carbon::now();
        $hora = '18:30:00';
        $fecha = date('Y-m-d', strtotime($request->fecha_entrega));
        $fechahora = str_finish($fecha,' '.$hora);
        $ticket->fecha_entrega = $fechahora;
        $ticket->estado = "A";
        $ticket->save();
        Toastr::info('Ticket se asigno correctamente','Actualizado!');
        return redirect()->route('tickets.index','asignados');
    }

    public function informe(Request $request, Ticket $ticket)
    {
        $tipoinforme = $request->tipoinforme;
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $unidades = Unidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $componentes = Componente::orderBy('nombre','ASC')->pluck('nombre','id');
        switch ($tipoinforme) {
            case 'baja':
                return view('bajas.create',compact('ticket','fecha', 'usuario','unidades','componentes'));
                break;
            case 'reparacion':
                return view('reparacions.create',compact('ticket','fecha', 'usuario','unidades','componentes'));
                break;
            case 'recepcion':
                return view('recepcions.create',compact('ticket','fecha', 'usuario','unidades','componentes'));
                break;
            case 'reposicion':
                return view('reposicions.create',compact('ticket','fecha', 'usuario','unidades','componentes'));
                break;
        }
    }

}
