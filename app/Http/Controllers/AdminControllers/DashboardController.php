<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Paise;
use Auth;
use DB;

class DashboardController extends Controller
{



    public function __construct(Paise $paise)
    {

        $this->Paise = $paise;
    
    }

        /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardAdmin()
    {
        $data_permisos = array();
        $data_paises = array();
        $paises = $this->Paise->paginator();
        if(Auth::user()->permisos != NULL && Auth::user()->permisos != ""){

            $data_permisos = json_decode(Auth::user()->permisos, true);

        }
        foreach($paises as $value){

            if(isset($data_permisos[$value->name])){
                array_push($data_paises, $value->name);
            }



        }

        $resultData['permisos'] = $data_permisos;
        $resultData['paises'] = $data_paises;
        $resultData['paises_list'] = $paises;

        $pais_selected = session('pais_selected');



        $data = $this->Paise->data_by_name($pais_selected);

        $country_data = DB::table('data')->where('pais', $data->id)->get();



        $resultData['pais'] = $data;
        $resultData['menu'] = "admin";
        $resultData['sub-menu'] = "";
        $resultData['breadcrumb'] = "Admin";
        $resultData['breadcrumb2'] = "";
        return view('admin/dashboard-admin', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            // 'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
}
