<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        return view('login.main', [
            'layout' => 'login'
        ]);
    }

    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {

        if(\Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){


            if(Auth::user()->role_id == 0){
                    
                session(['pais_selected' => "Colombia"]);
                return redirect('/usuario/dashboard-usuario');

            }elseif(Auth::user()->role_id == 1){

               
                return redirect('/usuario/select-country');
    
            }else{
    
                return redirect(RouteServiceProvider::HOME);
            }



        }else{

            throw new \Exception('Wrong email or password.');


        }
        // if (!\Auth::attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ])) {
        //     throw new \Exception('Wrong email or password.');
        // }
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        \Auth::logout();
        return redirect('login');
    }
}
