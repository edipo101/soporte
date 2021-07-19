<?php

namespace SIS\Http\Controllers;

use SIS\Externo;
use SIS\Servicio;
use SIS\Unidad;
use Illuminate\Http\Request;
use SIS\Http\Requests\ExternoRequest;

use Toastr;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App;

class ExternoController extends Controller
{
    
    /**
     * @param int $gestion Ej. 2021
     * 
    */
    public function apiExternos($gestion)
    {
        if(auth()->user()->isRole('admin')){//todos los usuarios
            $externos = Externo::with('unidad')
            ->with('user')            
            ->whereYear('fecha_elaboracion','=',$gestion)
            ->orderBy('externos.id','desc');
        }            
        elseif(auth()->user()->isRole('encargado')){
            $slug = slugTipoEncargado(auth()->user());
            $externos = Externo::
            whereHas('user.roles',function($query) use($slug){
                $query->where('slug', $slug );
            })
            ->with('unidad')
            ->with('user')            
            ->whereYear('fecha_elaboracion','=',$gestion)
            //->where('gestion',Carbon::now()->year)            
            ->orderBy('externos.id','desc');            
            //dd($slug, $externos);
        }
        else{//todos los informes del usuario
            $externos = Externo::where('user_id',auth()->id())
            ->with('unidad')
            ->with('user')          
            ->whereYear('fecha_elaboracion','=',$gestion)
            ->orderBy('externos.id','desc');
        }           
        
        return datatables() 
                    ->eloquent($externos)
                    ->addIndexColumn()
                    ->addColumn('servicios', function($externo){
                        $servicio="";
                        foreach($externo->servicios as $servicios)
                        {
                            $servicio .='<span class="label label-info">'.$servicios->nombre.'</span> ';
                        }
                        return $servicio;
                    })
                    ->editColumn('fecha_elaboracion', function($externo){
                        return $externo->fecha_elaboracion->format('d/m/Y').'<br>'.$externo->fecha_elaboracion->format('H:i:s');
                    })
                    ->editColumn('descripcion', function($externo){
                        return str_limit($externo->descripcion,30);
                    })
                    ->editColumn('user.nickname', function($externo){
                        return '<span class="label label-success">'.$externo->user->nickname.'</span>';
                    })
                    ->addColumn('btn','externos.partials.acciones')
                    ->rawColumns(['btn','user.nickname','servicios','fecha_elaboracion'])
                    ->toJson();
    }

    /**
     * @param int $gestion
    */
    public function index(Request $request)    
    {        
        $gestion = ($request->gestion!=null)?$request->gestion:2021;
        return view('externos.index', compact('gestion'));
    }

    public function create()
    {
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $servicios = Servicio::orderBy('id','ASC')->get();
        return view('externos.create',compact('fecha','usuario','servicios'));
    }

    public function store(ExternoRequest $request)
    {
        //Verifica si existe la unidad si no lo crea
        $unidad = Unidad::firstOrCreate(['nombre' => $request->unidad]);
        $externo = new Externo();
        $externo->fill($request->all());
        $externo->fill([
            'user_id' => auth()->id(),
            'estado'=> 'E',
            'unidad_id' => $unidad->id,
            'fecha_elaboracion' => Carbon::now()->format('Y-m-d H:i:s'),
            'fecha_entrega' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        $externo->save();
        // Guardar los servicios externo
        $externo->servicios()->attach($request->servicios);
        Toastr::success('Informe Tecnico Externo creado con exito','Correcto!');
        return redirect()->route('externos.edit',$externo);
    }

    public function edit(Externo $externo)
    {
        $fecha = Carbon::now()->format('d/m/Y H:i:s');
        $usuario = auth()->user()->tecnico->fullnombre;
        $servicios = Servicio::orderBy('id','ASC')->get();
        return view('externos.edit',compact('externo','fecha','usuario','servicios'));
    }

    public function update(ExternoRequest $request, Externo $externo)
    {
        //Verifica si existe la unidad si no lo crea
        $unidad = Unidad::firstOrCreate(['nombre' => $request->unidad]);
        $externo->fill($request->all());
        $externo->fill([
            'estado'=> 'E',
            'unidad_id' => $unidad->id,
        ]);
        $externo->save();
        //Guardar los servicios externo
        $externo->servicios()->sync($request->servicios);

        Toastr::info('Informe Tecnico Externo actualizado con exito','Actualizado!');
        return redirect()->route('externos.edit',$externo);
    }

    public function destroy(Externo $externo)
    {
        $externo->delete();

        return response()->json();
    }

    public function imprimir(Externo $externo)
    {
        $servicios = Servicio::all();
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('letter');
        $pdf->loadView('externos.imprimir.informe',compact('externo','servicios'));
        return $pdf->stream($externo->id.'-'.$externo->user->nickname.'.pdf');
    }
}
