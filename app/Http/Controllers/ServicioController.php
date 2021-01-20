<?php

namespace SIS\Http\Controllers;

use SIS\Servicio;
use Illuminate\Http\Request;
use SIS\Http\Requests\ServicioRequest;

use Toastr;
use Yajra\DataTables\DataTables;

class ServicioController extends Controller
{
    public function apiServicios()
    {
        $servicio = Servicio::get();
        return Datatables::of($servicio)
                            ->addIndexColumn()
                            ->editColumn('descripcion', function($servicio){
                                return $servicio->descripcion==null
                                                ? 'SIN DESCRIPCION'
                                                : $servicio->descripcion;
                            })
                            ->addColumn('btn','servicios.partials.acciones')
                            ->rawColumns(['btn','estado'])
                            ->toJson();
    }

    public function index()
    {
        return view('servicios.index');
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(ServicioRequest $request)
    {
        Servicio::create($request->all());
        Toastr::success('Servicio creado con exito','Correcto!');
        return redirect()->route('servicios.index');
    }

    public function edit(Servicio $servicio)
    {
        return view('servicios.edit',compact('servicio'));
    }

    public function update(ServicioRequest $request, Servicio $servicio)
    {
        $servicio->fill($request->all())->save();
        Toastr::info('Servicio actualizado con exito','Actualizado!');
        return redirect()->route('servicios.index');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return response()->json();
    }
}
