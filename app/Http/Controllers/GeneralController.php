<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\General;

class GeneralController extends Controller
{
    public function index()
    {
        

    }

    public function edit()
    {
    	$datos= General::orderBy('id','ASC')->get()->last();
        return view('general')->with('datos',$datos);
    }

    public function update(Request $request){
    	$general= General::orderBy('id','ASC')->get()->last();
    	$general->nombre= $request->nombre;
    	$general->email= $request->email;
    	$general->telefono= $request->telefono;

    	if ($request->file('logo') != null){
            if ($general->logo != null or $general->logo!=''){
                Storage::delete($general->logo);
            }
    		$general->logo= $request->file('logo')->store('public');
            $path = $request->file('logo')->storeAs(
                'public', "logoF.png"
            );

            $file = $request->file('logo');
            $name = "logo.png";
            $path = public_path() .'\images';        
            $file->move($path,$name);

            //Storage::copy(storage_path()."/app/".$general->logo , public_path()."/images/".$general->logo);
    	}
    	if ($request->file('portada') != null){
            if ($general->portada != null or $general->portada!=''){
                Storage::delete($general->portada);
            }
    		$general->portada= $request->file('portada')->store('public');
    	}

    	if ($general->save()){
    		session()->put('app_name', $general->nombre);
    		session()->put('app_logo', $general->logo);
    		session()->put('app_portada', $general->portada);
    		session()->put('app_email', $general->email);
    		session()->put('app_telefono', $general->telefono);

            return ("exito");
        }else{
            return ("error");
        }
    	
    }
}
