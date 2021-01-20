<?php

namespace SIS\Http\Controllers;

use SIS\Direccion;
use Illuminate\Http\Request;
use SIS\Http\Requests\DireccionRequest;

use Toastr;
use Yajra\DataTables\DataTables;

use SIS\Imports\DireccionsImport;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class DireccionController extends Controller
{
    public function apiDireccions()
    {
        $direccions = Direccion::with('user')->get();
        return Datatables::of($direccions)
                            ->addIndexColumn()
                            ->editColumn('internet', function($direccion){
                                return '<i class="fa '.$direccion->iconointernet.'"></i>';
                            })
                            ->editColumn('sigma', function($direccion){
                                return '<i class="fa '.$direccion->iconosigma.'"></i>';
                            })
                            ->editColumn('user.nickname', function($direccion){
                                return '<span class="label label-success">'.$direccion->user->nickname.'</span>';
                            })
                            ->editColumn('mac',function($direccion){
                                return $direccion->mac==null ? "S/MAC" : $direccion->mac;
                            })
                            ->editColumn('nombrepc',function($direccion){
                                return $direccion->nombrepc==null ? "S/NOMBREPC" : $direccion->nombrepc;
                            })
                            ->editColumn('redimpresora',function($direccion){
                                return $direccion->redimpresora==null ? "NO COMPARTE" : $direccion->redimpresora;
                            })
                            ->setRowClass(function ($direccion) {
                                return $direccion->estado == 'O' ? 'alert-danger' : '';
                            })
                            ->addColumn('btn','direccions.partials.acciones')
                            ->rawColumns(['btn','internet','sigma','user.nickname'])
                            ->toJson();
    }

    public function index()
    {
        return view('direccions.index');
    }

    public function create()
    {
        return view('direccions.create');
    }

    public function store(DireccionRequest $request)
    {
        // dd($request->all());
        $direccion = new Direccion();
        $direccion->fill($request->all());
        $direccion->fill([
            'user_id' => auth()->id(),
        ]);
        $direccion->save();
        Toastr::success('Direccion creado con exito','Correcto!');
        return redirect()->route('direccions.index');
    }

    public function edit(Direccion $direccion)
    {
        return view('direccions.edit',compact('direccion'));
    }

    public function update(DireccionRequest $request, Direccion $direccion)
    {
        $direccion->fill($request->all());
        if($request->internet==null){
            $direccion->fill([
                'internet'=>$request->internet
            ])->save();
        }
        if($request->sigma==null){
            $direccion->fill([
                'sigma'=>$request->sigma
            ])->save();
        }
        if($request->sigep==null){
            $direccion->fill([
                'sigep'=>$request->sigep
            ])->save();
        }
        $direccion->save();
        Toastr::info('Direccion actualizado con exito','Actualizado!');
        return redirect()->route('direccions.index');
    }

    public function destroy(Direccion $direccion)
    {
        $direccion->delete();

        return response()->json();
    }

    public function importar()
    {
        return view('direccions.importar');
    }

    public function storeimportar(Request $request)
    {
        Excel::import(new DireccionsImport, $request->file('archivo'));
        Toastr::success('Las Direcciones IPs fueron agregados correctamente','Agregados!');
        return redirect()->route("direccions.index");
    }

    public function observar(Request $request, $id){
        Direccion::find($id)->fill([
            'observacion' => $request->observacion,
            'estado' => 'O',
            'internet' => 0,
        ])->save();
        Toastr::error('La Direccion IP fue observada correctamente','Observado!');
        return back();   
    }

    public function quitarobservaciones($id){
        Direccion::find($id)->fill([
            'observacion' => '',
            'estado' => 'N',
            'internet' => 1,
        ])->save();
        Toastr::info('La Direccion IP ya no se encuentra observada','Modificado!');
        return back();   
    }
}
