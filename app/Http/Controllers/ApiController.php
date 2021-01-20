<?php

namespace SIS\Http\Controllers;

use Illuminate\Http\Request;

use SIS\Unidad;
use SIS\Componente;
use SIS\Funcionario;
use SIS\Ticket;

class ApiController extends Controller
{
    public function getUnidads()
    {
        $unidads = Unidad::all();
        if(isset($unidads)){
            return response($unidads);
        }
    }
    public function getComponentes()
    {
        $componentes = Componente::all();
        if(isset($componentes)){
            return response($componentes);
        }
    }

    public function getTicket(Request $request, $id){
        if($request->ajax()){
            $ticket = Ticket::find($id);
            return response()->json($ticket);
        }
    }

    public function getFuncionario($carnet){
        $funcionario = Funcionario::select('carnet','exp','nombre','apellidos','cargo')->where('carnet',$carnet)->get()->last();
        // dd($funcionario);
        if($funcionario != null){
            return response()->json($funcionario);
        }
        else{
            return response()->json(['mensaje'=>'E']);
        }
    }

    public function getFuncionarios()
    {
        $funcionarios = Funcionario::all();
        if(isset($funcionarios)){
            return response($funcionarios);
        }
    }
}
