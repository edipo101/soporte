<?php

namespace SIS\Http\Controllers;

use SIS\Diagnostico;
use Illuminate\Http\Request;
use SIS\Http\Requests\DiagnosticoRequest;

use Toastr;
use Yajra\DataTables\DataTables;

class DiagnosticoController extends Controller
{
    public function apiDiagnosticos()
    {
        $diagnostico = Diagnostico::get();
        return Datatables::of($diagnostico)
                            ->addIndexColumn()
                            ->editColumn('estado', function($diagnostico){
                                $label = $diagnostico->estado=='A' ? 'success' : 'danger';
                                return '<span class="label label-'.$label.'">'.$diagnostico->nombreestado.'</span>';
                            })
                            ->addColumn('tickets', function($diagnostico){
                                return '<i class="fa fa-tags"></i>: <strong>'.$diagnostico->tickets()->count().'</strong>';
                            })
                            ->addColumn('btn','diagnosticos.partials.acciones')
                            ->rawColumns(['btn','estado','tickets'])
                            ->toJson();
    }

    public function index()
    {
        return view('diagnosticos.index');
    }

    public function create()
    {
        return view('diagnosticos.create');
    }

    public function store(DiagnosticoRequest $request)
    {
        Diagnostico::create($request->all());
        Toastr::success('Diagnostico creado con exito','Correcto!');
        return redirect()->route('diagnosticos.index');
    }

    public function edit(Diagnostico $diagnostico)
    {
        return view('diagnosticos.edit',compact('diagnostico'));
    }

    public function update(DiagnosticoRequest $request, Diagnostico $diagnostico)
    {
        $diagnostico->fill($request->all())->save();
        Toastr::info('Diagnostico actualizado con exito','Actualizado!');
        return redirect()->route('diagnosticos.index');
    }

    public function destroy(Diagnostico $diagnostico)
    {
        $diagnostico->delete();
        
        return response()->json();
    }
}
