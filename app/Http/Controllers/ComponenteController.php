<?php

namespace SIS\Http\Controllers;

use SIS\Componente;
use Illuminate\Http\Request;
use SIS\Http\Requests\ComponenteRequest;


use Toastr;
use Yajra\DataTables\DataTables;

class ComponenteController extends Controller
{

    public function apiComponentes()
    {
        $componente = Componente::get();
        return Datatables::of($componente)
                            ->addIndexColumn()
                            ->editColumn('icono', function($componente){
                                return '<span class="icon icon-'.$componente->icono.'"></span>';
                            })
                            ->addColumn('btn','componentes.partials.acciones')
                            ->rawColumns(['btn','icono'])
                            ->toJson();
    }

    public function index()
    {
        return view('componentes.index');
    }

    public function create()
    {
        return view('componentes.create');
    }

    public function store(ComponenteRequest $request)
    {
        Componente::create($request->all());
        Toastr::success('Componente creado con exito','Correcto!');
        return redirect()->route('componentes.index');
    }

    public function edit(Componente $componente)
    {
        return view('componentes.edit',compact('componente'));
    }

    public function update(ComponenteRequest $request, Componente $componente)
    {
        $componente->fill($request->all())->save();
        Toastr::info('Componente actualizado con exito','Actualizado!');
        return redirect()->route('componentes.index');
    }

    public function destroy(Componente $componente)
    {
        $componente->delete();

        return response()->json();
    }
}
