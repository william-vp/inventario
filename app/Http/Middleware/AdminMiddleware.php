<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*if (auth()->check() && auth()->user()->type == 'ADMIN')
            return $next($request);
            return redirect('/');*/
        $usuario=\Auth::user();
        if($usuario->type!= "ADMIN"){
            $notification = array( 'message' => 'No tienes permiso para entrar a esta pagina.',
                  'alert-type' => 'error',
            );
            return redirect('/denied')->with($notification);
        }
        return $next($request);
    }

}