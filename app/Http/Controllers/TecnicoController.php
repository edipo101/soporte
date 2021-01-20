<?php

namespace SIS\Http\Controllers;

use SIS\Tecnico;
use SIS\User;
use Illuminate\Http\Request;
use SIS\Http\Requests\TecnicoStoreRequest;
use SIS\Http\Requests\TecnicoUpdateRequest;
use SIS\Http\Requests\UserPasswordRequest;
use Caffeinated\Shinobi\Models\Role;

use Toastr;
use Yajra\DataTables\DataTables;

class TecnicoController extends Controller
{
    public function apiUsers()
    {
        $tecnico = Tecnico::with('user')->get();
        return Datatables::of($tecnico)
                            ->addIndexColumn()
                            ->editColumn('foto',function($tecnico){
                                return '<img src="'. asset('img/users/'. $tecnico->foto ).'" alt="'. $tecnico->foto. '" class="img-responsive img-circle" width="45px">';
                            })
                            ->editColumn('nombre',function($tecnico){
                                return '<span class="label label-primary">'.$tecnico->titulo.'</span> '.$tecnico->fullnombre;
                            })
                            ->editColumn('user.nickname',function($tecnico){
                                return '<span class="label label-primary">'.$tecnico->user->nickname.'</span> ';
                            })
                            ->addColumn('roles', function($tecnico){
                                $rol="";
                                foreach($tecnico->user->roles as $roles)
                                {
                                    $rol .='<span class="label label-info">'.$roles->name.'</span>';
                                }
                                return $rol;
                            })
                            ->addColumn('btn','users.partials.acciones')
                            ->rawColumns(['btn','foto','nombre','user.nickname','roles'])
                            ->toJson();
    }

    public function index()
    {
        return view('users.index',compact('tecnicos'));
    }

    public function create()
    {
        array_map('unlink', glob(public_path()."/img/tmp/*"));
        $roles = Role::orderBy('id','ASC')->pluck('slug','id');
        return view('users.create',compact('roles'));
    }

    public function store(TecnicoStoreRequest $request)
    {
        //Crear y guadar los datos del Tecnico
        $tecnico = new Tecnico();
        $tecnico->fill($request->all());
        // Verifica si se agrego la fotografia si no por defecto carga default.jpg
        if(empty($request->fotografia)){
            $tecnico->foto = 'default.jpg';
        }
        else{
           $public = public_path();
            $old = public_path()."".$request->fotografia;
            $ext = explode('.', $old);
            $destino = "/img/users/".str_slug($request->nombre).".".$ext[1];
            $new = $public."".$destino;
            //mover la imagen
            copy($old, $new);
            // borrar del temporal
            unlink($old);
            $tecnico->foto = str_slug($request->nombre).".".$ext[1]; 
        }
        $tecnico->save();
        // Crea, guarda el usuario y asigna el usuario al tecnico
        $user = new User();
        $user->fill([
            'tecnico_id' => $tecnico->id,
            'nickname'=>$request->nickname,
            'password'=> $request->password,
        ]);
        $user->save();
        //Sincroniza los roles asignados al usuario
        $user->syncRoles($request->roles);

        Toastr::success('User creado con exito','Correcto!');

        return redirect()->route('users.index');
    }

    public function edit(Tecnico $tecnico)
    {
        array_map('unlink', glob(public_path()."/img/tmp/*"));
        $roles = Role::orderBy('id','ASC')->pluck('slug','id');
        return view('users.edit',compact('tecnico', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SIS\Tecnico  $tecnico
     * @return \Illuminate\Http\Response
     */
    public function update(TecnicoUpdateRequest $request, Tecnico $tecnico)
    {
        //Guarda los nuevos datos del tecnico
        $tecnico->fill($request->all());
        //Verifica si fue cambiado la fotografia del tecnico
        if(!starts_with($request->fotografia,"http://")){
            $public = public_path();
            $old = public_path()."".$request->fotografia;
            $ext = explode('.', $old);
            $destino = "/img/users/". str_slug($request->nombre).".".$ext[1];
            $new = $public."".$destino;
            //mover la imagen
            copy($old, $new);
            // borrar del temporal
            unlink($old);
            $tecnico->foto = str_slug($request->nombre).".".$ext[1];
        }
        $tecnico->save();
        //Guarda los nuevos datos del usuario
        $user = User::where('tecnico_id',$tecnico->id)->first();
        $user->fill([
            'nickname'=>$request->nickname,
        ]);
        $user->save();
        //Verifica si el usuario modifico su password
        if($request->password){
            $user->fill([
                'password'=>$request->password
            ])->save();
        }

        //Sincroniza los roles del usuario
        $user->syncRoles($request->roles);

        Toastr::info('User actualizado con exito','Actualizado!');
        return redirect()->route('users.index');
    }

    public function destroy(Tecnico $tecnico)
    {
        // $tecnico->delete();
        $tecnico->estado = 'D';
        $tecnico->save();
        $tecnico->user->delete();
        // Toastr::error('Eliminado correctamente','Eliminado!');
        return response()->json();
    }

    public function upload(Request $request) {
        //Verifica si se subio una imagen
        if($request->file('file')) {
            //Sube la imagen al directorio /img/tpm y retorna la direccion
            $file = $request->file('file');
            $tmpFilePath = '/img/tmp/';
            $tmpFileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = $tmpFilePath . $tmpFileName;
            return response()->json($path);
        } else {
            return response()->json(false, 200);
        }
    }

    public function perfil()
    {
        $user = auth()->user();
        $tecnico = Tecnico::find($user->tecnico_id);
        return view('users.perfil',compact('user','tecnico'));
    }

    public function updatepassword(UserPasswordRequest $request, User $user)
    {
        $user->password=$request->password;
        $user->save();
        Toastr::info('Su contraseña fue cambiado satisfactoriamente','Password!');
        return redirect('/');
    }
}
