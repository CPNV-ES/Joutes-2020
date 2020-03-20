<?php

namespace App\Http\Middleware;

use App\User;
use Illuminate\Support\Facades\Auth;
use Closure;

class DevLogin
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
        if (env('USER_ID', false))
        {   
            $user = User::find(env('USER_ID'));
            if ($user){
                if (Auth::attempt(['username' => $user->first_name, 'password' => 'Pa$$w0rd'])){
                    \Session::put('isDev', true);   
                    return $next($request);
                }else{
                    \Session::put('isDev', false);   
                    \Redirect::guest('login');
                }
            }else{
                \Redirect::to('events');
            }
        } else error_log("Prod");
        return $next($request);
    }
}

