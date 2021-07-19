<?php

namespace SIS\Http\Controllers;

use Illuminate\Http\Request;
use SIS\User;
use SIS\Ticket;
use SIS\Recepcion;
use SIS\Reparacion;
use SIS\Reposicion;
use SIS\Baja;
use SIS\Externo;
use Carbon\Carbon;
use App;
use Illuminate\Support\Facades\DB;
/**
 * Reportes * */
class ReporteController extends Controller
{
    /**
     * 
    */
    public function index(Request $request){

        

        $to = Carbon::now()->format('Y-m-d');//a fecha
        $from = Carbon::now()->subDays(14)->format('Y-m-d');//de fecha  
        $tipo_grafico='gaf';

        if($request->method() == 'POST'){
            $from = $request->fecha_de;
            $to = $request->fecha_hasta;
            $tipo_grafico = $request->tipog;            
        }        

        //Optiene a todo el personal disponible de todas las areas
        $ids = idsTecnicos();//helpers            
        $personal = User::with('tecnico')            
        ->WhereIn('id',$ids)
        ->where('id','!=', auth()->user()->id )//se exceptua al admin
        ->orderBy('nickname','ASC')
        ->get();
        $pp = array();
            foreach($personal as $p){
                if(tiene_acceso($p)){
                    array_push($pp, $p);
                }
            }     

        if($tipo_grafico == 'gaf'){
            $chartjsx = $this->generarGrafico($personal, $from, $to );
        }elseif( $tipo_grafico =='tfd'){
            $chartjsx = $this->generarGrafico2($personal, $from, $to );
        }


/*
        // Lista todos los tecnicos del sistema
        $users = User::whereHas('roles',function($query){
            $query->where('slug','tecnico');
        })->get();

        // Cargar datos para la grafica
        $labels =collect();
        $asignados= collect(); 
        $finalizados = collect();
        foreach ($users as $user) {
            $labels->push($user->nickname);
            $asignado = $user->tickets
            ->where('gestion',Carbon::now()->year)
            ->where('estado','A')->count();
            $finalizado = $user->tickets->where('gestion',Carbon::now()->year)->where('estado','F')->count();
            $asignados->push($asignado);
            $finalizados->push($finalizado);
        }
        // Configuracion para la grafica 1
        $chartjs = app()->chartjs
            ->name('barChartTickets')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels->all())
            ->datasets([
                [
                    'label'=> 'TICKETS ASIGNADOS',
                    'backgroundColor' => 'yellow',
                    'data' => $asignados->all(),
                ],
                [
                    'label'=> 'TICKETS FINALIZADOS',
                    'backgroundColor' => 'green',
                    'data' => $finalizados->all(),
                ],
                ])
            ->options([]);
        



        // Listar todos los tickets
        $tickets = Ticket::where('gestion',Carbon::now()->year)->get();
        //Cargar datos para la grafica
        $labels = ['RECEPCIONADOS','ASIGNADOS','FINALIZADOS']; $datos= collect();
        $dato = $tickets->where('gestion',Carbon::now()->year)->where('estado','R')->count();
        $datos->push($dato);
        $dato = $tickets->where('gestion',Carbon::now()->year)->where('estado','A')->count();
        $datos->push($dato);
        $dato = $tickets->where('gestion',Carbon::now()->year)->where('estado','F')->count();
        $datos->push($dato);
        // Configuracion de la grafica 2
        $chartjs2 = app()->chartjs
            ->name('pieDoughnutTickets')
            ->type('doughnut')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    'backgroundColor' => ['#FE2E2E', '#36A2EB','#00FF40'],
                    'hoverBackgroundColor' => ['#FE2E2E', '#36A2EB','#00FF40'],
                    'data' => $datos->all(),
                ]
            ])
            ->options([]);
        // Lista de todos los informes tecnicos que dependen de tickets
        $recepcions = Recepcion::where('gestion',Carbon::now()->year)->get()->count();
        $reposicions = Reposicion::where('gestion',Carbon::now()->year)->get()->count();
        $reparacions = Reparacion::where('gestion',Carbon::now()->year)->get()->count();
        $bajas = Baja::where('gestion',Carbon::now()->year)->get()->count();
        $total = $recepcions+$reposicions+$reparacions+$bajas;
        //Configuracion del la grafica 3
        $chartjs3 = app()->chartjs
            ->name('pieChartInformes')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['RECEPCION', 'REPARACION','REPOSICION','BAJA'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384', '#36A2EB','#FE2E2E','#00FF40'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB','#FE2E2E','#00FF40'],
                    'data' => [$recepcions, $reparacions,$reposicions,$bajas]
                ]
            ])
            ->options([]);
            */


        return view('reportes.index', 
        
        compact('chartjsx', 'from', 'to' ));
    }

