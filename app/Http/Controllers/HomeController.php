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
use SIS\User;
use Carbon\Carbon;
use App;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $encargados=null;
        $personal=null;
        $chartjs=null;

        if(auth()->user()->isRole('admin')){
            $ids = idsTecnicos();//helpers            
            $ides = idsEncargados();//helpers
            
            $personal = User::with('tecnico')            
            ->WhereIn('id',$ids)
            ->where('id','!=', auth()->user()->id )//se exceptua al encargado
            ->orderBy('nickname','ASC')
            ->get();   

            $encargados = User::with('tecnico')
            ->WhereIn('id',$ides)            
            ->orderBy('nickname','ASC')
            ->get();   
            
            $pp = array();
            foreach($personal as $p){
                if(tiene_acceso($p)){
                    array_push($pp, $p);
                }
            }     
            $chartjs = $this->generarGrafico($personal);

            $bajas = Baja::where('gestion',Carbon::now()->year)->get()->count();
            $reparacions = Reparacion::where('gestion',Carbon::now()->year)->get()->count();
            $reposicions = Reposicion::where('gestion',Carbon::now()->year)->get()->count();
            $recepcions = Recepcion::where('gestion',Carbon::now()->year)->get()->count();
            $externos = Externo::whereYear('fecha_elaboracion','=',Carbon::now()->year)->get()->count();

            $tkrecepcion = Ticket::where('estado','R')->where('gestion',Carbon::now()->year)->get()->count();
            $tkasignacion = Ticket::where('estado','A')->where('gestion',Carbon::now()->year)->get()->count();
            $tkfinalizado = Ticket::where('estado','F')->where('gestion',Carbon::now()->year)->get()->count();

            /*
            $bajas = Baja::all()->count();
            $reparacions = Reparacion::all()->count();
            $reposicions = Reposicion::all()->count();
            $recepcions = Recepcion::all()->count();
            $externos = Externo::all()->count();

            $tkrecepcion = Ticket::where('estado','R')->get()->count();
            $tkasignacion = Ticket::where('estado','A')->get()->count();
            $tkfinalizado = Ticket::where('estado','F')->get()->count();*/
        }/*
        elseif( auth()->user()->isRole('encargado') ){
            $bajas = Baja::where('gestion',Carbon::now()->year)->get()->count();
            $reparacions = Reparacion::where('gestion',Carbon::now()->year)->get()->count();
            $reposicions = Reposicion::where('gestion',Carbon::now()->year)->get()->count();
            $recepcions = Recepcion::where('gestion',Carbon::now()->year)->get()->count();
            $externos = Externo::all()->count();

            $tkrecepcion = Ticket::where('estado','R')->where('gestion',Carbon::now()->year)->get()->count();
            $tkasignacion = Ticket::where('estado','A')->where('gestion',Carbon::now()->year)->get()->count();
            $tkfinalizado = Ticket::where('estado','F')->where('gestion',Carbon::now()->year)->get()->count();
        }*/
        elseif( auth()->user()->isRole('encargado') ){
            $slug = slugTipoEncargado(auth()->user());            

            $ides = idsEncargados();//helpers
            $encargados = User::with('tecnico')
            ->WhereIn('id',$ides)            
            ->orderBy('nickname','ASC')
            ->get(); 
            
            $personal = User::with('tecnico')
            ->whereHas('roles',function($query) use($slug){
                $query->where('slug',$slug);
            })
            ->where('id','!=', auth()->user()->id )//se exceptua al encargado
            ->get();            

            $pp = array();
            foreach($personal as $p){
                if(tiene_acceso($p)){
                    array_push($pp, $p);
                }
            }            
            $chartjs = $this->generarGrafico($pp);
            
            $bajas = Baja::
                whereHas('user.roles',function($query) use($slug){
                    $query->where('slug',$slug);
                })
                ->where('gestion',Carbon::now()->year)                
                ->get()->count();
            
            $reparacions = Reparacion::
            whereHas('user.roles',function($query) use($slug){
                $query->where('slug',$slug)->orWhere('slug','guest');
            })            
            ->where('gestion',Carbon::now()->year)->get()->count();

            $reposicions = Reposicion::
            whereHas('user.roles',function($query) use($slug){
                $query->where('slug',$slug)->orWhere('slug','guest');
            })            
            ->where('gestion',Carbon::now()->year)->get()->count();
            
            $recepcions = Recepcion::
            whereHas('user.roles',function($query) use($slug){
                $query->where('slug',$slug)->orWhere('slug','guest');
            })            
            ->where('gestion',Carbon::now()->year)->get()->count();
                        
            $externos = Externo::whereHas('user.roles',function($query) use($slug){
                $query->where('slug', $slug);
            })            
            //->get();
            ->whereYear('fecha_elaboracion','=',Carbon::now()->year)
            ->get()->count();
            //dd($slug, $externos);

            $tkrecepcion = Ticket::
            whereHas('user.roles',function($query) use($slug){
                $query->where('slug', $slug)->orWhere('slug','guest');
            })            
            ->where('estado','R')->where('gestion',Carbon::now()->year)->get()->count();

            $tkasignacion = Ticket::
            whereHas('user.roles',function($query) use($slug){
                $query->where('slug',$slug)->orWhere('slug','guest');
            })            
            ->where('estado','A')->where('gestion',Carbon::now()->year)->get()->count();
                        
            $tkfinalizado = Ticket::
            whereHas('user.roles',function($query) use($slug){
                $query->where('slug',$slug)->orWhere('slug','guest');
            })            
            ->where('estado','F')->where('gestion',Carbon::now()->year)->get()->count();            
        }
        else{//muestra registros propios del usuario logueado + registros de invitados
            $bajas = Baja::where('user_id',auth()->id())->where('gestion',Carbon::now()->year)->get()->count();
            $reparacions = Reparacion::where('user_id',auth()->id())->where('gestion',Carbon::now()->year)->get()->count();
            $reposicions = Reposicion::where('user_id',auth()->id())->where('gestion',Carbon::now()->year)->get()->count();
            $recepcions = Recepcion::where('user_id',auth()->id())->where('gestion',Carbon::now()->year)->get()->count();
            $externos = Externo::where('user_id',auth()->id())->get()->count();

            $slug='externos';
            $tkrecepcion = Ticket::whereHas('user.roles',function($query) use($slug){
                $query->where('slug', $slug)->orWhere('slug','guest');
            })  
            ->where('estado','R')
            ->where('gestion',Carbon::now()->year)
            ->where('user_id',auth()->id())
            ->orWhere('user_id', 13) // invitado
            ->get()
            ->count();
            
            $tkasignacion = Ticket::where('user_id',auth()->id())
            ->where('estado','A')->where('gestion',Carbon::now()->year)
            ->get()->count();

            $tkfinalizado = Ticket::where('user_id',auth()->id())
            ->where('estado','F')
            ->where('gestion',Carbon::now()->year)
            ->get()->count();
        }

        //Anio actual
        $gestion = Carbon::now()->year;
        //vista
        return view('home',
            compact('tkrecepcion','tkasignacion','tkfinalizado',
            'bajas','reparacions','reposicions','recepcions','externos','gestion','personal','encargados'
            ,'chartjs'));
    }

    /**
     * @param $pp personal
     * @return 
    */
    private function generarGrafico( $pp ){
        $xdata= array();//array de datos      
        /** 
         * pruebas
         * */  
        //$to = '2020-11-15'; $from = '2020-11-1';
        //$to = '2020-10-15'; $from = '2020-10-1';
        //$to = '2020-9-28'; $from = '2020-9-14';
        /** 
         * fin pruebas
         * */

        $to = Carbon::now()->format('Y-m-d');//a fecha
        $from = Carbon::now()->subDays(14)->format('Y-m-d');//de fecha
        $labels = $this->array_rango_fechas($from, $to);// array de dias/mes
        
        foreach($pp as $p){//ingresa datos de cada tecnico
            $tf = DB::select("SELECT CAST(fecha_asignada AS DATE) AS fecha, count(*) AS total
            FROM tickets WHERE 
            CAST(fecha_asignada AS DATE) BETWEEN ? and ?
            AND user_id= ? AND estado='F'
            GROUP BY CAST(fecha_asignada AS DATE) ", [$from, $to, $p->id]);            
            //generar array
            $na = $this->generar_array_valores($from, $to, $tf);
            //genera colores
            $colors = $this->colorarr();
            $ydata= array(
                "label" => $p->nickname,
                'backgroundColor' => $colors['backgroundColor'],
                'borderColor' => $colors['borderColor'],
                "pointBorderColor" => $colors['pointBorderColor'],
                "pointBackgroundColor" => $colors['pointBackgroundColor'],
                "pointHoverBackgroundColor" => $colors['pointHoverBackgroundColor'],
                "pointHoverBorderColor" => $colors['pointHoverBorderColor'],
                'data' => $na,
            );
            array_push($xdata, $ydata);
        }
        
        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels($labels)
        ->datasets($xdata)
        ->options([]);

        return $chartjs;
    }

    /**
     * 
    */
    private function generar_array_valores($from, $to, $darray){
        $diff =  Carbon::parse($from)->diffInDays(  Carbon::parse($to) );        
        $narray = array();        
        for($i = 1; $i <= $diff+1; $i++){
            if($this->existe_fecha($from,$darray) ){
                array_push($narray, $this->obtener_valor($from, $darray) );//rand(0,6)
            }else{
                array_push($narray, 0);
            }  
            $from = Carbon::parse($from)->addDays(1)->format('Y-m-d');
        }            
        return $narray; 
    }

    private function obtener_valor($fecha,$darray){
        foreach ($darray as $key){
            if( $key->fecha == $fecha){
                return $key->total;
            }
        }
        return 0;        
    }
    private function existe_fecha($fecha, $darray){
        foreach ($darray as $key){
            if( $key->fecha == $fecha){
                return true;
            }
        }
        return false;        
    }

    /**
     * Genera un array de colores para el grafico
     * 
     * @return $colors 
    */
    public function colorarr(){
        $colors = array();

        $R = rand(0,255);
        $G = rand(0,255);
        $B = rand(0,255);

        $colors['backgroundColor'] = "rgba($R, $G, $B, 0.31)";
        $colors['borderColor'] = "rgba($R, $G, $B, 0.7)";
        $colors['pointBorderColor'] = "rgba($R, $G, $B, 0.7)";
        $colors['pointBackgroundColor'] = "rgba($R, $G, $B, 0.7)";
        $colors['pointHoverBackgroundColor'] = "rgba(255, 255, 255, 1)";
        $colors['pointHoverBorderColor'] = "rgba(200, 200, 200, 1)";

        return $colors;
    }

    /**
     * 
    */
    private function array_rango_fechas($from, $to){
        $diff =  Carbon::parse($from)->diffInDays(  Carbon::parse($to) );
        $r = array();
        for($i = 0; $i < $diff+1; $i++){
            array_push($r, Carbon::parse($from)->format('d/m'));
            $from = Carbon::parse($from)->addDays(1);
        }
        return $r;
    }

    /**
     * Vista para invitados
    */
    public function invitado(){
        return view('invitado.index');
    }

    /**
     * 
    */
    public function generarticket($tipo)
    {
        $tip = $tipo;
        //$componentes = Componente::all();
        $componentes = Componente::where('nombre','!=','')
        ->where('visible','!=','T')
        
        ->get();
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
