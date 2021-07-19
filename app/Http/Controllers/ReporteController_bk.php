<?php

namespace SIS\Http\Controllers;

use Illuminate\Http\Request;
use SIS\User;
use SIS\Ticket;
use SIS\Recepcion;
use SIS\Reparacion;
use SIS\Reposicion;
use SIS\Baja;
use Carbon\Carbon;
use App;

/**
 * Reportes * */
class ReporteController extends Controller
{
    /**
     * 
    */
    public function index()
    {
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
        $chartjsx = $this->generarGrafico($personal);



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

        return view('reportes.index', compact('users','total','tickets','recepcions','reposicions','reparacions','bajas','chartjs','chartjs2','chartjs3',
    
            'chartjsx'));
    }

    /**
     * 
    */
    private function generarGrafico($personal){
        $labels =collect();
        $asignados= collect(); 
        $finalizados = collect();

        $to = Carbon::now()->format('Y-m-d');//a fecha
        $from = Carbon::now()->subDays(14)->format('Y-m-d');//de fecha
        
        foreach ($personal as $user) {
            $labels->push($user->nickname);

            $asignado = $user->tickets
            ->where('gestion',Carbon::now()->year)
            ->where('estado','A')->count();
            $finalizado = $user->tickets
                ->where('gestion',Carbon::now()->year)
                ->where('estado','F')
                ->count();
            
            $asignados->push($asignado);
            $finalizados->push($finalizado);
        }



        $chartjs = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels($labels->all())
        ->datasets([
            [
                "label" => "Tickets Asignados",
                'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                'data' => $asignados->all()
            ],
            [
                "label" => "Tickets Finalizados",
                'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],
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
                ->orWhere('slug','educacion')
                ->orWhere('slug','data')
                ->orWhere('slug','redes')
                ->orWhere('slug','externos');
            })
            ->get()           
            ->pluck('InfoUser','id');            
        } elseif( auth()->user()->isRole('encargado') ){//solo usuarios a su cargo            
            $slug = slugTipoEncargado(auth()->user());
            $usuarios = User::whereHas('roles',function($query) use($slug){
                $query->where('slug', $slug );
            })->get()->pluck('nombretecnico','id');    
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
	    		break;
	    }

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0,0,935.433,595.276]);
        // $pdf->setPaper('legal', 'landscape');

        if($tipoinforme=='todos')
        	$pdf->loadView('reportes.imprimir.reporte-mensual',compact('informes_baja','informes_reparacion','informes_reposicion','informes_recepcion','mes','year','usuarionombre','tipo'));
    	else
            $pdf->loadView('reportes.imprimir.reporte-mensual',compact('informes','mes','year','usuarionombre','tipo'));

        return $pdf->stream('reporte-informe-mensual.pdf');
    
    }
    
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
	    		break;
	    }
	    $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0,0,935.433,595.276]);
        // $pdf->setPaper('legal', 'landscape');
        if($tipoinforme=='todos')
        	$pdf->loadView('reportes.imprimir.reporte',compact('informes_baja','informes_reparacion','informes_reposicion','informes_recepcion','fecha1','fecha2','usuarionombre','tipo'));
    	else
        	$pdf->loadView('reportes.imprimir.reporte',compact('informes','fecha1','fecha2','usuarionombre','tipo'));
        return $pdf->stream($usuario.'.pdf');
    }
}
