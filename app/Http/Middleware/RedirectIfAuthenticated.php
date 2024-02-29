<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {


                if(Auth::user()->role_id == 0){
                    
                    session(['pais_selected' => "Colombia"]);
                    return redirect('/usuario/dashboard-usuario');
              

                }elseif(Auth::user()->role_id == 1){

                   
                    return redirect('/usuario/select-country');
        
                }else{
        
                    return redirect(RouteServiceProvider::HOME);
                }
                
            }
        }

        return $next($request);
    }
}
