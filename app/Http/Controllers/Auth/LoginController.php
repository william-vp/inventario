<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Caja;
use App\General;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        $general= General::orderBy('id','ASC')->get()->last();
        return view("auth.login")->with("datos",$general);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function login(Request $request){
        $email= $request->email;
        $password= $request->password;

        $numUsers = User::where("email","=",$email)->count();
        if($numUsers == 0){
            return ('noexiste');
        }else{
            if (Auth::attempt(['email' => $email,
                'password' => $password] )){

                $general= General::orderBy('id','ASC')->get()->last();

                $date_out= $general->end_subscription;
                $fechaEnd= mktime(
                    date_format(date_create($date_out), 'g'),
                    date_format(date_create($date_out), 'i'),
                    date_format(date_create($date_out), 's'),
                    date_format(date_create($date_out), 'm'),
                    date_format(date_create($date_out), 'd'),
                    date_format(date_create($date_out), 'Y'));

                $today = time();
                //$event = mktime(11,36,0,07,25,2019);
                $countdown = round(($fechaEnd - $today)/86400);
                
                session()->put('app_name', $general->nombre );
                session()->put('app_logo', $general->logo );
                session()->put('app_portada', $general->portada);
                session()->put('app_email', $general->email);
                session()->put('app_telefono', $general->telefono);

                return ('exito');
            }else{
                return ('incorrecto');
            }
        }

    }

    public function logout(Request $request)
    {
        if (session()->get('caja_id') != null){
            $ultima= Caja::where('cierre','=', null)->where('user_id','=', Auth()->user()->id )->orderBy('id','ASC')->get();
            if ($ultima->count() > 0){
                $cerrar= Caja::find($ultima->last()->id);
                $cerrar->cierre= date('Y-m-d H:i:s');
                $cerrar->save();
            }
            session()->forget('caja_id');
        }
        Auth::logout();
        return redirect::to('/');
    }

}
