<?php

namespace SIS\Http\Controllers;

use Illuminate\Http\Request;
use SIS\Http\Requests\GenerarRequest;
use SIS\Ticket;
use SIS\Baja;
use SIS\Reparacion;
use SIS\Recepcion;
use SIS\Reposicion;
use SIS\Externo;

use SIS\Componente;
use SIS\Diagnostico;
use SIS\Unidad;
use Carbon\Carbon;
use App;

class HomeController extends Controller
{
    public function index()
    {
        if(auth()->user()->isRole('admin')){
            $bajas = Baja::all()->count();
            $reparacions = Reparacion::all()->count();
            $reposicions = Reposicion::all()->count();
            $recepcions = Recepcion::all()->count();
            $externos = Externo::all()->count();

            $tkrecepcion = Ticket::where('estado','R')->get()->count();
            $tkasignacion = Ticket::where('estado','A')->get()->count();
            $tkfinalizado = Ticket::where('estado','F')->get()->count();
        }
        elseif(auth()->user()->isRole('encargado')){
            $bajas = Baja::where('gestion',Carbon::now()->year)->get()->count();
            $reparacions = Reparacion::where('gestion',Carbon::now()->year)->get()->count();
            $reposicions = Reposicion::where('gestion',Carbon::now()->year)->get()->count();
            $recepcions = Recepcion::where('gestion',Carbon::now()->year)->get()->count();
            $externos = Externo::all()->count();

            $tkrecepcion = Ticket::where('estado','R')->where('gestion',Carbon::now()->year)->get()->count();
            $tkasignacion = Ticket::where('estado','A')->where('gestion',Carbon::now()->year)->get()->count();
            $tkfinalizado = Ticket::where('estado','F')->where('gestion',Carbon::now()->year)->get()->count();
        }
        else{
            $bajas = Baja::where('user_id',auth()->id())->where('gestion',Carbon::now()->year)->get()->count();
            $reparacions = Reparacion::where('user_id',auth()->id())->where('gestion',Carbon::now()->year)->get()->count();
            $reposicions = Reposicion::where('user_id',auth()->id())->where('gestion',Carbon::now()->year)->get()->count();
            $recepcions = Recepcion::where('user_id',auth()->id())->where('gestion',Carbon::now()->year)->get()->count();
            $externos = Externo::where('user_id',auth()->id())->get()->count();

            $tkrecepcion = Ticket::where('user_id',auth()->id())->where('estado','R')->where('gestion',Carbon::now()->year)->get()->count();
            $tkasignacion = Ticket::where('user_id',auth()->id())->where('estado','A')->where('gestion',Carbon::now()->year)->get()->count();
            $tkfinalizado = Ticket::where('user_id',auth()->id())->where('estado','F')->where('gestion',Carbon::now()->year)->get()->count();
        }

        return view('home',compact('tkrecepcion','tkasignacion','tkfinalizado','bajas','reparacions','reposicions','recepcions','externos'));
    }

    public function invitado(){
        return view('invitado.index');
    }

    public function generarticket($tipo)
    {
        $tip = $tipo;
        $componentes = Componente::all();
        $diagnosticos = Diagnostico::all();
        if(Ticket::withTrashed()->get()->last()==null)
            $nticket = 1;
        else{
            $ticket = Ticket::withTrashed()->get()->last();
            $nticket = $ticket->nro_ticket + 1;
        }
        return view('invitado.generar',compact('componentes','diagnosticos','nticket','tip'));
    }

    public function storeticket(GenerarRequest $request)
    {
        // dd($request->all());
        $unidad = Unidad::firstOrCreate(['nombre' => $request->unidad]);
        
        $ticket = new Ticket();
        $ticket->fill($request->all());
        $ticket->fill([
            'nro_ticket'=>$request->nticket,
            'gestion' => Carbon::now()->year,
            'user_id' => '13',
            'estado'=> 'R',
            'unidad_id' => $unidad->id,
        ]);
        $ticket->save();
        //Guardar los diagnosticos ticket
        $ticket->diagnosticos()->attach($request->diagnosticos);
        return redirect()->route('home.ticket',$ticket->id);
    }

    public function ticket($id)
    {
        $ticket = Ticket::find($id);
        return view('invitado.ticket',compact('ticket'));
    }

    public function imprimirticket($id)
    {
        $ticket = Ticket::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('invitado.imprimir.imprimir-ticket',compact('ticket'));
        return $pdf->stream($ticket->id.'.pdf',array("Attachment"=>false));
    }
}