    /**
     * 
    */
    private function generarGrafico2($personal, $from , $to ){
        $xdata= array();//array de datos    
        $labels = $this->array_rango_fechas($from, $to);// array de dias/mes

        foreach($personal as $p){//ingresa datos de cada tecnico
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

    private function array_rango_fechas($from, $to){
        $diff =  Carbon::parse($from)->diffInDays(  Carbon::parse($to) );
        $r = array();
        for($i = 0; $i < $diff+1; $i++){
            array_push($r, Carbon::parse($from)->format('d/m'));
            $from = Carbon::parse($from)->addDays(1);
        }
        return $r;
    }

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
     * Grafico de tickets asignados y finalizados
    */
    private function generarGrafico($personal, $from , $to ){
        $labels =collect();
        $asignados= collect(); 
        $finalizados = collect();
        //$from = '2021-1-1';

        //colores para las barras
        $backgroundColor1 = collect();
        $backgroundColor2 = collect();

        foreach ($personal as $user) {//obtiene datos de todo el personal
            $labels->push($user->nickname);           
                        
            $asignado = DB::select("SELECT * FROM tickets WHERE user_id=? 
                    AND CAST(fecha_asignada AS DATE) BETWEEN ? and ? AND estado ='A' ",
                    [$user->id, $from, $to]);
                       
            $finalizado = DB::select("SELECT * FROM tickets WHERE user_id=? 
                    AND CAST(fecha_asignada AS DATE) BETWEEN ? and ? AND estado ='f' ",
                    [$user->id, $from, $to]);
                        
            $asignados->push( count($asignado) );
            $finalizados->push( count($finalizado) );

            $backgroundColor1->push( 'rgba(255, 99, 32, 0.3)' );
            $backgroundColor2->push( 'rgba(25, 234, 13, 0.4)' );
        }        


        $chartjs = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels($labels->all())
        ->datasets([
            [
                "label" => "Tickets Asignados",
                'backgroundColor' => $backgroundColor1->all(),
                'data' => $asignados->all()
            ],
            [
                "label" => "Tickets Finalizados",
                'backgroundColor' => $backgroundColor2->all(),
                'data' => $finalizados->all()
            ]
        ])
        ->options([]);

        return $chartjs;
    }


    /**
     * Vista informes index
    */
    public function informes()
    {
        if( auth()->user()->isRole('admin') ){//todos los usuarios 
            $usuarios = User::orderBy('nickname')
            ->whereHas('roles',function($query){
                $query->where('slug', 'encargado' )
                ->orWhere('slug','tecnico')                
                ->orWhere('slug','data')
                ->orWhere('slug','redes')
                ->orWhere('slug','desarrollo')
                ->orWhere('slug','externos');
            })
            ->get()           
            ->pluck('InfoUser','id');            
        } elseif( auth()->user()->isRole('encargado') ){//solo usuarios a su cargo            
            $usa = usuarios_sin_acceso();

            $slug = slugTipoEncargado(auth()->user());            
            $usuarios = User::whereHas('roles',function($query) use($slug){
                $query->where('slug', $slug );
            })
            ->whereNotIn('id', $usa )//excepto usuario logueado
            ->get()
            ->pluck('nombretecnico','id');    
        }
        else{
            /*$usuarios = User::
            where('id', auth()->user()->id )
            ->get()->pluck('nombretecnico','id');    */            
        }
/*
        $usuarios = User::whereHas('roles',function($query){
            $query->where('slug','tecnico');
        })->get()->pluck('nombretecnico','id');
*/
    	$tipos = [
            'todos'=>'TODOS LOS INF.',
            'baja'=>'INF. TEC. BAJA',
            'reparacion'=>'INF. TEC. REPARACION',
            'reposicion'=>'INF. TEC. REPOSICION',
            'recepcion'=>'INF. TEC. RECEPCION',
            'externos'=>'INF. TEC. EXTERNOS'
        ];
        return view('reportes.informes',compact('tipos','usuarios'));
    }

    /**
     *  Informe mensual
     * 
     * @param $mes 
     * @param $anio
     * @param $usuario ID de usuario
     * $param $tipo 
     * Valores posibles:      
     *      - baja
     *      - reparacion
     *      - reposicion
     *      - recepcion
     *      - externos
     *      - todos
    */
    public function imprimir_mensual($mes,$anio,$usuario,$tipo){
        $mes = $mes;        
        $year = $anio;
        $usuario = $usuario;
        $tipoinforme = $tipo;
        $user = User::find($usuario);
        $usuarionombre = $user->tecnico->fullnombre;

        switch ($tipoinforme) {
	    	case 'baja':
	    		$informes = Baja::reportemes($mes,$year, $usuario)->orderBy('id','ASC')->get();                
	    		break;
	    	case 'reparacion':
	    		$informes = Reparacion::reportemes($mes,$year, $usuario)->orderBy('id','ASC')->get();
	    		break;
	    	case 'reposicion':
	    		$informes = Reposicion::reportemes($mes,$year, $usuario)->orderBy('id','ASC')->get();
	    		break;
	    	case 'recepcion':
	    		$informes = Recepcion::reportemes($mes,$year, $usuario)->orderBy('id','ASC')->get();
	    		break;
	    	case 'todos':
	    		$informes_baja = Baja::reportemes($mes,$year, $usuario)->orderBy('id','ASC')->get();
	    		$informes_reparacion = Reparacion::reportemes($mes,$year, $usuario)->orderBy('id','ASC')->get();
	    		$informes_reposicion = Reposicion::reportemes($mes,$year, $usuario)->orderBy('id','ASC')->get();
	    		$informes_recepcion = Recepcion::reportemes($mes,$year, $usuario)->orderBy('id','ASC')->get();
                $informes_externo = Externo::reportemesE($mes,$year, $usuario)->orderBy('id','ASC')->get();
	    		break;
            case 'externos': 
                $informes = Externo::reportemesE($mes,$year, $usuario)->orderBy('id','ASC')->get();
                break;
	    }

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0,0,935.433,595.276]);
        if($tipoinforme=='todos'){
            $pdf->loadView('reportes.imprimir.reporte-mensual',compact('informes_baja','informes_reparacion','informes_reposicion','informes_recepcion','mes','year','usuarionombre','tipo','informes_externo'));
        }else{
            $pdf->loadView('reportes.imprimir.reporte-mensual',compact('informes','mes','year','usuarionombre','tipo'));
        }
        return $pdf->stream('reporte-informe-mensual.pdf');    
    }
    
