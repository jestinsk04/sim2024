<?php

namespace App\Http\Middleware;

use Closure;

class LoggedIn
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (!is_null(request()->user())) {
        
                $role = request()->user()->role_id; 
                switch ($role) {
                  case 0:
                    session(['pais_selected' => "Colombia"]);
                    return redirect('/usuario/dashboard-usuario');
                    break;
                  case 1:
                    return redirect('/usuario/select-country');
                    break; 
              
                  default:
                    return redirect('/');
                  break;
                }
        
        
            // return redirect('/');
        } else {
            return $next($request);
        }
    }
}
