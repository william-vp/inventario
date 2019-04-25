<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm(){
        $general= General::orderBy('id','ASC')->get()->last();      
        return view("Auth.register")->with("datos",$general);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $numEmail = User::where("email","=",$request->email)->count();
        if ($numEmail > 0){
            return ('maildup');
            return false;
        }

        $user = new User();
        if ($request->type == null or $request->type==''){
            $user->type = "USER";
        }else{
            $user->type = $request->type;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = 'user.png';
        $user->password= bcrypt($request->password);
        $user->save();

        $numEmail = User::where("email","=",$request->email)->count();
        if ($numEmail > 0){
            return ('exito');
        }else{
            return ('error');
        }
    }
}