    /**
     * 
     * @fecha1 
     * @fecha2
     * @usuario
     * @tipo
    */
    public function imprimir_personalizado($fecha1,$fecha2,$usuario,$tipo)
    {
        
        $fecha1 = date('Y-m-d',strtotime($fecha1));
	    $fecha2 = date('Y-m-d',strtotime($fecha2));
	    $usuario = $usuario;
	    $tipoinforme = $tipo;
        $user = User::find($usuario);
        $usuarionombre = $user->tecnico->fullnombre;
        switch ($tipoinforme) {
	    	case 'baja':
	    		$informes = Baja::reporte($fecha1,$fecha2, $usuario)->orderBy('id','ASC')->get();
	    		break;
	    	case 'reparacion':
	    		$informes = Reparacion::reporte($fecha1,$fecha2, $usuario)->orderBy('id','ASC')->get();
	    		break;
	    	case 'reposicion':
	    		$informes = Reposicion::reporte($fecha1,$fecha2, $usuario)->orderBy('id','ASC')->get();
	    		break;
	    	case 'recepcion':
	    		$informes = Recepcion::reporte($fecha1,$fecha2, $usuario)->orderBy('id','ASC')->get();                
	    		break;
	    	case 'todos':
	    		$informes_baja = Baja::reporte($fecha1,$fecha2, $usuario)->orderBy('id','ASC')->get();
	    		$informes_reparacion = Reparacion::reporte($fecha1,$fecha2, $usuario)->orderBy('id','ASC')->get();
	    		$informes_reposicion = Reposicion::reporte($fecha1,$fecha2, $usuario)->orderBy('id','ASC')->get();
	    		$informes_recepcion = Recepcion::reporte($fecha1,$fecha2, $usuario)->orderBy('id','ASC')->get();
                $informes_externo = Externo::reporteE($fecha1,$fecha2, $usuario)->orderBy('id','ASC')->get();                
	    		break;
            case 'externos': 
                $informes = Externo::reporteE($fecha1,$fecha2, $usuario)->orderBy('id','ASC')->get();                
                break;
	    }

	    $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0,0,935.433,595.276]);
        // $pdf->setPaper('legal', 'landscape');
        if($tipoinforme=='todos'){
            $pdf->loadView('reportes.imprimir.reporte',compact('informes_baja','informes_reparacion','informes_reposicion','informes_recepcion','fecha1','fecha2','usuarionombre','tipo','informes_externo'));
        }else{
            $pdf->loadView('reportes.imprimir.reporte',compact('informes','fecha1','fecha2','usuarionombre','tipo'));
        }        	
        return $pdf->stream($usuario.'.pdf');
    }
}
