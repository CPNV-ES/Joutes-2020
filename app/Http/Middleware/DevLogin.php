<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Support\Facades\Redirect;

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
                if (Auth::attempt(['username' => $user->username, 'password' => 'Pa$$w0rd'])){
                    \Session::put('isDev', true);
                    return $next($request);
                }else{
                    \Session::put('isDev', false);
                    Redirect::guest('login');
                }
            }else{
                \Session::put('isDev', false);
                Redirect::to('events');
            }

        }else{
            \Session::put('isDev', false);
            error_log("Prod");
        }

        return $next($request);
    }
}

