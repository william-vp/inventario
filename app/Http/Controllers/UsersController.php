<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Laracasts\Flash\Flash;
use App\User as User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Validator;
use Response;

class UsersController extends Controller
{
    public function index(){
        $users= User::orderBy('id','ASC')->get();
        return view('users.index')-> with('users',$users);
    }

    public function destroy($id){
        $notification = array(
            'message' => 'Accion no disponible.,',
            'alert-type' => 'error'
        );
        return back()->with($notification);

        $user= User::find($id);

        if ($user->delete()){
            Storage::delete($user->avatar);
            $notification = array(
                'message' => 'Usuario eliminado',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Error eliminando usuario,',
                'alert-type' => 'error'
            );
        }

        return back()->with($notification);
    }

    public function perfil(){
        $datos= User::where('id','=',Auth()->user()->id)->firstOrFail();
        return view('users.perfil')-> with('datos',$datos);
    }

    public function editarPerfil(Request $request){
        if ($request->id != Auth()->user()->id){
            $numId = User::where("id","=",$request->id)->count();
            if ($numId > 0) {
                return ("dup");
            }
        }

        $perfil= User::find(Auth()->user()->id);
        $perfil->id= $request->id;
        $perfil->name= $request->name;
        $perfil->email= $request->email;

        if ($request->type != null and Auth()->user()->type == 'ADMIN'){
            $perfil->type= $request->type;
        }

        if ($request->actual_pass != null){
            if (Hash::check($request->actual_pass, Auth::user()->password ) == true){ 
                $perfil->password= $request->nueva_pass;
            }else{
                dd(Auth::user()->password."<br>".bcrypt($request->actual_pass));
                return ("incorrectpass");
            }
        }

        if ($request->file('imagen') == null){
            $perfil->avatar = 'user.png';
        }else{
            if ($perfil->avatar != null and $perfil->avatar !='user.png'){
                //Storage::delete($perfil->avatar);
            }
            $perfil->avatar = $request->file('imagen')->store('public/avatar');
        }

        if ($perfil->save()){
            return ("exito");
        }else{
            return ("error");
        }
        
    }
    

    public function edit($id){
        $datos= User::Find($id);
        return view('users.edit')-> with('datos',$datos);
    }

    public function update(Request $request, $id){
        $user= User::Find($id);
        /*if ($request->id != $user->id){
            $numId = User::where("id","=",$request->id)->count();
            if ($numId > 0) {
                return ("dup");
            }
        }*/

        //$user->id= $request->id;
        $user->name= $request->name;
        $user->email= $request->email;

        if ($request->nueva_pass != null){
            $user->password= bcrypt($request->nueva_pass);
        }
        $user->type= $request->type;

        if ($user->save()){
            return ("exito");
        }else{
            return ("error");
        }
        

    }

}
