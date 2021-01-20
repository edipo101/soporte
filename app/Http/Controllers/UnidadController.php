<?php

namespace SIS\Http\Controllers;

use SIS\Unidad;
use Illuminate\Http\Request;
use SIS\Http\Requests\UnidadRequest;

use Toastr;
use Yajra\DataTables\DataTables;

class UnidadController extends Controller
{

    public function apiUnidads()
    {
        $unidad = Unidad::get();
        return Datatables::of($unidad)
                            ->addIndexColumn()
                            ->addColumn('btn','unidads.partials.acciones')
                            ->rawColumns(['btn'])
                            ->toJson();
    }

    public function index()
    {
        return view('unidads.index');
    }

    public function create()
    {
        return view('unidads.create');
    }

    public function store(UnidadRequest $request)
    {
        Unidad::create($request->all());
        Toastr::success('Unidad creado con exito','Correcto!');
        return redirect()->route('unidads.index');
    }

    public function edit(Unidad $unidad)
    {
        return view('unidads.edit',compact('unidad'));
    }

    public function update(UnidadRequest $request, Unidad $unidad)
    {
        $unidad->fill($request->all())->save();
        Toastr::info('Unidad actualizado con exito','Actualizado!');
        return redirect()->route('unidads.index');
    }

    public function destroy(Unidad $unidad)
    {
        $unidad->delete();
        
        return response()->json();
    }
}
