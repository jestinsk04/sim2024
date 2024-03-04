<?php

namespace App\Http\Controllers\UsuarioControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Paise;
use App\Models\User;
use Auth;
use DB;
use Carbon\Carbon;
use Hash;
use App\Mail\NewRequest;
use Mail;
use DataTables;
use DateTime;


class DashboardController extends Controller
{


    public function __construct(User $user, Paise $paise)
    {

        $this->User = $user;
        $this->Paise = $paise;
    
    }
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function selectCountry()
    {

        $data_permisos = array();
        $data_paises = array();
        $paises_autorizados = array();
        $paises = $this->Paise->paginator();
        if(Auth::user()->permisos != NULL && Auth::user()->permisos != ""){

            $data_permisos = json_decode(Auth::user()->permisos, true);

        }
        foreach($paises as $value){

            if(isset($data_permisos[$value->name])){
                array_push($data_paises, $value->name);
            }

            if($value->tipo == 0){

                $paises_autorizados[$value->iso] = "#2B7BD9";

            }elseif($value->tipo == 1){


                $paises_autorizados[$value->iso] = "#ED6C1C";

            }





        }

        // $paises_autorizados = array('VE'=>"#275886", 'CO'=>"#275886");

        $resultData['permisos'] = $data_permisos;
        $resultData['paises'] = $data_paises;
        $resultData['paises_list'] = $paises;
        $resultData['paises_autorizados'] = $paises_autorizados;

        
        


        $resultData['breadcrumb'] = "Seleccionar País";
        $resultData['menu'] = "select-country";
        $resultData['sub-menu'] = "";
        return view('usuarios/select-country', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'clear'
        ])->with('data', $resultData);;
    }


    public function selectedCountry(Request $request)
    {
        session(['pais_selected' => $request->pais]);
        return redirect('usuario/dashboard-usuario');
    }

    public function changeCountry(Request $request)
    {
        session(['pais_selected' => $request->pais]);
        return redirect()->back();
    }


    public function checkCountry(Request $request)
    {

        $country = $request->country;
        if(Auth::user()->permisos != NULL && Auth::user()->permisos != ""){

            $data_permisos = json_decode(Auth::user()->permisos, true);

        }

        $country_data = DB::table('paises')->where('iso', $country)->first();

        if(!empty($country_data)){


            if(isset($data_permisos[$country_data->name])){
                session(['pais_selected' => $country_data->name]);
                return 1;
            }else{
                return 0;
            }



        }else{




            return 0;
        }




        
        
    }

    public function sendRequest(Request $request)
    {

        $from = $request->from;
        $pais = $request->pais;
        $categoria = $request->categoria;
        $ano = $request->country;
        $name = $request->name;
        $email = $request->email;
        $observaciones = $request->observaciones;

        $country_data = DB::table('paises')->where('name', $pais)->first();

        if(!empty($country_data)){

            $email_destination = $country_data->email;

            $data_booking["email"] = $email;
            $data_booking["name"] = $name;
            $data_booking["from"] = $from;
            $data_booking["pais"] = $pais;
            $data_booking["categoria"] = $categoria;
            $data_booking["ano"] = $ano;
            $data_booking["observaciones"] = $observaciones;
    
            try{
              Mail::to($email_destination)->send(new NewRequest($data_booking));
            }catch(\Exception $e){
                               
                              }


            
                              return 1;


        }else{




            return 0;
        }



     




        
        
    }


        /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardOverview1()
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
        $current_year = date("Y");
        if(isset($request->year)){

            $current_year = $request->year;

        }
        $previous_year = date("Y",strtotime("-1 year"));

        

        $resultData['permisos'] = $data_permisos;
        $resultData['paises'] = $data_paises;
        $resultData['paises_list'] = $paises;

        $pais_selected = session('pais_selected');
        $data = $this->Paise->data_by_name($pais_selected);

        $country_data = DB::table('data')->where('pais', $data->id)->get();

        $data_pais["pib"] = "";
        $data_pais["pib_per_capita"] = "";
        $data_pais["inflacion"] = "";
        $data_pais["salario_minimo"] = "";
        $data_pais["tasa_cambio"] = "";
        $data_pais["big_mac"] = "";
        $data_pais["poblacion_activa"] = "";
        $data_pais["consumo_hpm"] = "";
        $data_pais["consumo_hpm_fuente"] = "";
        $data_pais["share_volumen"] = "";
        $data_pais["share_volumen_fuente"] = "";
        $data_pais["precio_compra"] = "";
        $data_pais["precio_compra_fuente"] = "";
        $data_pais["share_valor"] = "";
        $data_pais["share_valor_fuente"] = "";
        $data_pais["tasa_desempleo"] = "";
        $data_pais["plan_operativo_local_real"] = "";
        $data_pais["plan_operativo_local_plan"] = "";
        $data_pais["plan_operativo_local_cumplimiento"] = "";
        $data_pais["plan_operativo_local_restante"] = "";
        $data_pais["plan_operativo_export_real"] = "";
        $data_pais["plan_operativo_export_plan"] = "";
        $data_pais["plan_operativo_export_cumplimiento"] = "";
        $data_pais["plan_operativo_export_restante"] = "";
        $data_pais["canasta_alimentaria_normativa"] = "";

        $data_pais["pib_fuente"] = "";
        $data_pais["pib_variacion"] = "";
        $data_pais["pib_per_capita_fuente"] = "";
        $data_pais["pib_per_capita_variacion"] = "";
        $data_pais["inflacion_fuente"] = "";
        $data_pais["inflacion_variacion"] = "";
        $data_pais["salario_minimo_fuente"] = "";
        $data_pais["salario_minimo_variacion"] = "";
        $data_pais["tasa_cambio_fuente"] = "";
        $data_pais["tasa_cambio_variacion"] = "";
        $data_pais["big_mac_fuente"] = "";
        $data_pais["big_mac_variacion"] = "";
        $data_pais["poblacion_activa_fuente"] = "";
        $data_pais["poblacion_activa_variacion"] = "";
        $data_pais["tasa_desempleo_fuente"] = "";
        $data_pais["tasa_desempleo_variacion"] = "";

        $replace = array("$", "%", ",");

        if(count($country_data) > 0){


            foreach($country_data as $valor){

                if($valor->item == 'pib_(usd_mm)'){

                    $data_pais["pib"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["pib_fuente"] = $valor->fuente;
                    $data_pais["pib_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'pib_(usd_mm)')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["pib_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'canasta_alimentaria_normativa'){

                    $data_pais["canasta_alimentaria_normativa"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["canasta_alimentaria_normativa_fuente"] = $valor->fuente;
                    $data_pais["canasta_alimentaria_normativa_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'canasta_alimentaria_normativa')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["canasta_alimentaria_normativa_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'pib_per_capital'){

                    $data_pais["pib_per_capita"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["pib_per_capita_fuente"] = $valor->fuente;
                    $data_pais["pib_per_capita_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'pib_per_capital')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["pib_per_capita_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'inflacion_(usd_mm)'){
                    
                    $data_pais["inflacion"] = number_format(str_replace($replace, "", $valor->dato ?? 0) * 100,"1", ",",".");
                    $data_pais["inflacion_fuente"] = $valor->fuente;
                    $data_pais["inflacion_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'inflacion_(usd_mm)')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["inflacion_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'salario_minimo'){
                    
                    $data_pais["salario_minimo"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"0", ",",".");
                    $data_pais["salario_minimo_fuente"] = $valor->fuente;
                    $data_pais["salario_minimo_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'salario_minimo')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["salario_minimo_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'tasa_de_cambio'){
                    
                    $data_pais["tasa_cambio"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["tasa_cambio_fuente"] = $valor->fuente;
                    $data_pais["tasa_cambio_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'tasa_de_cambio')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["tasa_cambio_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'indice_big_mac'){
                    
                    $data_pais["big_mac"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["big_mac_fuente"] = $valor->fuente;
                    $data_pais["big_mac_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'indice_big_mac')->first();

                    if(!empty($country_data_last_year)){

                        if($country_data_last_year->dato != 0){

                            $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                            $variacion_porcentaje = $variacion * 100;
                            $data_pais["big_mac_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");
                        }

                       

                    }

                }elseif($valor->item == 'poblacion_activa'){
                    
                    $replace_ = array("$", "%", ",");
                    $data_pais["poblacion_activa"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"0", ",",".");
                    $data_pais["poblacion_activa_fuente"] = $valor->fuente;
                    $data_pais["poblacion_activa_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'poblacion_activa')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace_, "", $valor->dato)/str_replace($replace_, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["poblacion_activa_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'tasa_de_desempleo'){
                    
                    
                    $data_pais["tasa_desempleo"] = number_format(str_replace($replace, "", $valor->dato ?? 0 )* 100,"1", ",",".");
                    $data_pais["tasa_desempleo_fuente"] = $valor->fuente;
                    $data_pais["tasa_desempleo_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'tasa_de_desempleo')->first();

                    if(!empty($country_data_last_year)){

                        if(!is_null($valor->dato) && !is_null($country_data_last_year->dato)){

                       
                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["tasa_desempleo_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");
                    }

                    }

                }elseif($valor->item == 'consumo_hpm'){
                    
                    $data_pais["consumo_hpm"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["consumo_hpm_fuente"] = $valor->fuente;

                }elseif($valor->item == 'precio_compra_mb-ep_($/toneladas)'){
                    
                    $data_pais["precio_compra"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["precio_compra_fuente"] = $valor->fuente;

                }elseif($valor->item == 'share_volumen'){
                    
                    $data_pais["share_volumen"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["share_volumen_fuente"] = $valor->fuente;

                }elseif($valor->item == 'share_valor'){
                    
                    $data_pais["share_valor"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["share_valor_fuente"] = $valor->fuente;

                }elseif($valor->item == 'plan_operativo_local'){
                    
                    $data_pais["plan_operativo_local_real"] = $valor->dato ?? 0;
                    $data_pais["plan_operativo_local_plan"] = $valor->dato_2 ?? 0;
                    $data_pais["plan_operativo_local_cumplimiento"] = $valor->dato_3*100;
                    $data_pais["plan_operativo_local_restante"] = 100-($valor->dato_3*100);

                }elseif($valor->item == 'plan_operativo_export'){
                    
                    $data_pais["plan_operativo_export_real"] = $valor->dato ?? 0;
                    $data_pais["plan_operativo_export_plan"] = $valor->dato_2 ?? 0;
                    $data_pais["plan_operativo_export_cumplimiento"] = $valor->dato_3*100;
                    $data_pais["plan_operativo_export_restante"] = 100-($valor->dato_3*100);

                }




            }




        }

        $labels = array();
        $dataset = array();
        
        $kpi2_data = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-2")->get()->unique('name');
        $kpi2_data_labels = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-2")->get()->unique('ano');
        $kpi2_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-2")->get();


        if(count($kpi2_data) > 0){

            foreach($kpi2_data as $value){

                $dataset[$value->item] = array();

            }


        }


        if(count($kpi2_data_labels) > 0){

            foreach($kpi2_data_labels as $value){


                    $format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels, $format_data);

            }


        }

        if(count($kpi2_data_grafico) > 0){


                    foreach($kpi2_data_grafico as $valor){

                        
                        array_push($dataset[$valor->item], $valor->dato);

                    }



        }


        $kpi3_data = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-3")->get();

        $kpi4_data = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-4")->get();


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();

        $country_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-1")->get();

        $data_pais["poblacion_total"] = "";
        $data_pais["poblacion_total_fuente"] = "";
        $data_pais["diaspora"] = "";
        $data_pais["diaspora_fuente"] = "";
        $data_pais["hogares"] = "";
        $data_pais["hogares_fuente"] = "";
        $data_pais["personas_hogar"] = "";
        $data_pais["personas_hogar_fuente"] = "";


        if(count($country_data) > 0){


            foreach($country_data as $valor){

                if($valor->item == 'poblacion_total'){

                    $data_pais["poblacion_total"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"0", ",",".");;
                    $data_pais["poblacion_total_fuente"] = $valor->fuente;
                    $data_pais["poblacion_total_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'poblacion_total')->first();

                    if(!empty($country_data_last_year)){
                        if(!is_null($country_data_last_year->dato) && !is_null($valor->dato) && $country_data_last_year->dato!= 0){
                        $replace_ = array("$", "%", ".");
                        $variacion = str_replace($replace_, "", $valor->dato)/str_replace($replace_, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["poblacion_total_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");
                        }

                    }

                }elseif($valor->item == 'diaspora_venezolana'){

                    $data_pais["diaspora"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"0", ",",".");;
                    $data_pais["diaspora_fuente"] = $valor->fuente;
                    $data_pais["diaspora_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'diaspora_venezolana')->first();

                    if(!empty($country_data_last_year)){
                        if(!is_null($country_data_last_year->dato) && !is_null($valor->dato) && $country_data_last_year->dato!= 0){
                        $replace_ = array("$", "%", ".");
                        $variacion = str_replace($replace_, "", $valor->dato)/str_replace($replace_, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["diaspora_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");
                        }

                    }

                }elseif($valor->item == 'total_hogares'){
                    
                    $data_pais["hogares"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"0", ",",".");;
                    $data_pais["hogares_fuente"] = $valor->fuente;
                    $data_pais["hogares_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'total_hogares')->first();

                    if(!empty($country_data_last_year)){

                        if(!is_null($country_data_last_year->dato) && !is_null($valor->dato) && $country_data_last_year->dato!= 0){

                            $replace_ = array("$", "%", ".");
                            $variacion = str_replace($replace_, "", $valor->dato)/str_replace($replace_, "", $country_data_last_year->dato);
                            $variacion_porcentaje = $variacion * 100;
                            $data_pais["hogares_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");
                        }
                        

                    }

                }elseif($valor->item == '_personas_por_hogar'){
                    
                    $data_pais["personas_hogar"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"1", ",",".");;
                    $data_pais["personas_hogar_fuente"] = $valor->fuente;
                    $data_pais["personas_hogar_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', '_personas_por_hogar')->first();

                    if(!empty($country_data_last_year)){

                        if(!is_null($country_data_last_year->dato) && !is_null($valor->dato) && $country_data_last_year->dato!= 0){
                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["personas_hogar_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                        }

                    }

                }




            }




        }

        $demografico2_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-2")->get();



        $labels = array();
        $dataset = array();
        $dataset2 = array();
        $colors = array();
        $demografico3_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-3")->get()->unique('name');
        $demografico3_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-3")->get();


        if(count($demografico3_data) > 0){

            foreach($demografico3_data as $value){

                $dataset[$value->item] = array();
                array_push($labels, $value->name);
            }


        }


    

        if(count($demografico3_data_grafico) > 0){


                    foreach($demografico3_data_grafico as $key => $valor){

                        
                        
                        array_push($dataset2, $valor->dato_2*100);

                        if ($key % 2 == 0) {
                            array_push($colors, "#35495e");
                        }else{
                            array_push($colors, "#2778f0");
                        }



                    }



        }


        $labels_demografico7 = array();
        $dataset_demografico7 = array();
        $dataset2_demografico7 = array();
        $colors_demografico7 = array();
        $demografico7_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-7")->get()->unique('name');
        $demografico7_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-7")->get();


        if(count($demografico7_data) > 0){

            foreach($demografico7_data as $value){

                $dataset_demografico7[$value->item] = array();
                array_push($labels_demografico7, $value->name);
            }


        }


    

        if(count($demografico7_data_grafico) > 0){


                    foreach($demografico7_data_grafico as $key => $valor){

                        
                        
                        array_push($dataset2_demografico7, $valor->dato_2);

                        if ($key % 2 == 0) {
                            array_push($colors_demografico7, "#35495e");
                        }else{
                            array_push($colors_demografico7, "#2778f0");
                        }



                    }



        }

        $labels_demografico5 = array();
        $dataset_hombres_demografico5 = array();
        $dataset_mujeres_demografico5 = array();
        $colors_demografico5 = array();
        $demografico5_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-5")->where('ano', $current_year)->orderBy('item')->get()->unique('name');
        $demografico5_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-5")->where('ano', $current_year)->orderBy('item')->get();

        $demografico_5_ano = "";
        if(count($demografico5_data) > 0){

            $demografico_5_ano = $demografico5_data[0]->ano;
            foreach($demografico5_data as $value){

          
                array_push($labels_demografico5, $value->name);
            }


        }


    

        if(count($demografico5_data_grafico) > 0){


                    foreach($demografico5_data_grafico as $key => $valor){

                        
                        
                        array_push($dataset_hombres_demografico5, ($valor->dato_2));
                        array_push($dataset_mujeres_demografico5, ($valor->dato_4));

                        



                    }



        }


        $labels_demografico5_old = array();
        $dataset_hombres_demografico5_old = array();
        $dataset_mujeres_demografico5_old = array();
        $colors_demografico5_old = array();
        $demografico5_data_old = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-5")->where('ano', $previous_year)->orderBy('item')->get()->unique('name');
        $demografico5_data_grafico_old = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-5")->where('ano', $previous_year)->orderBy('item')->get();

        $demografico_5_ano_old = "";
        if(count($demografico5_data_old) > 0){

            $demografico_5_ano_old = $demografico5_data_old[0]->ano;
            foreach($demografico5_data_old as $value){

          
                array_push($labels_demografico5_old, $value->name);
            }


        }


    

        if(count($demografico5_data_grafico_old) > 0){


                    foreach($demografico5_data_grafico_old as $key => $valor){

                        
                        
                        array_push($dataset_hombres_demografico5_old, ($valor->dato_2));
                        array_push($dataset_mujeres_demografico5_old, ($valor->dato_4));

                        



                    }



        }


        $labels_demografico6 = array();
        $dataset_demografico6 = array();
        $dataset2_demografico6 = array();
        $colors_demografico6 = array();
        $demografico6_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year)->get()->unique('name');
        $demografico6_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year)->get();


        if(count($demografico6_data) == 0){

            $demografico6_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year-1)->get()->unique('name');
            $demografico6_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year-1)->get();

            if(count($demografico6_data) == 0){

                $demografico6_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year-2)->get()->unique('name');
                $demografico6_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year-2)->get();

                if(count($demografico6_data) == 0){

                    $demografico6_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year-3)->get()->unique('name');
                    $demografico6_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year-3)->get();

                    if(count($demografico6_data) == 0){

                        $demografico6_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year-4)->get()->unique('name');
                        $demografico6_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year-4)->get();

                        if(count($demografico6_data) == 0){

                            $demografico6_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year-5)->get()->unique('name');
                            $demografico6_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->where('ano', $previous_year-5)->get();
                
                        }
            
                    }
        
                }
    
            }

        }
        


        if(count($demografico6_data) > 0){

            foreach($demografico6_data as $value){

                $dataset_demografico6[$value->item] = array();
                array_push($labels_demografico6, $value->name);
            }


        }
        if(count($demografico6_data_grafico) > 0){


            foreach($demografico6_data_grafico as $key => $valor){

                
                
                array_push($dataset2_demografico6, ($valor->dato*100));

                if ($key % 2 == 0) {
                    array_push($colors_demografico6, "#35495e");
                }else{
                    array_push($colors_demografico6, "#2778f0");
                }



            }



        }


        $dataset_demografico4 = array();
        $demografico4_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-4")->get();


        if(count($demografico4_data_grafico) > 0){
                    foreach($demografico4_data_grafico as $key => $valor){

                        $dat = number_format(($valor->dato_2*100),"2",",",".");

                        $element = array($valor->name, round(($valor->dato_2*100), 2));
                        
                        array_push($dataset_demografico4, $element);

                    }

        }

        $resultData['deficit'] = "0";
        $resultData['deficit_fuente'] = "";
        $resultData['reservas'] = "0";
        $resultData['reservas_fuente'] = "";
        $resultData['tasa'] = "0";
        $resultData['tasa_fuente'] = "";
        $resultData['trm'] = "0";
        $resultData['trm_fuente'] = "";

        $ventas_1 = DB::table('ventas')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "ventas-1")->get();

        foreach( $ventas_1 as $value){

            if($value->name == "DEFICIT FISCAL"){

                $resultData['deficit'] = $value->valor;
                $resultData['deficit_fuente'] = $value->fuente;

            }else if($value->name == "RESERVAS INTERNACIONALES"){

                $resultData['reservas'] = $value->valor;
                $resultData['reservas_fuente'] = $value->fuente;

            }else if($value->name == "TASA DE INTERES"){

                $resultData['tasa'] =  number_format(str_replace($replace, "", $value->valor ?? 0 )* 100,"1", ",",".");
                $resultData['tasa_fuente'] = $value->fuente;
            }else if($value->name == "TRM"){

                $resultData['trm'] = $value->valor;
                $resultData['trm_fuente'] = $value->fuente;

            }


        }


        $labels_comodities = array();
        $dataset_comodities['item'] = array();
        $resultData['item_name'] = "";

        $labels_comodities2 = array();
        $dataset_comodities2['item'] = array();
    
        

        $comodities_data_labels = DB::table('data')->where('item',"canasta_alimentaria_normativa")->where('pais', 6)->orderByRaw("STR_TO_DATE(fecha_actualizacion, '%d/%m/%y')")->get()->unique('fecha_actualizacion');
        $comodities_anos = DB::table('data')->where('seccion', "comodities")->where('pais', 6)->get()->unique('ano');
        $comodities_data_grafico = DB::table('data')->where('item', "canasta_alimentaria_normativa")->where('pais', 6)->orderByRaw("STR_TO_DATE(fecha_actualizacion, '%d/%m/%y')")->get();





        if(count($comodities_data_labels) > 0){

            foreach($comodities_data_labels as $value){


                setlocale(LC_TIME, 'es_ES.UTF-8');
                $date = DateTime::createFromFormat('d/m/y', $value->fecha_actualizacion);
                $monthName = strftime('%B', $date->getTimestamp());
                $year = strftime('%Y', $date->getTimestamp());
                //$format_data = date("M", strtotime($value->fecha_actualizacion));
                array_push($labels_comodities, $monthName."-".$year);

            }


        }

        if(count($comodities_data_grafico) > 0){


                    foreach($comodities_data_grafico as $valor){
                        

                        
                        array_push($dataset_comodities['item'], $valor->dato);

                        

                    }



        }


        $comodities_data_labels2 = DB::table('data')->where('item',"canasta_alimentaria_normativa")->where('pais', 5)->orderByRaw("STR_TO_DATE(fecha_actualizacion, '%d/%m/%y')")->get()->unique('fecha_actualizacion');
        $comodities_anos2 = DB::table('data')->where('seccion', "comodities")->where('pais', 5)->get()->unique('ano');
        $comodities_data_grafico2 = DB::table('data')->where('item', "canasta_alimentaria_normativa")->where('pais', 5)->orderByRaw("STR_TO_DATE(fecha_actualizacion, '%d/%m/%y')")->get();





        if(count($comodities_data_labels2) > 0){

            foreach($comodities_data_labels2 as $value){


                setlocale(LC_TIME, 'es_ES.UTF-8');
                $date = DateTime::createFromFormat('d/m/y', $value->fecha_actualizacion);
                $monthName = strftime('%B', $date->getTimestamp());
                $year = strftime('%Y', $date->getTimestamp());
                //$format_data = date("M", strtotime($value->fecha_actualizacion));
                array_push($labels_comodities2, $monthName."-".$year);

            }


        }

        if(count($comodities_data_grafico2) > 0){


                    foreach($comodities_data_grafico2 as $valor){
                        

                        
                        array_push($dataset_comodities2['item'], $valor->dato);

                        

                    }



        }


        $resultData['dataset_comodities'] = $dataset_comodities;
        $resultData['labels_comodities'] = $labels_comodities;

        $resultData['dataset_comodities2'] = $dataset_comodities2;
        $resultData['labels_comodities2'] = $labels_comodities2;

        
        $resultData['demografico2_data'] = $demografico2_data;
        $resultData['demografico3_data'] = $demografico3_data;
        $resultData['demografico3_data_grafico'] = $demografico3_data_grafico;
        $resultData['demografico3_labels'] = $labels;
        $resultData['demografico3_dataset'] = $dataset2;
        $resultData['demografico3_colors'] = $colors;

        $resultData['demografico7_data'] = $demografico7_data;
        $resultData['demografico7_data_grafico'] = $demografico7_data_grafico;
        $resultData['demografico7_labels'] = $labels_demografico7;
        $resultData['demografico7_dataset'] = $dataset2_demografico7;
        $resultData['demografico7_colors'] = $colors_demografico7;

        $resultData['demografico5_data'] = $demografico5_data;
        $resultData['demografico5_data_grafico'] = $demografico5_data_grafico;
        $resultData['demografico5_labels'] = $labels_demografico5;
        $resultData['demografico5_dataset_hombres'] = $dataset_hombres_demografico5;
        $resultData['demografico5_dataset_mujeres'] = $dataset_mujeres_demografico5;
        $resultData['demografico5_colors'] = $colors_demografico5;
        $resultData['demografico5_ano'] = $demografico_5_ano;

        $resultData['demografico5_data_old'] = $demografico5_data_old;
        $resultData['demografico5_data_grafico'] = $demografico5_data_grafico_old;
        $resultData['demografico5_labels_old'] = $labels_demografico5_old;
        $resultData['demografico5_dataset_hombres_old'] = $dataset_hombres_demografico5_old;
        $resultData['demografico5_dataset_mujeres_old'] = $dataset_mujeres_demografico5_old;
        $resultData['demografico5_colors_old'] = $colors_demografico5_old;
        $resultData['demografico5_ano_old'] = $demografico_5_ano_old;
        $resultData['current_year'] = $current_year;
        $resultData['previous_year'] = $previous_year;

        $resultData['demografico6_data'] = $demografico6_data;
        $resultData['demografico6_data_grafico'] = $demografico6_data_grafico;
        $resultData['demografico6_labels'] = $labels_demografico6;
        $resultData['demografico6_dataset'] = $dataset2_demografico6;
        $resultData['demografico6_colors'] = $colors_demografico6;

        $resultData['dataset_demografico4'] = $dataset_demografico4;


        $resultData['notificaciones'] = $notificaciones;
        
            
        $resultData['colores'] = [];

        for ($i = 0; $i < 100; $i++) {
            $resultData['colores'][] = self::generateRandomHexColor($resultData['colores']);
        }
        //$resultData['colores'] = array("#35495e", "#84cc16", "#facc15","#dc2727", "#fa09e2", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#000000" );
        $resultData['pais'] = $data;
        $resultData['data'] = $data_pais;
        $resultData['kpi2_data'] = $kpi2_data;
        $resultData['kpi2_data_grafico'] = $kpi2_data_grafico;
        $resultData['kpi2_labels'] = $labels;
        $resultData['kpi2_dataset'] = $dataset;
        $resultData['kpi4_data'] = $kpi4_data;
        
        $resultData['menu'] = "kpi";
        $resultData['sub-menu'] = "";
        $resultData['breadcrumb'] = "KPI´s";
        $resultData['breadcrumb2'] = "Dashboard";
        return view('usuarios/dashboard-overview-1', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            // 'layout' => 'side-menu'
        ])->with('data', $resultData);
    }

    public function dashboardDemografico()
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
        $previous_year = date("Y",strtotime("-1 year"));
        $current_year = date("Y",strtotime("-1 year"));
        $replace = array("$", "%", ".");


        $resultData['permisos'] = $data_permisos;
        $resultData['paises'] = $data_paises;
        $resultData['paises_list'] = $paises;

        $pais_selected = session('pais_selected');
        $data = $this->Paise->data_by_name($pais_selected);

        $country_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-1")->get();

        $data_pais["poblacion_total"] = "";
        $data_pais["poblacion_total_fuente"] = "";
        $data_pais["diaspora"] = "";
        $data_pais["diaspora_fuente"] = "";
        $data_pais["hogares"] = "";
        $data_pais["hogares_fuente"] = "";
        $data_pais["personas_hogar"] = "";
        $data_pais["personas_hogar_fuente"] = "";


        if(count($country_data) > 0){


            foreach($country_data as $valor){

                if($valor->item == 'poblacion_total'){

                    $data_pais["poblacion_total"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");;
                    $data_pais["poblacion_total_fuente"] = $valor->fuente;
                    $data_pais["poblacion_total_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'poblacion_total')->first();

                    if(!empty($country_data_last_year)){
                        if(!is_null($country_data_last_year->dato) && !is_null($valor->dato) && $country_data_last_year->dato!= 0){
                        $replace_ = array("$", "%", ".");
                        $variacion = str_replace($replace_, "", $valor->dato)/str_replace($replace_, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["poblacion_total_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");
                        }

                    }

                }elseif($valor->item == 'diaspora_venezolana'){

                    $data_pais["diaspora"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");;
                    $data_pais["diaspora_fuente"] = $valor->fuente;
                    $data_pais["diaspora_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'diaspora_venezolana')->first();

                    if(!empty($country_data_last_year)){
                        if(!is_null($country_data_last_year->dato) && !is_null($valor->dato) && $country_data_last_year->dato!= 0){
                        $replace_ = array("$", "%", ".");
                        $variacion = str_replace($replace_, "", $valor->dato)/str_replace($replace_, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["diaspora_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");
                        }

                    }

                }elseif($valor->item == 'total_hogares'){
                    
                    $data_pais["hogares"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");;
                    $data_pais["hogares_fuente"] = $valor->fuente;
                    $data_pais["hogares_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'total_hogares')->first();

                    if(!empty($country_data_last_year)){

                        if(!is_null($country_data_last_year->dato) && !is_null($valor->dato) && $country_data_last_year->dato!= 0){

                            $replace_ = array("$", "%", ".");
                            $variacion = str_replace($replace_, "", $valor->dato)/str_replace($replace_, "", $country_data_last_year->dato);
                            $variacion_porcentaje = $variacion * 100;
                            $data_pais["hogares_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");
                        }
                        

                    }

                }elseif($valor->item == '_personas_por_hogar'){
                    
                    $data_pais["personas_hogar"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");;
                    $data_pais["personas_hogar_fuente"] = $valor->fuente;
                    $data_pais["personas_hogar_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', '_personas_por_hogar')->first();

                    if(!empty($country_data_last_year)){

                        if(!is_null($country_data_last_year->dato) && !is_null($valor->dato) && $country_data_last_year->dato!= 0){
                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["personas_hogar_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                        }

                    }

                }




            }




        }

        $demografico2_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-2")->get();



        $labels = array();
        $dataset = array();
        $dataset2 = array();
        $colors = array();
        $demografico3_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-3")->get()->unique('name');
        $demografico3_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-3")->get();


        if(count($demografico3_data) > 0){

            foreach($demografico3_data as $value){

                $dataset[$value->item] = array();
                array_push($labels, $value->name);
            }


        }


    

        if(count($demografico3_data_grafico) > 0){


                    foreach($demografico3_data_grafico as $key => $valor){

                        
                        
                        array_push($dataset2, $valor->dato_2);

                        if ($key % 2 == 0) {
                            array_push($colors, "#35495e");
                        }else{
                            array_push($colors, "#2778f0");
                        }



                    }



        }


        $labels_demografico7 = array();
        $dataset_demografico7 = array();
        $dataset2_demografico7 = array();
        $colors_demografico7 = array();
        $demografico7_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-7")->get()->unique('name');
        $demografico7_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-7")->get();


        if(count($demografico7_data) > 0){

            foreach($demografico7_data as $value){

                $dataset_demografico7[$value->item] = array();
                array_push($labels_demografico7, $value->name);
            }


        }


    

        if(count($demografico7_data_grafico) > 0){


                    foreach($demografico7_data_grafico as $key => $valor){

                        
                        
                        array_push($dataset2_demografico7, $valor->dato);

                        if ($key % 2 == 0) {
                            array_push($colors_demografico7, "#35495e");
                        }else{
                            array_push($colors_demografico7, "#2778f0");
                        }



                    }



        }

        $labels_demografico5 = array();
        $dataset_hombres_demografico5 = array();
        $dataset_mujeres_demografico5 = array();
        $colors_demografico5 = array();
        $demografico5_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-5")->get()->unique('name');
        $demografico5_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-5")->get();

        $demografico_5_ano = "";
        if(count($demografico5_data) > 0){

            $demografico_5_ano = $demografico5_data[0]->ano;
            foreach($demografico5_data as $value){

          
                array_push($labels_demografico5, $value->name);
            }


        }


    

        if(count($demografico5_data_grafico) > 0){


                    foreach($demografico5_data_grafico as $key => $valor){

                        
                        
                        array_push($dataset_hombres_demografico5, ($valor->dato_2*100));
                        array_push($dataset_mujeres_demografico5, ($valor->dato_4*100));

                        



                    }



        }


        $labels_demografico6 = array();
        $dataset_demografico6 = array();
        $dataset2_demografico6 = array();
        $colors_demografico6 = array();
        $demografico6_data = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->get()->unique('name');
        $demografico6_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "demografico-6")->get();


        if(count($demografico6_data) > 0){

            foreach($demografico6_data as $value){

                $dataset_demografico6[$value->item] = array();
                array_push($labels_demografico6, $value->name);
            }


        }


    

        if(count($demografico6_data_grafico) > 0){


                    foreach($demografico6_data_grafico as $key => $valor){

                        
                        
                        array_push($dataset2_demografico6, ($valor->dato*100));

                        if ($key % 2 == 0) {
                            array_push($colors_demografico6, "#35495e");
                        }else{
                            array_push($colors_demografico6, "#2778f0");
                        }



                    }



        }

        $resultData['pais'] = $data;
        $resultData['data'] = $data_pais;
        $resultData['demografico2_data'] = $demografico2_data;
        $resultData['demografico3_data'] = $demografico3_data;
        $resultData['demografico3_data_grafico'] = $demografico3_data_grafico;
        $resultData['demografico3_labels'] = $labels;
        $resultData['demografico3_dataset'] = $dataset2;
        $resultData['demografico3_colors'] = $colors;

        $resultData['demografico7_data'] = $demografico7_data;
        $resultData['demografico7_data_grafico'] = $demografico7_data_grafico;
        $resultData['demografico7_labels'] = $labels_demografico7;
        $resultData['demografico7_dataset'] = $dataset2_demografico7;
        $resultData['demografico7_colors'] = $colors_demografico7;

        $resultData['demografico5_data'] = $demografico5_data;
        $resultData['demografico5_data_grafico'] = $demografico5_data_grafico;
        $resultData['demografico5_labels'] = $labels_demografico5;
        $resultData['demografico5_dataset_hombres'] = $dataset_hombres_demografico5;
        $resultData['demografico5_dataset_mujeres'] = $dataset_mujeres_demografico5;
        $resultData['demografico5_colors'] = $colors_demografico5;
        $resultData['demografico5_ano'] = $demografico_5_ano;

        $resultData['demografico6_data'] = $demografico6_data;
        $resultData['demografico6_data_grafico'] = $demografico6_data_grafico;
        $resultData['demografico6_labels'] = $labels_demografico6;
        $resultData['demografico6_dataset'] = $dataset2_demografico6;
        $resultData['demografico6_colors'] = $colors_demografico6;


        $resultData['menu'] = "kpi";
        $resultData['sub-menu'] = "";
        $resultData['breadcrumb'] = "KPI´s";
        $resultData['breadcrumb2'] = "Demografico";

        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;


        return view('usuarios/dashboard-demografico', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            // 'layout' => 'side-menu'
        ])->with('data', $resultData);
    }

    public function mercadoHarinas()
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
        $resultData['paises'] = $data_paises;
        $resultData['secciones'] = $data_secciones;
        $resultData['subsecciones'] = $data_subsecciones;
        $resultData['dashboard'] = $data_dashboard;
        $resultData['menu'] = "analisis-mercado";
        $resultData['sub-menu'] = "";
        $resultData['breadcrumb'] = "Investigación de mercado";
        $resultData['breadcrumb2'] = "Harinas";

        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;


        return view('usuarios/mercado-harinas', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            // 'layout' => 'side-menu'
        ])->with('data', $resultData);
    }

    public function valoracionMercado()
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

        $current_year = date("Y");
        if(isset($request->year)){

            $current_year = $request->year;

        }


        $valoracion_mercado_1 = array();
        $valoracion_mercado_2_data = array();
        $valoracion_mercado_2_anos = array();
        $valoracion_mercado_2_names = array();
        $valoracion_mercado_3 = array();
        

        $valoracion_mercado_1 = DB::table('valoracion_mercado')->where('pais', $data->id)->where('seccion', "informes")->get();
        $valoracion_mercado_2_anos = DB::table('valoracion_mercado')->where('pais', $data->id)->where('seccion', "grafico-1")->get()->unique('ano');
        $valoracion_mercado_2_names = DB::table('valoracion_mercado')->where('pais', $data->id)->where('seccion', "grafico-1")->get()->unique('name');
        $valoracion_mercado_3 = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "grafico-2")->get();

        if(count($valoracion_mercado_2_anos)>0){

            $cnt = 0;

            foreach($valoracion_mercado_2_anos as $value){

                

                $query = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $value->ano)->where('seccion', "grafico-1")->get();

                if(count($query)>0){


                    foreach($query as $valor){

                        $_data = array();

                        $valoracion_mercado_2_data[$valor->ano][$valor->name]['nombre'] = $valor->name;
                        $valoracion_mercado_2_data[$valor->ano][$valor->name]['dato'] = $valor->dato*100;
                        $valoracion_mercado_2_data[$valor->ano][$valor->name]['ano'] = $valor->ano;

                        // if(!empty($_data)){

                        //     array_push($valoracion_mercado_2_data, $_data);
                        // }



                    }




                }



                $cnt++;



            }



        }


        $labels_grafico_1 = array();
        $dataset_grafico_1 = array();
        $dataset2_grafico_1 = array();
        $colors_grafico_1 =array("#35495e","#2778f0","#1f30b4", "#0ca73a", "#aa311a", "#da8e21", "#422d0e", "#b04152");
        $grafico_1_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "grafico-1")->get()->unique('name');
        $grafico_1_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "grafico-1")->get();

        if(count($grafico_1_data_grafico)==0){

            $grafico_1_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', ($current_year-1))->where('seccion', "grafico-1")->get();
            $grafico_1_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year-1)->where('seccion', "grafico-1")->get()->unique('name');

            if(count( $grafico_1_data_grafico) == 0){

                $grafico_1_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', ($current_year-2))->where('seccion', "grafico-1")->get();
                $grafico_1_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year-2)->where('seccion', "grafico-1")->get()->unique('name');

                if(count( $grafico_1_data_grafico) == 0){

                    $grafico_1_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', ($current_year-3))->where('seccion', "grafico-1")->get();
                    $grafico_1_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year-3)->where('seccion', "grafico-1")->get()->unique('name');

                    if(count( $grafico_1_data_grafico) == 0){

                        $grafico_1_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', ($current_year-4))->where('seccion', "grafico-1")->get();
                        $grafico_1_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year-4)->where('seccion', "grafico-1")->get()->unique('name');


                        if(count( $grafico_1_data_grafico) == 0){

                            $grafico_1_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', ($current_year-5))->where('seccion', "grafico-1")->get();
                            $grafico_1_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year-5)->where('seccion', "grafico-1")->get()->unique('name');
            
                        }
        
                    }
    
                }

            }
        }


        if(count($grafico_1_data) > 0){

            foreach($grafico_1_data as $value){

                $dataset_grafico_1[$value->name] = array();
                array_push($labels_grafico_1, $value->name);

                // $query = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year)->where('name', $value->name)->where('seccion', "grafico-1")->get();

                // if(count($query) > 0){

                //     array_push($dataset2_grafico_1, ($valor->dato*100));
                // }else{
                //     array_push($dataset2_grafico_1, 0);
                // }
                
            }


        }


    

        if(count($grafico_1_data_grafico) > 0){


                    foreach($grafico_1_data_grafico as $key => $valor){

                        
                        
                        array_push($dataset2_grafico_1, ($valor->dato*100));

                        // if ($key % 2 == 0) {
                        //     array_push($colors_grafico_1, "#35495e");
                        // }else{
                        //     array_push($colors_grafico_1, "#2778f0");
                        // }



                    }



        }



        $labels_grafico_2 = array();
        $dataset_grafico_2 = array();
        $dataset2_grafico_2 = array();
        $colors_grafico_2 = array();
        $grafico_2_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "grafico-2")->get()->unique('name');

        $grafico_2_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "grafico-2")->get();

        if(count($grafico_2_data_grafico)==0){

            $grafico_2_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', ($current_year-1))->where('seccion', "grafico-2")->get();
            $grafico_2_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year-1)->where('seccion', "grafico-2")->get()->unique('name');

            if(count( $grafico_2_data_grafico) == 0){

                $grafico_2_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', ($current_year-2))->where('seccion', "grafico-2")->get();
                $grafico_2_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year-2)->where('seccion', "grafico-2")->get()->unique('name');

                if(count( $grafico_2_data_grafico) == 0){

                    $grafico_2_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', ($current_year-3))->where('seccion', "grafico-2")->get();
                    $grafico_2_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year-3)->where('seccion', "grafico-2")->get()->unique('name');

                    if(count( $grafico_2_data_grafico) == 0){

                        $grafico_2_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', ($current_year-4))->where('seccion', "grafico-2")->get();
                        $grafico_2_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year-4)->where('seccion', "grafico-2")->get()->unique('name');


                        if(count( $grafico_2_data_grafico) == 0){

                            $grafico_2_data_grafico = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', ($current_year-5))->where('seccion', "grafico-2")->get();
                            $grafico_2_data = DB::table('valoracion_mercado')->where('pais', $data->id)->where('ano', $current_year-5)->where('seccion', "grafico-2")->get()->unique('name');
            
                        }
        
                    }
    
                }

            }
        }


        if(count($grafico_2_data) > 0){

            foreach($grafico_2_data as $value){

                $dataset_grafico_2[$value->name] = array();
                array_push($labels_grafico_2, $value->name);
            }


        }


    

        if(count($grafico_2_data_grafico) > 0){


                    foreach($grafico_2_data_grafico as $key => $valor){

                        
                        
                        array_push($dataset2_grafico_2, ($valor->porcentaje*100));

                        if ($key % 2 == 0) {
                            array_push($colors_grafico_2, "#35495e");
                        }else{
                            array_push($colors_grafico_2, "#2778f0");
                        }



                    }



        }



        $resultData['pais'] = $data;
        $resultData['menu'] = "analisis-mercado";
        $resultData['sub-menu'] = "valoracion-mercado";
        $resultData['breadcrumb'] = "Analisis de Mercado";
        $resultData['breadcrumb2'] = "Valoración de mercado";

        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;


        $resultData['valoracion_mercado_1'] = $valoracion_mercado_1;
        $resultData['valoracion_mercado_2_anos'] = $valoracion_mercado_2_anos;
        $resultData['valoracion_mercado_2_data'] = $valoracion_mercado_2_data;
        $resultData['valoracion_mercado_2_names'] = $valoracion_mercado_2_names;
        $resultData['valoracion_mercado_3'] = $valoracion_mercado_3;

        $resultData['grafico1_data'] = $grafico_1_data;
        $resultData['grafico1_data_grafico'] = $grafico_1_data_grafico;
        $resultData['grafico1_labels'] = $labels_grafico_1;
        $resultData['grafico1_dataset'] = $dataset2_grafico_1;
        $resultData['grafico1_colors'] = $colors_grafico_1;


        $resultData['grafico2_data'] = $grafico_2_data;
        $resultData['grafico2_data_grafico'] = $grafico_2_data_grafico;
        $resultData['grafico2_labels'] = $labels_grafico_2;
        $resultData['grafico2_dataset'] = $dataset2_grafico_2;
        $resultData['grafico2_colors'] = $colors_grafico_2;
        return view('usuarios/valoracion-mercado', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            // 'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function redesSociales()
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

        $current_year = date("Y");
        $current_year_informes = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }
        if(isset($_GET['ano_informes'])){


            $current_year_informes = $_GET['ano_informes'];

        }
        

        

        $data_categorias = array();
        $year_data_categorias = array();
      
        

        $data_categorias = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-1")->get();
        $year_data_categorias = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-1")->get()->unique('ano');

        //Analisis de Sentimiento
        $current_marca = "";
        $current_marca_1 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-2")->orderBy("ano", "asc")->get()->unique('marca');
        if(count($current_marca_1)>0){

            $current_marca = $current_marca_1[0]->marca;
        }

        if(isset($_GET['marca_seccion1'])){


            $current_marca = $_GET['marca_seccion1'];

        }

        $current_year1 = "";
        $current_data_1 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-2")->orderBy("ano", "asc")->get()->unique('ano');
        if(count($current_data_1)>0){

            $current_year1 = $current_data_1[0]->ano;
        }

   

        $year_data_seccion1 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-2")->get()->unique('ano');
        $sentimiento_data_seccion1 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year1)->where('marca', $current_marca)->where('seccion', "rrss-2")->get()->unique('name');
        $marcas_data_seccion1 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-2")->get()->unique('marca');
        $labels_data_seccion1 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year1)->where('marca', $current_marca)->where('seccion', "rrss-2")->get()->unique('periodo');
        $data_seccion1 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year1)->where('marca', $current_marca)->where('seccion', "rrss-2")->get();

        $array_labels = array();
        $array_data_seccion1 = array();

        if(count($sentimiento_data_seccion1) > 0){

            foreach($sentimiento_data_seccion1 as $valor){

                $array_data_seccion1[$valor->name] = array();

            }



        }

        if(count($labels_data_seccion1) > 0){

            foreach($labels_data_seccion1 as $valor){

                
                array_push($array_labels, $valor->periodo);

                if(count($sentimiento_data_seccion1) > 0){

                    foreach($sentimiento_data_seccion1 as $valor2){

                        $query = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year1)->where("name", $valor2->name)->where('marca', $current_marca)->where("periodo", $valor->periodo)->where('seccion', "rrss-2")->get();

                        if(count($query) > 0){

                            array_push($array_data_seccion1[$valor2->name], $query[0]->valor*100);
                        }else{

                            array_push($array_data_seccion1[$valor2->name], 0);
                        }

        
                       
        
                    }
        
        
        
                }




            }




        }


        //Share of Media New



        $current_marca2= "";
        $current_marca_2 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-3")->orderBy("ano", "asc")->get()->unique('marca');
        if(count($current_marca_2)>0){

            $current_marca2 = $current_marca_2[0]->marca;
        }

        if(isset($_GET['marca_seccion2'])){


            $current_marca = $_GET['marca_seccion2'];

        }

        $current_year2 = "";
        $current_data_2 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-3")->orderBy("ano", "asc")->get()->unique('ano');
        if(count($current_data_2)>0){

            $current_year2 = $current_data_2[0]->ano;
        }

   

        $year_data_seccion2 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-3")->get()->unique('ano');
        $sentimiento_data_seccion2 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year2)->where('marca', $current_marca)->where('seccion', "rrss-3")->get()->unique('name');
        $marcas_data_seccion2 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-3")->get()->unique('marca');
        $labels_data_seccion2 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year2)->where('marca', $current_marca)->where('seccion', "rrss-3")->get()->unique('periodo');
        $data_seccion2 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year2)->where('marca', $current_marca)->where('seccion', "rrss-3")->get();

        $array_labels2 = array();
        $array_data_seccion2 = array();

        if(count($sentimiento_data_seccion2) > 0){

            foreach($sentimiento_data_seccion2 as $valor){

                $array_data_seccion2[$valor->name] = array();

            }



        }

        if(count($labels_data_seccion2) > 0){

            foreach($labels_data_seccion2 as $valor){

                
                array_push($array_labels2, $valor->periodo);

                if(count($sentimiento_data_seccion2) > 0){

                    foreach($sentimiento_data_seccion2 as $valor2){

                        $query = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year2)->where("name", $valor2->name)->where('marca', $current_marca2)->where("periodo", $valor->periodo)->where('seccion', "rrss-3")->get();

                        if(count($query) > 0){

                            array_push($array_data_seccion2[$valor2->name], $query[0]->valor*100);
                        }else{

                            array_push($array_data_seccion2[$valor2->name], 0);
                        }

        
                       
        
                    }
        
        
        
                }




            }




        }

      

        // if(count($data_seccion1) > 0){

        //     foreach($data_seccion1 as $valor){

        //         array_push($array_data_seccion1[$valor->name], $valor->valor);

        //     }



        // }

        // GRAFICO SHARE OF MEDIA


        // $current_marca2 = "";
        // $current_marca_2 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-3")->orderBy("ano", "asc")->get()->unique('marca');
        // if(count($current_marca_2)>0){

        //     $current_marca2 = $current_marca_2[0]->marca;
        // }

        // if(isset($_GET['marca_seccion2'])){


        //     $current_marca2 = $_GET['marca_seccion2'];

        // }

        // $current_year2 = "";
        // $current_data_1 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-3")->orderBy("ano", "asc")->get()->unique('ano');
        // if(count($current_data_1)>0){

        //     $current_year2 = $current_data_1[0]->ano;
        // }

        // $labels_grafico_2 = array();
        // $dataset_grafico_2 = array();
        // $dataset2_grafico_2 = array();
        // $array_data_seccion2 = array();
        // $colors_grafico_2 =array("#35495e","#2778f0","#1f30b4", "#0ca73a", "#aa311a", "#da8e21", "#422d0e", "#b04152");
        // $grafico_2_data = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-3")->where('marca', $current_marca2)->get()->unique('name');
        // $grafico_2_data_grafico = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year2)->where('seccion', "rrss-3")->where('marca', $current_marca2)->get();
        // $marcas_data_seccion2 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year2)->where('seccion', "rrss-3")->get()->unique('marca');

        // if(count($grafico_2_data_grafico)==0){
        //     $grafico_2_data_grafico = DB::table('rrss_data')->where('pais', $data->id)->where('ano', ($current_year2-1))->where('seccion', "rrss-3")->where('marca', $current_marca2)->get();
        // }


        // if(count($grafico_2_data) > 0){

        //     foreach($grafico_2_data as $value){

        //         $dataset_grafico_2[$value->name] = array();
        //         array_push($labels_grafico_2, $value->name);
        //     }


        // }


    

        // if(count($grafico_2_data_grafico) > 0){


        //             foreach($grafico_2_data_grafico as $key => $valor){

                        
                        
        //                 array_push($dataset2_grafico_2, ($valor->valor*100));

        //                 // if ($key % 2 == 0) {
        //                 //     array_push($colors_grafico_1, "#35495e");
        //                 // }else{
        //                 //     array_push($colors_grafico_1, "#2778f0");
        //                 // }



        //             }



        // }


        // if(count($grafico_2_data) > 0){

        //     foreach($grafico_2_data as $valor){

        //         $array_data_seccion2[$valor->name] = array();

        //     }



        // }

        // if(count($labels_data_seccion1) > 0){

        //     foreach($labels_data_seccion1 as $valor){

                
        //         array_push($array_labels, $valor->periodo);

        //         if(count($sentimiento_data_seccion1) > 0){

        //             foreach($sentimiento_data_seccion1 as $valor2){

        //                 $query = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year1)->where("name", $valor2->name)->where('marca', $current_marca)->where("periodo", $valor->periodo)->where('seccion', "rrss-2")->get();

        //                 if(count($query) > 0){

        //                     array_push($array_data_seccion1[$valor2->name], $query[0]->valor*100);
        //                 }else{

        //                     array_push($array_data_seccion1[$valor2->name], 0);
        //                 }

        
                       
        
        //             }
        
        
        
        //         }




        //     }




        // }


        //GRAFICO MENCIONES TOTALES

        $current_marca3 = "";
        $current_marca_3 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-4")->orderBy("ano", "asc")->get()->unique('marca');
        if(count($current_marca_3)>0){

            $current_marca3 = $current_marca_3[0]->marca;
        }

        if(isset($_GET['marca_seccion3'])){


            $current_marca3 = $_GET['marca_seccion3'];

        }

        $current_year3 = "";
        $current_data_1 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-4")->orderBy("ano", "asc")->get()->unique('ano');
        if(count($current_data_1)>0){

            $current_year3 = $current_data_1[0]->ano;
        }

        $labels_grafico_3 = array();
        $dataset_grafico_3 = array();
        $dataset2_grafico_3 = array();
        $grafico3_data = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year3)->where('seccion', "rrss-4")->where('marca', $current_marca3)->get()->unique('marca');
        $grafico3_data_labels = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year3)->where('seccion', "rrss-4")->where('marca', $current_marca3)->get()->unique('periodo');
        $grafico3_data_grafico = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year3)->where('seccion', "rrss-4")->where('marca', $current_marca3)->get();
        $marcas_data_seccion3 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year3)->where('seccion', "rrss-4")->get()->unique('marca');


        if(count($grafico3_data) > 0){

            foreach($grafico3_data as $value){

                $dataset_grafico_3[$value->marca] = array();

            }


        }


        if(count($grafico3_data_labels) > 0){

            foreach($grafico3_data_labels as $value){
                   
                    array_push($labels_grafico_3, $value->periodo);

            }


        }

        if(count($grafico3_data_grafico) > 0){


                    foreach($grafico3_data_grafico as $valor){

                        
                        array_push($dataset_grafico_3[$valor->marca], $valor->valor);

                    }



        }


                //GRAFICO INTERACCIONES TOTALES

                $current_marca4 = "";
                $current_marca_4 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-5")->orderBy("ano", "asc")->get()->unique('marca');
                if(count($current_marca_4)>0){
        
                    $current_marca4 = $current_marca_4[0]->marca;
                }
        
                if(isset($_GET['marca_seccion4'])){
        
        
                    $current_marca4 = $_GET['marca_seccion4'];
        
                }

                $current_year4 = "";
                $current_data_1 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-5")->orderBy("ano", "asc")->get()->unique('ano');
                if(count($current_data_1)>0){
        
                    $current_year4 = $current_data_1[0]->ano;
                }
        
                $labels_grafico_4 = array();
                $dataset_grafico_4 = array();
                $dataset2_grafico_4 = array();
                $grafico4_data = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year4)->where('seccion', "rrss-5")->where('marca', $current_marca4)->get()->unique('marca');
                $grafico4_data_labels = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year4)->where('seccion', "rrss-5")->where('marca', $current_marca4)->get()->unique('periodo');
                $grafico4_data_grafico = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year4)->where('seccion', "rrss-5")->where('marca', $current_marca4)->get();
                $marcas_data_seccion4 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year4)->where('seccion', "rrss-5")->get()->unique('marca');
        
        
                if(count($grafico4_data) > 0){
        
                    foreach($grafico4_data as $value){
        
                        $dataset_grafico_4[$value->marca] = array();
        
                    }
        
        
                }
        
        
                if(count($grafico4_data_labels) > 0){
        
                    foreach($grafico4_data_labels as $value){
                           
                            array_push($labels_grafico_4, $value->periodo);
        
                    }
        
        
                }
        
                if(count($grafico4_data_grafico) > 0){
        
        
                            foreach($grafico4_data_grafico as $valor){
        
                                
                                array_push($dataset_grafico_4[$valor->marca], $valor->valor);
        
                            }
        
        
        
                }

        

        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;

        $resultData['pais'] = $data;
        $resultData['menu'] = "analisis-mercado";
        $resultData['sub-menu'] = "redes-sociales";
        $resultData['breadcrumb'] = "Analisis de Mercado";
        $resultData['breadcrumb2'] = "RRSS";
        $resultData['data'] = $data_categorias;
        $resultData['anos'] = $year_data_categorias;
        $resultData['current_year_informes'] = $current_year_informes;

        $resultData['anos_seccion1'] = $year_data_seccion1;
        $resultData['marca_seccion1'] = $marcas_data_seccion1;
        $resultData['year_data_seccion1'] = $year_data_seccion1;
        $resultData['labels_seccion1'] = $array_labels;
        $resultData['sentimiento_data_seccion1'] = $sentimiento_data_seccion1;
        $resultData['dataset_seccion1'] = $array_data_seccion1;
        $resultData['current_marca1'] = $current_marca;
        $resultData['current_year1'] = $current_year;
        $resultData['colores'] = [];

        for ($i = 0; $i < 100; $i++) {
            $resultData['colores'][] = self::generateRandomHexColor($resultData['colores']);
        }
        //$resultData['colores'] = array("#35495e", "#84cc16", "#facc15","#dc2727", "#fa09e2", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#000000" );

        $resultData['colores2'] = [];

        for ($i = 0; $i < 100; $i++) {
            $resultData['colores2'][] = self::generateRandomHexColor($resultData['colores2']);
        }
        //$resultData['colores2'] = array("#0068b8", "#e81858","#b80000", "#00a8e8", "#787878", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#000000" );
        $resultData['coloresSentimiento'] = array("#0070c0", "#c00000", "#a8a8a8");


        $resultData['anos_seccion2'] = $year_data_seccion2;
        $resultData['marca_seccion2'] = $marcas_data_seccion2;
        $resultData['year_data_seccion2'] = $year_data_seccion2;
        $resultData['labels_seccion2'] = $array_labels2;
        $resultData['sentimiento_data_seccion2'] = $sentimiento_data_seccion2;
        $resultData['dataset_seccion2'] = $array_data_seccion2;
        $resultData['current_marca2'] = $current_marca2;
        $resultData['current_year2'] = $current_year2;

        

        // $resultData['grafico2_data'] = $grafico_2_data;
        // $resultData['grafico2_data_grafico'] = $grafico_2_data_grafico;
        // $resultData['grafico2_labels'] = $labels_grafico_2;
        // $resultData['grafico2_dataset'] = $dataset2_grafico_2;
        // $resultData['grafico2_colors'] = $colors_grafico_2;
        // $resultData['marca_seccion2'] = $marcas_data_seccion2;
        // $resultData['current_marca2'] = $current_marca2;

        $resultData['grafico3_data'] = $grafico3_data;
        $resultData['grafico3_data_grafico'] = $grafico3_data_grafico;
        $resultData['grafico3_labels'] = $labels_grafico_3;
        $resultData['grafico3_dataset'] = $dataset_grafico_3;
        $resultData['marca_seccion3'] = $marcas_data_seccion3;
        $resultData['current_marca3'] = $current_marca3;

        $resultData['grafico4_data'] = $grafico4_data;
        $resultData['grafico4_data_grafico'] = $grafico4_data_grafico;
        $resultData['grafico4_labels'] = $labels_grafico_4;
        $resultData['grafico4_dataset'] = $dataset_grafico_4;
        $resultData['marca_seccion4'] = $marcas_data_seccion4;
        $resultData['current_marca4'] = $current_marca4;


        return view('usuarios/redes-sociales', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            // 'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function conexionLatina()
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


        $conexion_latina_1 = array();
        $conexion_latina_2 = array();
        $conexion_latina_3 = array();
        

        $conexion_latina_1 = DB::table('comunidad_online')->where('pais', $data->id)->where('seccion', "conexion-latina-1")->get();
        $conexion_latina_2 = DB::table('comunidad_online')->where('pais', $data->id)->where('seccion', "conexion-latina-2")->get();
        $conexion_latina_3 = DB::table('comunidad_online')->where('pais', $data->id)->where('seccion', "conexion-latina-3")->get();
   

        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;


        $resultData['pais'] = $data;
        $resultData['menu'] = "investigacion-mercado";
        $resultData['sub-menu'] = "comunidad-online";
        $resultData['conexion_latina_1'] = $conexion_latina_1;
        $resultData['conexion_latina_2'] = $conexion_latina_2;
        $resultData['conexion_latina_3'] = $conexion_latina_3;
        $resultData['breadcrumb'] = "Investigación de Mercado";
        $resultData['breadcrumb2'] = "Comunidad Online";
        return view('usuarios/conexion-latina', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu-yellow'
        ])->with('data', $resultData);
    }
    public function estudiosAdhoc(Request $request)
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

        $current_year = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }

        $data_categorias = array();
        $year_data_categorias = array();
        $list_data_categorias = array();
        $list_data_marcas = array();

        $data_categorias_old = array();
        $year_data_categorias_old = array();
        $list_data_categorias_old = array();
        $list_data_marcas_old = array();

        $current_year_categoria = date("Y");
        $current_categoria = "";

        $pais_id = $data->id;

        $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano', '>=',$min_year)->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")
        ->orWhere(function ($query) use ($min_year,$pais_id) {
            $query->where('tipo_2', 'marca')
                  ->where('ano', '>=', $min_year)
                  ->where('pais', $pais_id);
        })->get();


        
        $year_data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")->where('tipo_2', "marca")->where("ano",">=", $min_year )->get()->unique('ano');
        $list_data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")->where('nombre_tipo', '!=', "")->where("ano",">=", $min_year )->get()->unique('nombre_tipo');
        $list_data_marcas = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo_2', "marca")->where("ano",">=", $min_year )->get()->unique('nombre_tipo_2');

        $data_categorias_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano','<', $min_year)->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")
        ->orWhere(function ($query) use ($min_year, $pais_id) {
            $query->where('tipo_2', 'marca')
                  ->where('ano', '<', $min_year)
                  ->where('pais', $pais_id);
        })->get();

        $current_year_old = "";
        $current_categoria_old = "";



        if(isset($_GET["year-categoria-old"]) && isset($_GET["filter-categoria-old"])){

            $current_year_old = $_GET["year-categoria-old"];
            $current_categoria_old = $_GET["filter-categoria-old"];

            if($_GET["year-categoria-old"] != "" && $_GET["filter-categoria-old"] == ""){

                $data_categorias_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano', $_GET["year-categoria-old"])->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")->get();


            }elseif($_GET["year-categoria-old"] == "" && $_GET["filter-categoria-old"] != ""){


                $data_categorias_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $_GET["filter-categoria-old"])->where('seccion', "investigacion-adhoc")->where('ano','<=', $min_year)->where('tipo', "categoria")->get();


            }elseif($_GET["year-categoria-old"] != "" && $_GET["filter-categoria-old"] != ""){

                $data_categorias_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano', $_GET["year-categoria-old"])->where('nombre_tipo', $_GET["filter-categoria-old"])->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")->get();



            }


        }



        $year_data_categorias_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")->orWhere('tipo_2', "marca")->where("ano","<=", $min_year )->get()->unique('ano');
        $list_data_categorias_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")->where('nombre_tipo', '!=', "")->where("ano","<", $min_year )->get()->unique('nombre_tipo');
        $list_data_marcas_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo_2', "marca")->where("ano","<", $min_year )->get()->unique('nombre_tipo_2');



        $data_cliente = array();
        $year_data_cliente = array();
        $list_data_cliente = array();

        $data_cliente_old = array();
        $year_data_cliente_old = array();
        $list_data_cliente_old = array();


        $current_year_cliente = date("Y");
        $current_cliente = "";
        

        $data_cliente = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano",">", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->get();



        if(isset($_GET["year-cliente"]) && isset($_GET["filter-cliente"])){

            $current_year_cliente = $_GET["year-cliente"];
            $current_cliente = $_GET["filter-cliente"];

            if($_GET["year-cliente"] != "" && $_GET["filter-cliente"] == ""){

                $data_cliente = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano', $current_year_cliente)->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->get();


            }elseif($_GET["year-cliente"] == "" && $_GET["filter-cliente"] != ""){


                $data_cliente = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano",">", $min_year )->where('nombre_tipo', $current_cliente)->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->get();


            }elseif($_GET["year-cliente"] != "" && $_GET["filter-cliente"] != ""){

                $data_cliente = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano', $current_year_cliente)->where('nombre_tipo', $current_cliente)->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->get();



            }


        }




        $year_data_cliente = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->where("ano",">", $min_year )->get()->unique('ano');
        $list_data_cliente = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->where("ano",">", $min_year )->where('nombre_tipo', '!=', "")->get()->unique('nombre_tipo');

        $data_cliente_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano','<=', $min_year)->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->get();


        $current_year_cliente_old = "";
        $current_cliente_old = "";

        if(isset($_GET["year-cliente-old"]) && isset($_GET["filter-cliente-old"])){

            $current_year_cliente_old = $_GET["year-cliente-old"];
            $current_cliente_old = $_GET["filter-cliente-old"];

            if($_GET["year-cliente-old"] != "" && $_GET["filter-cliente-old"] == ""){

                $data_cliente_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano', $current_year_cliente_old)->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->get();


            }elseif($_GET["year-cliente-old"] == "" && $_GET["filter-cliente-old"] != ""){


                $data_cliente_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano','<=', $min_year)->where('nombre_tipo', $current_cliente_old)->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->get();


            }elseif($_GET["year-cliente-old"] != "" && $_GET["filter-cliente-old"] != ""){



                $data_cliente_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano', $current_year_cliente_old)->where('nombre_tipo', $current_cliente_old)->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->get();





            }


        }


        $year_data_cliente_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->where("ano","<=", $min_year )->get()->unique('ano');
        $list_data_cliente_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->where("ano","<=", $min_year )->where('nombre_tipo', '!=', "")->get()->unique('nombre_tipo');


        $data_canal = array();
        $year_data_canal = array();
        $list_data_canal = array();

        $data_canal_old = array();
        $year_data_canal_old = array();
        $list_data_canal_old = array();
        

        $current_year_canal = date("Y");
        $current_canal = "";

        $data_canal = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano",">", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->get();


        if(isset($_GET["year-canal"]) && isset($_GET["filter-canal"])){

            $current_year_canal = $_GET["year-canal"];
            $current_canal = $_GET["filter-canal"];

            if($_GET["year-canal"] != "" && $_GET["filter-canal"] == ""){

                $data_canal = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano', $current_year_canal)->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->get();


            }elseif($_GET["year-canal"] == "" && $_GET["filter-canal"] != ""){


                $data_canal = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano",">", $min_year )->where('nombre_tipo', $current_canal)->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->get();


            }elseif($_GET["year-canal"] != "" && $_GET["filter-canal"] != ""){

                $data_canal = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano', $current_year_canal)->where('nombre_tipo', $current_canal)->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->get();



            }



        }


        $year_data_canal = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->where("ano",">", $min_year )->get()->unique('ano');
        $list_data_canal = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->where("ano",">", $min_year )->where('nombre_tipo', '!=', "")->get()->unique('nombre_tipo');

        $data_canal_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano','<=', $min_year)->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->get();



        $current_year_canal_old = "";
        $current_canal_old = "";

        if(isset($_GET["year-canal-old"]) && isset($_GET["filter-canal-old"])){

            $current_year_canal_old = $_GET["year-canal-old"];
            $current_canal_old = $_GET["filter-canal-old"];

            if($_GET["year-canal-old"] != "" && $_GET["filter-canal-old"] == ""){

                $data_canal_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano', $current_year_canal_old)->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->get();


            }elseif($_GET["year-canal-old"] == "" && $_GET["filter-canal-old"] != ""){


                $data_canal_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano','<=', $min_year)->where('nombre_tipo', $current_canal_old)->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->get();


            }elseif($_GET["year-canal-old"] != "" && $_GET["filter-canal-old"] != ""){



                $data_canal_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('ano', $current_year_canal_old)->where('nombre_tipo', $current_canal_old)->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->get();





            }


        }



        $year_data_canal_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->where("ano","<=", $min_year )->get()->unique('ano');
        $list_data_canal_old = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where('tipo', "canal")->where("ano","<=", $min_year )->where('nombre_tipo', '!=', "")->get()->unique('nombre_tipo');


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;

        $resultData['pais'] = $data;
        $resultData['menu'] = "investigacion-mercado";
        $resultData['sub-menu'] = "estudios-adhoc";
        $resultData['breadcrumb'] = "Investigación de Mercado";
        $resultData['breadcrumb2'] = "Estudios Ad Hoc";


        $resultData['data_categorias'] = $data_categorias;
        $resultData['year_list_categorias'] = $year_data_categorias;
        $resultData['list_data_categorias'] = $list_data_categorias;

        $resultData['data_categorias_old'] = $data_categorias_old;
        $resultData['year_list_categorias_old'] = $year_data_categorias_old;
        $resultData['list_data_categorias_old'] = $list_data_categorias_old;
        $resultData['list_data_marcas'] = $list_data_marcas;
        $resultData['list_data_marcas_old'] = $list_data_marcas_old;


        $resultData['data_cliente'] = $data_cliente;
        $resultData['year_list_cliente'] = $year_data_cliente;
        $resultData['list_data_cliente'] = $list_data_cliente;

        $resultData['data_cliente_old'] = $data_cliente_old;
        $resultData['year_list_cliente_old'] = $year_data_cliente_old;
        $resultData['list_data_cliente_old'] = $list_data_cliente_old;

        $resultData['data_canal'] = $data_canal;
        $resultData['year_list_canal'] = $year_data_canal;
        $resultData['list_data_canal'] = $list_data_canal;

        $resultData['data_canal_old'] = $data_canal_old;
        $resultData['year_list_canal_old'] = $year_data_canal_old;
        $resultData['list_data_canal_old'] = $list_data_canal_old;

        $resultData['current_year_categoria'] = $current_year_categoria;
        $resultData['current_categoria'] = $current_categoria;

        $resultData['current_year_old'] = $current_year_old;
        $resultData['current_categoria_old'] = $current_categoria_old;


        $resultData['current_year_cliente'] = $current_year_cliente;
        $resultData['current_cliente'] = $current_cliente;

        $resultData['current_year_cliente_old'] = $current_year_cliente_old;
        $resultData['current_cliente_old'] = $current_cliente_old;



        $resultData['current_year_canal'] = $current_year_canal;
        $resultData['current_canal'] = $current_canal;

        $resultData['current_year_canal_old'] = $current_year_canal_old;
        $resultData['current_canal_old'] = $current_canal_old;









        return view('usuarios/estudios-adhoc', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function globalAnalisis(Request $request)
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

        $current_year = date("Y");

        if(isset($request->year)){

            $current_year = $request->year;

        }

        $global_data = array();
        $year_data = array();
        

        $global_data = DB::table('informes')->where('pais', $data->id)->where('seccion', "global-analisis")->get();
        $year_data = DB::table('informes')->where('pais', $data->id)->where('seccion', "global-analisis")->orderBy('year')->get()->unique('year');


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;

        $resultData['pais'] = $data;
        $resultData['menu'] = "analisis-mercado";
        $resultData['sub-menu'] = "global-analisis";
        $resultData['breadcrumb'] = "Global";
        $resultData['breadcrumb2'] = "Analisis";
        $resultData['data'] = $global_data;
        $resultData['year_list'] = $year_data;
        return view('usuarios/global-analisis', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function precios(Request $request)
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

        $current_year = date("Y");

        if(isset($request->year)){

            $current_year = $request->year;

        }

        $global_data = array();
        $year_data = array();
        

        $global_data = DB::table('precios')->where('pais', $data->id)->where('seccion', "precios-informes")->get();
        $year_data = DB::table('precios')->where('pais', $data->id)->where('seccion', "precios-informes")->get()->unique('periodo');



        $labels_kpi = array();
        $dataset_kpi = array();
        
        $kpi2_data = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-2")->get()->unique('name');
        $kpi2_data_labels = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-2")->get()->unique('ano');
        $kpi2_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-2")->get();


        if(count($kpi2_data) > 0){

            foreach($kpi2_data as $value){

                $dataset_kpi[$value->item] = array();

            }


        }


        if(count($kpi2_data_labels) > 0){

            foreach($kpi2_data_labels as $value){


                    $format_data = date("M-y", strtotime($value->ano));
                    array_push($labels_kpi, $value->ano);

            }


        }

        if(count($kpi2_data_grafico) > 0){


                    foreach($kpi2_data_grafico as $valor){

                        
                        array_push($dataset_kpi[$valor->item], $valor->dato);

                    }



        }


        $labels_historico_maiz = array();
        $dataset_historico_maiz['ap_ve'] = array();
        $dataset_historico_maiz['ap_col'] = array();
        $dataset_historico_maiz['igc'] = array();
        

        $historico_maiz_data_labels = DB::table('precios')->where('ano',$current_year)->where('seccion', "precio-compra-maiz")->get()->unique('mes');
        $historico_maiz_anos = DB::table('precios')->where('seccion', "precio-compra-maiz")->get()->unique('ano');
        $historico_maiz_data_grafico = DB::table('precios')->where('ano', $current_year)->where('seccion', "precio-compra-maiz")->get();





        if(count($historico_maiz_data_labels) > 0){

            foreach($historico_maiz_data_labels as $value){


                    $format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels_historico_maiz, $value->mes);

            }


        }

        if(count($historico_maiz_data_grafico) > 0){


                    foreach($historico_maiz_data_grafico as $valor){
                        

                        
                        array_push($dataset_historico_maiz['ap_ve'], $valor->ap_ve);
                        array_push($dataset_historico_maiz['ap_col'], $valor->ap_col);
                        array_push($dataset_historico_maiz['igc'], $valor->igc);

                    }



        }



        $labels_comodities = array();
        $dataset_comodities['maiz_amarillo'] = array();
        $dataset_comodities['maiz_blanco'] = array();
        $dataset_comodities['trigo'] = array();
        $dataset_comodities['petroleo'] = array();
        

        $comodities_data_labels = DB::table('precios')->where('ano',$current_year)->where('seccion', "comodities")->get()->unique('mes');
        $comodities_anos = DB::table('precios')->where('seccion', "comodities")->get()->unique('ano');
        $comodities_data_grafico = DB::table('precios')->where('ano', $current_year)->where('seccion', "comodities")->get();





        if(count($comodities_data_labels) > 0){

            foreach($comodities_data_labels as $value){


                    $format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels_comodities, $value->mes);

            }


        }

        if(count($comodities_data_grafico) > 0){


                    foreach($comodities_data_grafico as $valor){
                        

                        
                        array_push($dataset_comodities['maiz_amarillo'], $valor->maiz_amarillo);
                        array_push($dataset_comodities['maiz_blanco'], $valor->maiz_blanco);
                        array_push($dataset_comodities['trigo'], $valor->trigo);
                        array_push($dataset_comodities['petroleo'], $valor->petroleo);

                    }



        }


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;

        $resultData['pais'] = $data;
        $resultData['menu'] = "precios";
        $resultData['sub-menu'] = "precios-informes";
        $resultData['breadcrumb'] = "Precios";
        $resultData['breadcrumb2'] = "";
        $resultData['data'] = $global_data;
        $resultData['year_list'] = $year_data;
        $resultData['kpi2_data'] = $kpi2_data;
        $resultData['kpi2_data_grafico'] = $kpi2_data_grafico;
        $resultData['kpi2_labels'] = $labels_kpi;
        $resultData['kpi2_dataset'] = $dataset_kpi;
        $resultData['dataset_precio_maiz'] = $dataset_historico_maiz;
        $resultData['labels_historico_maiz'] = $labels_historico_maiz;
        $resultData['historico_maiz_anos'] = $historico_maiz_anos;
        $resultData['current_ano_precio_maiz'] = $current_year;

        $resultData['dataset_comodities'] = $dataset_comodities;
        $resultData['labels_comodities'] = $labels_comodities;
        $resultData['comodities_anos'] = $comodities_anos;
        $resultData['current_ano_comodities'] = $current_year;
        $resultData['colores'] = [];

        for ($i = 0; $i < 100; $i++) {
            $resultData['colores'][] = self::generateRandomHexColor($resultData['colores']);
        }

        // $resultData['colores'] = array("#35495e", "#84cc16", "#facc15","#dc2727", "#fa09e2", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#000000","#5e3549","#5e4a35",  "#495e35", "#355e5e" );
        return view('usuarios/precios', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    function generateRandomHexColor($existingColors) {
        $characters = '0123456789ABCDEF';
      
        do {
            $color = '#';
          
            for ($i = 0; $i < 6; $i++) {
                $index = rand(0, 15);
                $color .= $characters[$index];
            }
        } while (in_array($color, $existingColors));
    
        return $color;
    }
    public function globalInvestigacion(Request $request)
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

        $current_year = date("Y");
        if(isset($_GET["ano_filtro"])){

            $current_year = $_GET["ano_filtro"];

        }

        $global_data = array();
        $year_data = array();
        

        $global_data = DB::table('informes')->where('pais', $data->id)->where('seccion', "global-investigacion")->get();
        $year_data = DB::table('informes')->where('pais', $data->id)->where('seccion', "global-investigacion")->orderBy('year')->get()->unique('year');


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;

        $resultData['pais'] = $data;
        $resultData['menu'] = "investigacion-mercado";
        $resultData['sub-menu'] = "investigacion-global";
        $resultData['breadcrumb'] = "Global";
        $resultData['breadcrumb2'] = "Investigación";
        $resultData['data'] = $global_data;
        $resultData['year_list'] = $year_data;
        $resultData['current_year'] = $current_year;
        return view('usuarios/global-investigacion', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function panelHogares()
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

        $current_year = date("Y");
        if(isset($request->year)){

            $current_year = $request->year;

        }



        $data_categorias = array();
        $year_data_categorias = array();
        $list_data_categorias = array();
        

        $current_year_categoria = date("Y");
        $current_categoria = "";
        $data_categorias = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "categoria")->get();



        if(isset($_GET["year-categoria"]) && isset($_GET["filter-categoria"])){

            $current_year_categoria = $_GET["year-categoria"];
            $current_categoria = $_GET["filter-categoria"];

            if($_GET["year-categoria"] != "" && $_GET["filter-categoria"] == ""){

                $data_categorias = DB::table('panel_hogares')->where('pais', $data->id)->where('ano', $current_year_categoria)->where('seccion', "categoria")->get();



            }elseif($_GET["year-categoria"] == "" && $_GET["filter-categoria"] != ""){


                $data_categorias = DB::table('panel_hogares')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('seccion', "categoria")->get();


            }elseif($_GET["year-categoria"] != "" && $_GET["filter-categoria"] != ""){

                $data_categorias = DB::table('panel_hogares')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('ano', $current_year_categoria)->where('seccion', "categoria")->get();



            }



        }


        $year_data_categorias = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "categoria")->get()->unique('periodo');
        $list_data_categorias = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "categoria")->get()->unique('nombre_tipo');


        $consumo_dentro_hogar_data = array();
        $year_consumo_dentro_hogar_data = array();
        $list_consumo_dentro_hogar_data = array();

        $current_year_2 = date("Y");


        if(isset($_GET["year-filter-2"])){

            if($_GET["year-filter-2"] == ""){


                $current_year_2 = date("Y");



            }else{

                $current_year_2 = $_GET["year-filter-2"];
            }


        }
        

        $consumo_dentro_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumo_dentro_del_hogar")->get();




        $year_consumo_dentro_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumo_dentro_del_hogar")->get()->unique('periodo');
        $list_consumo_dentro_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumo_dentro_del_hogar")->get()->unique('nombre_tipo');

        $consumo_fuera_hogar_data = array();
        $year_consumo_fuera_hogar_data = array();
        $list_consumo_dentro_hogar_data = array();


        $current_year_3 = date("Y");


        if(isset($_GET["year-filter-3"])){

            if($_GET["year-filter-3"] == ""){


                $current_year_3 = date("Y");



            }else{

                $current_year_3= $_GET["year-filter-3"];
            }


        }
        

        $consumo_fuera_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumo_fuera_del_hogar")->get();
        $year_consumo_fuera_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumo_fuera_del_hogar")->get()->unique('periodo');
        $list_consumo_dentro_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumo_fuera_del_hogar")->get()->unique('nombre_tipo');


        $lugar_de_compra_data = array();
        $year_lugar_de_compra_data = array();
        $list_lugar_de_compra_data = array();



        $current_year_4 = date("Y");


        if(isset($_GET["year-filter-4"])){

            if($_GET["year-filter-4"] == ""){


                $current_year_4 = date("Y");



            }else{

                $current_year_4 = $_GET["year-filter-4"];
            }


        }
        

        $lugar_de_compra_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "lugar_compra")->get();
        $year_lugar_de_compra_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "lugar_compra")->get()->unique('periodo');
        $list_lugar_de_compra_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "lugar_compra")->get()->unique('nombre_tipo');



        $current_year_5 = date("Y");
        $current_cliente = "";


        $consumidores_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumidores-clientes")->get();






        $year_consumidores_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumidores-clientes")->get()->unique('periodo');
        $list_consumidores_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumidores-clientes")->get()->unique('nombre_tipo');


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;

        $resultData['pais'] = $data;
        $resultData['menu'] = "investigacion-mercado";
        $resultData['sub-menu'] = "panel-hogares";
        $resultData['breadcrumb'] = "Investigación de Mercado";
        $resultData['breadcrumb2'] = "Panel Hogares";


        $resultData['data_categorias'] = $data_categorias;
        $resultData['year_data_categorias'] = $year_data_categorias;
        $resultData['list_data_categorias'] = $list_data_categorias;

        $resultData['consumo_dentro_hogar_data'] = $consumo_dentro_hogar_data;
        $resultData['year_consumo_dentro_hogar_data'] = $year_consumo_dentro_hogar_data;
        $resultData['list_consumo_dentro_hogar_data'] = $list_consumo_dentro_hogar_data;

        $resultData['consumo_fuera_hogar_data'] = $consumo_fuera_hogar_data;
        $resultData['year_consumo_fuera_hogar_data'] = $year_consumo_fuera_hogar_data;
        $resultData['list_consumo_dentro_hogar_data'] = $list_consumo_dentro_hogar_data;



        $resultData['lugar_de_compra_data'] = $lugar_de_compra_data;
        $resultData['year_lugar_de_compra_data'] = $year_lugar_de_compra_data;
        $resultData['list_lugar_de_compra_data'] = $list_lugar_de_compra_data;


        $resultData['consumidores_data'] = $consumidores_data;
        $resultData['year_consumidores_data'] = $year_consumidores_data;
        $resultData['list_consumidores_data'] = $list_consumidores_data;


        $resultData['current_year_categoria'] = $current_year_categoria;
        $resultData['current_categoria'] = $current_categoria;
        $resultData['current_year_2'] = $current_year_2;
        $resultData['current_year_3'] = $current_year_3;
        $resultData['current_year_4'] = $current_year_4;
        $resultData['current_year_5'] = $current_year_5;
        $resultData['current_cliente'] = $current_cliente;



        return view('usuarios/panel-hogares', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function valoracionMarca(Request $request)
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
        $current_marca = "";
        $current_year = date("Y");
        $first_qeury = DB::table('valoracion_marca')->where('pais', $data->id)->where('seccion', "grafico-1")->orderBy("ano", "asc")->get()->unique('name');
        if(count($first_qeury)>0){

            $current_marca = $first_qeury[0]->name;
        }
        
        if(isset($request->year)){

            $current_year = $request->year;

        }

        if(isset($request->marca)){

            echo $current_marca = $request->marca;

        }

        $valor_total_marca = DB::table('valoracion_marca')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "grafico-1")->where('name', "VALOR TOTAL MARCA")->first();
        $valor_marca_pais = DB::table('valoracion_marca')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "grafico-1")->where('name', "VALOR MARCA PAIS")->first();

        $labels = array();
        $dataset = array();
        $grafico_data = DB::table('valoracion_marca')->where('pais', $data->id)->where('seccion', "grafico-1")->orderBy("ano", "asc")->get()->unique('name');
        $grafico_data_labels = DB::table('valoracion_marca')->where('pais', $data->id)->where('seccion', "grafico-1")->orderBy("ano", "asc")->get()->unique('ano');
        $grafico_data_grafico = DB::table('valoracion_marca')->where('pais', $data->id)->where('seccion', "grafico-1")->where('name', $current_marca)->orderBy("ano", "asc")->get();

        $grafico_data_2 = DB::table('valoracion_marca')->where('pais', $data->id)->where('seccion', "grafico-1")->where('name', $current_marca)->orderBy("ano", "asc")->get();


        $dataset["valor_total_marca"] = array();
        $dataset["valor_marca_pais"] = array();

        // if(count($grafico_data) > 0){

        //     foreach($grafico_data as $value){

        //         $dataset[$value->name] = array();

        //     }


        // }


        if(count($grafico_data_labels) > 0){

            foreach($grafico_data_labels as $value){


                    $format_data = $value->ano;
                    array_push($labels, $format_data);

            }


        }

        if(count($grafico_data_grafico) > 0){


                    foreach($grafico_data_grafico as $valor){

                        
                        array_push($dataset["valor_total_marca"], $valor->valor_total);
                        array_push($dataset["valor_marca_pais"], $valor->valor_marca_pais);

                    }



        }


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;

        $resultData['pais'] = $data;
        $resultData['menu'] = "analisis-mercado";
        $resultData['sub-menu'] = "valoracion-marca";
        $resultData['breadcrumb'] = "Analisis de Mercado";
        $resultData['breadcrumb2'] = "Valoración de marca";

        $resultData['valor_total_marca'] = number_format($grafico_data_grafico[0]->valor_total ?? 0,"0",",",".");
        $resultData['valor_marca_pais'] = number_format($grafico_data_grafico[0]->valor_marca_pais ?? 0,"0",",",".");


        $resultData['marca_selected'] = $current_marca;

        $resultData['colores'] = [];

        for ($i = 0; $i < 100; $i++) {
            $resultData['colores'][] = self::generateRandomHexColor($resultData['colores']);
        }

        //$resultData['colores'] = array("#35495e", "#84cc16", "#facc15","#dc2727", "#fa09e2", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#000000" );
        $resultData['grafico_data'] = $grafico_data;
        $resultData['grafico_data_grafico'] = $grafico_data_grafico;
        $resultData['grafico_labels'] = $labels;
        $resultData['grafico_dataset'] = $dataset;




        return view('usuarios/valoracion-marca', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }

    public function analisisMercadoClientes()
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



        $current_year = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }

        $data_categorias = array();
        $year_data_categorias = array();
        $list_data_categorias = array();

        $data_categorias_old = array();
        $year_data_categorias_old = array();
        $list_data_categorias_old = array();
        


        $current_year = date("Y");
        $current_canal = "";

        $data_categorias = DB::table('clientes_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "clientes")->get();


        if(isset($_GET["year-filter"]) && isset($_GET["filter-canal"])){

            $current_year = $_GET["year-filter"];
            $current_canal = $_GET["filter-canal"];

            if($_GET["year-filter"] != "" && $_GET["filter-canal"] == ""){

                $data_categorias = DB::table('clientes_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "clientes")->get();



            }elseif($_GET["year-filter"] == "" && $_GET["filter-canal"] != ""){


                $data_categorias = DB::table('clientes_data')->where('pais', $data->id)->where('canal', $current_canal)->where('seccion', "clientes")->get();


            }elseif($_GET["year-filter"] != "" && $_GET["filter-canal"] != ""){

                $data_categorias = DB::table('clientes_data')->where('pais', $data->id)->where('canal', $current_canal)->where('ano', $current_year)->where('seccion', "clientes")->get();



            }



        }





        $year_data_categorias = DB::table('clientes_data')->where('pais', $data->id)->where('seccion', "clientes")->get()->unique('ano');
        $list_data_categorias = DB::table('clientes_data')->where('pais', $data->id)->where('seccion', "clientes")->get()->unique('canal');


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;


        $resultData['pais'] = $data;
        $resultData['menu'] = "analisis-mercado";
        $resultData['sub-menu'] = "analisis-mercado-clientes";
        $resultData['data'] = $data_categorias;
        $resultData['anos'] = $year_data_categorias;
        $resultData['canales'] = $list_data_categorias;
        $resultData['current_year'] = $current_year;
        $resultData['current_canal'] = $current_canal;
        $resultData['breadcrumb'] = "Analisis de Mercado";
        $resultData['breadcrumb2'] = "Clientes";
        return view('usuarios/analisis-mercado-clientes', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }

    public function analisisOtros()
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



        $current_year = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }

        $data_categorias = array();
        $year_data_categorias = array();
        $list_data_categorias = array();

        $data_categorias_old = array();
        $year_data_categorias_old = array();
        $list_data_categorias_old = array();

        if(isset($_GET["year-filter"])){

            if($_GET["year-filter"] == ""){

                $current_year = date("Y");

            }else{

                $current_year = $_GET["year-filter"];

            }

        }
        

        $data_categorias = DB::table('otros_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "ANALISIS")->get();
        $year_data_categorias = DB::table('otros_data')->where('pais', $data->id)->where("ano",">", $min_year )->get()->unique('ano');
       


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;


        $resultData['pais'] = $data;
        $resultData['menu'] = "analisis-mercado";
        $resultData['sub-menu'] = "analisis-otros";
        $resultData['data'] = $data_categorias;
        $resultData['anos'] = $year_data_categorias;
        $resultData['current_year'] = $current_year;

        $resultData['breadcrumb'] = "Analisis de Mercado";
        $resultData['breadcrumb2'] = "Otros";
        return view('usuarios/analisis-mercado-otros', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function investigacionOtros()
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



        $current_year = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }

        $data_categorias = array();
        $year_data_categorias = array();
        $list_data_categorias = array();

        $data_categorias_old = array();
        $year_data_categorias_old = array();
        $list_data_categorias_old = array();

        if(isset($_GET["year-filter"])){

            if($_GET["year-filter"] == ""){

                $current_year = date("Y");

            }else{

                $current_year = $_GET["year-filter"];

            }

        }

        

        $data_categorias = DB::table('otros_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "INVESTIGACION")->get();

      
        $year_data_categorias = DB::table('otros_data')->where('pais', $data->id)->where('seccion', "INVESTIGACION")->get()->unique('ano');
       


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;


        $resultData['pais'] = $data;
        $resultData['menu'] = "investigacion-mercado";
        $resultData['sub-menu'] = "investigacion-otros";
        $resultData['data'] = $data_categorias;
        $resultData['anos'] = $year_data_categorias;
        $resultData['current_year'] = $current_year;

        $resultData['breadcrumb'] = "Investigación de Mercado";
        $resultData['breadcrumb2'] = "Otros";
        return view('usuarios/investigacion-otros', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }

    public function ventasOtros()
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



        $current_year = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }

        $data_categorias = array();
        $year_data_categorias = array();
        $list_data_categorias = array();

        $data_categorias_old = array();
        $year_data_categorias_old = array();
        $list_data_categorias_old = array();


        if(isset($_GET["year-filter"])){

            if($_GET["year-filter"] == ""){

                $current_year = date("Y");

            }else{

                $current_year = $_GET["year-filter"];

            }

        }
        

        $data_categorias = DB::table('otros_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "VENTAS")->get();
        $year_data_categorias = DB::table('otros_data')->where('pais', $data->id)->where('seccion', "VENTAS")->get()->unique('ano');
       

        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;



        $resultData['pais'] = $data;
        $resultData['menu'] = "ventas";
        $resultData['sub-menu'] = "ventas-otros";
        $resultData['data'] = $data_categorias;
        $resultData['anos'] = $year_data_categorias;
        $resultData['current_year'] = $current_year;

        $resultData['breadcrumb'] = "Ventas";
        $resultData['breadcrumb2'] = "Otros";
        return view('usuarios/ventas-otros', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }

    public function segmentaciones()
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

        $current_year = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }

        $data_clientes = array();
        $year_data_clientes = array();
        $categorias_data_clientes = array();

        $data_consumidores = array();
        $year_data_consumidores = array();
        $categorias_data_consumidores = array();

        $current_year_1 = date("Y");
        $current_categoria_1 = "";

        $data_clientes = DB::table('segmentaciones')->where('pais', $data->id)->where('seccion', "segmentaciones-1")->where('tipo', "CLIENTES")->get();



        if(isset($_GET["year-filter-1"]) && isset($_GET["filter-categoria-1"])){

            $current_year_1 = $_GET["year-filter-1"];
            $current_categoria_1 = $_GET["filter-categoria-1"];

            if($_GET["year-filter-1"] != "" && $_GET["filter-categoria-1"] == ""){

                $data_clientes = DB::table('segmentaciones')->where('pais', $data->id)->where('ano', $current_year_1)->where('seccion', "segmentaciones-1")->where('tipo', "CLIENTES")->get();



            }elseif($_GET["year-filter-1"] == "" && $_GET["filter-categoria-1"] != ""){


                $data_clientes = DB::table('segmentaciones')->where('pais', $data->id)->where('categoria', $current_categoria_1)->where('seccion', "segmentaciones-1")->where('tipo', "CLIENTES")->get();


            }elseif($_GET["year-filter-1"] != "" && $_GET["filter-categoria-1"] != ""){

                $data_clientes = DB::table('segmentaciones')->where('pais', $data->id)->where('categoria', $current_categoria_1)->where('ano', $current_year_1)->where('tipo', "CLIENTES")->where('seccion', "segmentaciones-1")->get();



            }



        }



        $year_data_clientes = DB::table('segmentaciones')->where('pais', $data->id)->where('seccion', "segmentaciones-1")->where("ano",">", $min_year )->where('tipo', "CLIENTES")->get()->unique('ano');
        $categorias_data_clientes = DB::table('segmentaciones')->where('pais', $data->id)->where('seccion', "segmentaciones-1")->where("ano",">", $min_year )->where('tipo', "CLIENTES")->get()->unique('categoria');


        $current_year_2 = date("Y");
        $current_categoria_2 = "";
        $data_consumidores = DB::table('segmentaciones')->where('pais', $data->id)->where('seccion', "segmentaciones-1")->where('tipo', "CONSUMIDORES")->get();



        if(isset($_GET["year-filter-2"]) && isset($_GET["filter-categoria-2"])){

            $current_year_2 = $_GET["year-filter-2"];
            $current_categoria_2 = $_GET["filter-categoria-2"];

            if($_GET["year-filter-2"] != "" && $_GET["filter-categoria-2"] == ""){

                $data_consumidores = DB::table('segmentaciones')->where('pais', $data->id)->where('ano', $current_year_2)->where('seccion', "segmentaciones-1")->where('tipo', "CONSUMIDORES")->get();



            }elseif($_GET["year-filter-2"] == "" && $_GET["filter-categoria-2"] != ""){


                $data_consumidores = DB::table('segmentaciones')->where('pais', $data->id)->where('categoria', $current_categoria_2)->where('seccion', "segmentaciones-2")->where('tipo', "CONSUMIDORES")->get();


            }elseif($_GET["year-filter-2"] != "" && $_GET["filter-categoria-2"] != ""){

                $data_consumidores = DB::table('segmentaciones')->where('pais', $data->id)->where('categoria', $current_categoria_2)->where('ano', $current_year_2)->where('tipo', "CONSUMIDORES")->where('seccion', "segmentaciones-1")->get();



            }



        }





        $year_data_consumidores = DB::table('segmentaciones')->where('pais', $data->id)->where('seccion', "segmentaciones-1")->where("ano",">", $min_year )->where('tipo', "CONSUMIDORES")->get()->unique('ano');
        $categorias_data_consumidores = DB::table('segmentaciones')->where('pais', $data->id)->where('seccion', "segmentaciones-1")->where("ano",">", $min_year )->where('tipo', "CONSUMIDORES")->get()->unique('categoria');


        $labels_grafico_1 = array();
        $dataset_grafico_1 = array();
        $dataset2_grafico_1 = array();
        $colors_grafico_1 = array("#35495e","#2778f0","#1f30b4", "#0ca73a", "#aa311a", "#da8e21", "#422d0e", "#b04152");
        $grafico_1_data = DB::table('segmentaciones')->where('pais', $data->id)->where('seccion', "segmentaciones-2")->where('tipo', "CLIENTES")->get()->unique('name');
        $grafico_1_data_grafico = DB::table('segmentaciones')->where('pais', $data->id)->where('seccion', "segmentaciones-2")->where('tipo', "CLIENTES")->get();


        if(count($grafico_1_data) > 0){

            foreach($grafico_1_data as $value){

                $dataset_grafico_1[$value->name] = array();
                array_push($labels_grafico_1, $value->name);
            }


        }


    

        if(count($grafico_1_data_grafico) > 0){


                    foreach($grafico_1_data_grafico as $key => $valor){

                        
                        
                        array_push($dataset2_grafico_1, ($valor->porcentaje*100));

                        // if ($key % 2 == 0) {
                        //     array_push($colors_grafico_1, "#35495e");
                        // }else{
                        //     array_push($colors_grafico_1, "#2778f0");
                        // }



                    }



        }


        $labels_grafico_2 = array();
        $dataset_grafico_2 = array();
        $dataset2_grafico_2 = array();
        $colors_grafico_2 = array("#35495e","#2778f0","#1f30b4", "#0ca73a", "#aa311a", "#da8e21", "#422d0e", "#b04152");
        $grafico_2_data = DB::table('segmentaciones')->where('pais', $data->id)->where('seccion', "segmentaciones-2")->where('tipo', "CONSUMIDORES")->get()->unique('name');
        $grafico_2_data_grafico = DB::table('segmentaciones')->where('pais', $data->id)->where('seccion', "segmentaciones-2")->where('tipo', "CONSUMIDORES")->get();


        if(count($grafico_2_data) > 0){

            foreach($grafico_2_data as $value){

                $dataset_grafico_2[$value->name] = array();
                array_push($labels_grafico_2, $value->name);
            }


        }


    

        if(count($grafico_2_data_grafico) > 0){


                    foreach($grafico_2_data_grafico as $key => $valor){

                        
                        if($valor->porcentaje != null){

                            array_push($dataset2_grafico_2, ($valor->porcentaje*100));


                        }
                        

                        // if ($key % 2 == 0) {
                        //     array_push($colors_grafico_1, "#35495e");
                        // }else{
                        //     array_push($colors_grafico_1, "#2778f0");
                        // }



                    }



        }

        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;


        $resultData['pais'] = $data;
        $resultData['menu'] = "analisis-mercado";
        $resultData['sub-menu'] = "segmentaciones";
        $resultData['data_clientes'] = $data_clientes;
        $resultData['anos_clientes'] = $year_data_clientes;
        $resultData['categorias_clientes'] = $categorias_data_clientes;


        $resultData['grafico1_data'] = $grafico_1_data;
        $resultData['grafico1_data_grafico'] = $grafico_1_data_grafico;
        $resultData['grafico1_labels'] = $labels_grafico_1;
        $resultData['grafico1_dataset'] = $dataset2_grafico_1;
        $resultData['grafico1_colors'] = $colors_grafico_1;

        $resultData['grafico2_data'] = $grafico_2_data;
        $resultData['grafico2_data_grafico'] = $grafico_2_data_grafico;
        $resultData['grafico2_labels'] = $labels_grafico_2;
        $resultData['grafico2_dataset'] = $dataset2_grafico_2;
        $resultData['grafico2_colors'] = $colors_grafico_2;


        $resultData['current_year_1'] = $current_year_1;
        $resultData['current_categoria_1'] = $current_categoria_1;

        $resultData['current_year_2'] = $current_year_2;
        $resultData['current_categoria_2'] = $current_categoria_2;

        $resultData['data_consumidores'] = $data_consumidores;
        $resultData['anos_consumidores'] = $year_data_consumidores;
        $resultData['categorias_consumidores'] = $categorias_data_consumidores;
        $resultData['breadcrumb'] = "Analisis de Mercado";
        $resultData['breadcrumb2'] = "Segmentaciones";
        return view('usuarios/segmentaciones', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }

    public function proveedores()
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


        $current_year = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }

        $data_informacion = array();
        $year = array();
        $proveedores = array();

        $current_year = date("Y");
        $current_proveedor = "";

        $data_informacion = DB::table('informacion_sindicada')->where('pais', $data->id)->where('seccion', "informacion-sindicada")->get();


        if(isset($_GET["year-filter"]) && isset($_GET["filter-proveedor"])){

            $current_year = $_GET["year-filter"];
            $current_proveedor = $_GET["filter-proveedor"];

            if($_GET["year-filter"] != "" && $_GET["filter-proveedor"] == ""){

                $data_informacion = DB::table('informacion_sindicada')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "informacion-sindicada")->get();



            }elseif($_GET["year-filter"] == "" && $_GET["filter-proveedor"] != ""){


                $data_informacion = DB::table('informacion_sindicada')->where('pais', $data->id)->where('proveedor', $current_proveedor)->where('seccion', "informacion-sindicada")->get();


            }elseif($_GET["year-filter"] != "" && $_GET["filter-proveedor"] != ""){

                $data_informacion = DB::table('informacion_sindicada')->where('pais', $data->id)->where('ano', $current_year)->where('proveedor', $current_proveedor)->where('seccion', "informacion-sindicada")->get();



            }



        }



        $year = DB::table('informacion_sindicada')->where('pais', $data->id)->where('seccion', "informacion-sindicada")->get()->unique('ano');
        $proveedores = DB::table('informacion_sindicada')->where('pais', $data->id)->where('seccion', "informacion-sindicada")->get()->unique('proveedor');


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;


        $resultData['pais'] = $data;

        $resultData['menu'] = "investigacion-mercado";
        $resultData['sub-menu'] = "investigacion-sindicada";
        $resultData['breadcrumb'] = "Informacion Sindicada";
        $resultData['breadcrumb2'] = "";

        $resultData['data'] = $data_informacion;
        $resultData['anos'] = $year;
        $resultData['proveedores'] = $proveedores;
        $resultData['current_year'] = "";
        $resultData['current_proveedor'] = $current_proveedor;
        return view('usuarios/proveedores', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function tendencias()
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

        $current_year = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }

        $tendencias = DB::table('tendencias')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "tendencias")->take(4)->get();

        $tendencias_full = DB::table('tendencias')->where('pais', $data->id)->where('seccion', "tendencias")->get();


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;

        $resultData['pais'] = $data;
        $resultData['tendencias'] = $tendencias;
        $resultData['tendencias_full'] = $tendencias_full;
        $resultData['menu'] = "tendencias";
        $resultData['sub-menu'] = "";
        $resultData['breadcrumb'] = "Tendencias";
        $resultData['breadcrumb2'] = "";
        return view('usuarios/tendencias', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function ventas(Request $request)
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
        $resultData['deficit'] = "";
        $resultData['reservas'] = "";
        $resultData['tasa'] = "";
        $resultData['trm'] = "";

        $pais_selected = session('pais_selected');
        $data = $this->Paise->data_by_name($pais_selected);

        $country_data = DB::table('data')->where('pais', $data->id)->get();


    
        $current_year = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        $last_year = date('Y', strtotime($current_date. ' - 1 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }

        $ventas_1 = DB::table('ventas')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "ventas-1")->get();

        foreach( $ventas_1 as $value){

            if($value->name == "DEFICIT FISCAL"){

                $resultData['deficit'] = $value->valor;

            }else if($value->name == "RESERVAS INTERNACIONALES"){

                $resultData['reservas'] = $value->valor;

            }else if($value->name == "TASA DE INTERES"){

                $resultData['tasa'] = $value->valor;

            }else if($value->name == "TRM"){

                $resultData['trm'] = $value->valor;

            }


        }
        $current_ano_2 =  "";

        $first_ano_2 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('ano');

        if(count($first_ano_2) > 0){

            $current_ano_2 =  $first_ano_2[0]->ano;

        }
       
        
 

        if(isset($request->ano_2)){

            $current_ano_2 = $request->ano_2;
        }
        
        $ventas_2 = DB::table('ventas')
        ->leftJoin('regiones', DB::raw('lower(ventas.region)'), '=', DB::raw('lower(regiones.name)'))
        ->select('ventas.*', 'regiones.color')
        ->where('ventas.pais', $data->id)
        ->where('ventas.ano', $current_ano_2)
        ->where('ventas.seccion', "ventas-2")
        //->limit(100)
        ->get();
        $ventas_2_ano = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('ano');

        if($pais_selected == "Colombia"){
            $ventas_2_regiones = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('region');
        }else{
            $ventas_2_regiones = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('departamento');
        }

        
        $ventas_2_categoria = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('categoria');


        // $ventas_2_regiones_data = array();
        // if(count($ventas_2_regiones) > 0){

        //     $ventas_2_regiones_data[$ventas_2_regiones[0]->departamento] = array();

        //     $ventas_2_categoria_ = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('departamento', $ventas_2_regiones[0]->departamento)->get()->unique('categoria');

        //     if(count($ventas_2_categoria_) > 0){

        //         $ventas_2_regiones_data[$ventas_2_regiones[0]->departamento][$ventas_2_categoria_[0]->categoria] = array();

        //         $ventas_2_categoria_depa_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('departamento', $ventas_2_regiones[0]->departamento)->where('categirua', $ventas_2_categoria_[0]->categoria)->get();



        //     }




        // }



        $first_periodo_3 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-3")->get()->unique('periodo');

        $current_periodo_3 =  "";
        if(count($first_periodo_3) > 0){

            $current_periodo_3 =  $first_periodo_3[0]->periodo;
        }


       
        
 

        if(isset($request->periodo_3)){

            $current_periodo_3 = $request->periodo_3;
        }

        $ventas_3 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-3")->where('periodo', $current_periodo_3)->get();
        $ventas_3_periodo = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-3")->get()->unique('periodo');

        $labels = array();
        $dataset = array();

        $first_periodo = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('periodo');


        $current_periodo =  "";
        $current_categoria =  "";

        if(count($first_periodo) > 0){
            $current_periodo =  $first_periodo[0]->periodo;
            $current_categoria =  $first_periodo[0]->categoria;

        }

       
        


        if(isset($request->categoria)){

            $current_categoria = $request->categoria;
        }

        if(isset($request->periodo)){

            $current_periodo = $request->periodo;
        }


        $ventas_4_anos = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('ano');
        $ventas_4_mes = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('mes');
        $ventas_4_periodo = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('periodo');
        $ventas_4_categoria = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('categoria');
        
        $ventas_4_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->where('periodo',$current_periodo)->where('categoria',$current_categoria)->get()->unique('ano');
        $ventas_4_data_labels = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->where('periodo',$current_periodo)->where('categoria',$current_categoria)->get()->unique('mes');
        $ventas_4_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->where('periodo',$current_periodo)->where('categoria',$current_categoria)->get();


        if(count($ventas_4_data) > 0){

            foreach($ventas_4_data as $value){

                $dataset[$value->ano] = array();

            }


        }


        if(count($ventas_4_data_labels) > 0){

            foreach($ventas_4_data_labels as $value){


                    //$format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels, $value->mes);

            }


        }

        if(count($ventas_4_data_grafico) > 0){


                    foreach($ventas_4_data_grafico as $valor){

                        
                        array_push($dataset[$valor->ano], number_format($valor->valor,"0",",","."));

                    }



        }


        $labels2 = array();
        $dataset2 = array();

        $first_periodo_5 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('periodo');


       
        $current_periodo_5 =  $first_periodo_5[0]->periodo ?? "";
        $current_categoria_5 =  $first_periodo_5[0]->categoria ?? "";


        if(isset($request->categoria5)){

            $current_categoria_5 = $request->categoria5;
        }

        if(isset($request->periodo5)){

            $current_periodo_5 = $request->periodo5;
        }


        $ventas_5_anos = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('ano');
        $ventas_5_mes = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('mes');
        $ventas_5_periodo = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('periodo');
        $ventas_5_categoria = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('categoria');

        
        $ventas_5_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->where('periodo',$current_periodo_5)->where('categoria',$current_categoria_5)->get()->unique('ano');
        $ventas_5_data_labels = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->where('periodo',$current_periodo_5)->where('categoria',$current_categoria_5)->get()->unique('mes');
        $ventas_5_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->where('periodo',$current_periodo_5)->where('categoria',$current_categoria_5)->get();


        if(count($ventas_5_data) > 0){

            foreach($ventas_5_data as $value){

                $dataset2[$value->ano] = array();

            }


        }


        if(count($ventas_5_data_labels) > 0){

            foreach($ventas_4_data_labels as $value){


                    //$format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels2, $value->mes);

            }


        }

        if(count($ventas_5_data_grafico) > 0){


                    foreach($ventas_5_data_grafico as $valor){

                        
                        array_push($dataset2[$valor->ano], number_format($valor->valor,"0",",","."));

                    }



        }


        $labels3 = array();
        $dataset3 = array();
        $dataset4 = array();
        
        $ventas_6_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get()->unique('ano');
        $ventas_6_data_labels = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get()->unique('mes');
        $ventas_6_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get();



        


        // if(count($ventas_6_data) > 0){

        //     foreach($ventas_6_data as $value){

        //         $dataset3[$value->ano] = array();

        //     }


        // }


        if(count($ventas_6_data_labels) > 0){

            foreach($ventas_6_data_labels as $value){


                    //$format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels3, $value->mes);

            }


        }

        if(count($ventas_6_data_grafico) > 0){


                    foreach($ventas_6_data_grafico as $valor){

                        
                        array_push($dataset3, $valor->valor);
                        array_push($dataset4, $valor->valor_2);

                    }



        }



        $labels4 = array();
        $dataset5 = array();
        $dataset6 = array();
        
        $ventas_7_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get()->unique('ano');
        $ventas_7_data_labels = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get()->unique('mes');
        $ventas_7_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get();
        $ventas_8_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $last_year)->get();



        


        // if(count($ventas_6_data) > 0){

        //     foreach($ventas_6_data as $value){

        //         $dataset3[$value->ano] = array();

        //     }


        // }


        if(count($ventas_7_data_labels) > 0){

            foreach($ventas_7_data_labels as $value){


                    //$format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels4, $value->mes);

            }


        }

        if(count($ventas_7_data_grafico) > 0){


                    foreach($ventas_7_data_grafico as $valor){

                        
                        array_push($dataset5, $valor->valor);
                        

                    }



        }

        if(count($ventas_8_data_grafico) > 0){


            foreach($ventas_8_data_grafico as $valor){

                
                array_push($dataset6, $valor->valor);
                

            }



        }

        $ventas_8 = DB::table('ventas')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "ventas-7")->get();


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
                $resultData['notificaciones'] = $notificaciones;



        $resultData['pais'] = $data;
        $resultData['menu'] = "ventas";
        $resultData['sub-menu'] = "";
        $resultData['ventas_2'] = $ventas_2;
        $resultData['ventas_2_ano'] = $ventas_2_ano;
        $resultData['ventas_2_ano_selected'] = $current_ano_2;
        $resultData['ventas_3_periodo_selected'] = $current_periodo_3;
        $resultData['ventas_3'] = $ventas_3;
        $resultData['ventas_3_periodo'] = $ventas_3_periodo;
        $resultData['ventas_3_periodo_selected'] = $current_periodo_3;
        $resultData['breadcrumb'] = "Ventas";
        $resultData['breadcrumb2'] = "Mercado Local";

        $resultData['colores'] = [];

        for ($i = 0; $i < 100; $i++) {
            $resultData['colores'][] = self::generateRandomHexColor($resultData['colores']);
        }

        $resultData['colores2'] = [];

        for ($i = 0; $i < 100; $i++) {
            $resultData['colores2'][] = self::generateRandomHexColor($resultData['colores2']);
        }
        //$resultData['colores'] = array("#dc2727", "#facc15", "#facc15","#dc2727", "#fa09e2", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#35495e", "#35495e", "#35495e", "#35495e" );
        //$resultData['colores2'] = array("#35495e", "#84cc16", "#facc15","#dc2727", "#fa09e2", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#000000" );

        $resultData['ventas_4_data'] = $ventas_4_data;
        $resultData['ventas_4_data_grafico'] = $ventas_4_data_grafico;
        $resultData['ventas_4_labels'] = $labels;
        $resultData['ventas_4_dataset'] = $dataset;
        $resultData['ventas_4_periodo'] = $ventas_4_periodo;
        $resultData['ventas_4_categoria'] = $ventas_4_categoria;
        $resultData['ventas_4_periodo_selected'] = $current_periodo;
        $resultData['ventas_4_categoria_selected'] = $current_categoria;


        $resultData['ventas_5_data'] = $ventas_5_data;
        $resultData['ventas_5_data_grafico'] = $ventas_5_data_grafico;
        $resultData['ventas_5_labels'] = $labels2;
        $resultData['ventas_5_dataset'] = $dataset2;
        $resultData['ventas_5_periodo'] = $ventas_5_periodo;
        $resultData['ventas_5_categoria'] = $ventas_5_categoria;
        $resultData['ventas_5_periodo_selected'] = $current_periodo_5;
        $resultData['ventas_5_categoria_selected'] = $current_categoria_5;

        $resultData['ventas_6_data'] = $ventas_6_data;
        $resultData['ventas_6_data_grafico'] = $ventas_6_data_grafico;
        $resultData['ventas_6_labels'] = $labels3;
        $resultData['ventas_6_dataset'] = $dataset3;
        $resultData['ventas_6_dataset2'] = $dataset4;


        $resultData['ventas_7_data'] = $ventas_7_data;
        $resultData['ventas_7_data_grafico'] = $ventas_7_data_grafico;
        $resultData['ventas_7_labels'] = $labels4;
        $resultData['ventas_7_dataset'] = $dataset5;
        $resultData['ventas_7_dataset2'] = $dataset6;
        $resultData['current_year'] = $current_year;
        $resultData['last_year'] = $last_year;

        $resultData['ventas_8'] = $ventas_8;
        



        return view('usuarios/ventas', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function cambiarClave()
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

        $current_year = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }



        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;

        $resultData['pais'] = $data;
        $resultData['menu'] = "cambiar-clave";
        $resultData['sub-menu'] = "";
        $resultData['breadcrumb'] = "Cambio de Clave";
        $resultData['breadcrumb2'] = "";
        return view('usuarios/cambiar-clave', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function claveChange(Request $request)
    {

        $clave = $request->clave;
        $clavec = $request->clavec;
        $data = array();
        $message = array();
        $errorMessage = array();

        if(strlen($clave) < 8){

            return redirect()->back()->withErrors(["La clave debe tener minimo 8 caracteres"]);

        }else{

            if($clave != $clavec){

                return redirect()->back()->withErrors(["Claves no coinciden"]);

            }else{
            $data = array(
                    'password' => Hash::make($clave),
                    'updated_at' => date('Y-m-d H:i:s')
      
              );

              $this->User->updaterecord(Auth::user()->id, $data);

              return redirect()->back()->with('update', 'Clave Actualizada!');

            }



        }

        
    }
    public function ventas_new(Request $request)
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
        $previous_year = date("Y",strtotime("-1 year"));
        $resultData['permisos'] = $data_permisos;
        $resultData['paises'] = $data_paises;
        $resultData['paises_list'] = $paises;
        $resultData['deficit'] = "";
        $resultData['reservas'] = "";
        $resultData['tasa'] = "";
        $resultData['trm'] = "";

        $pais_selected = session('pais_selected');
        $data = $this->Paise->data_by_name($pais_selected);

        $country_data = DB::table('data')->where('pais', $data->id)->get();


    
        $current_year = date("Y");
        $current_date = date("Y-m-d");
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        $last_year = date('Y', strtotime($current_date. ' - 1 years'));
        if(isset($request->year)){

            $current_year = $request->year;

        }

        $ventas_1 = DB::table('ventas')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "ventas-1")->get();

        foreach( $ventas_1 as $value){

            if($value->name == "DEFICIT FISCAL"){

                $resultData['deficit'] = $value->valor;

            }else if($value->name == "RESERVAS INTERNACIONALES"){

                $resultData['reservas'] = $value->valor;

            }else if($value->name == "TASA DE INTERES"){

                $resultData['tasa'] = $value->valor;

            }else if($value->name == "TRM"){

                $resultData['trm'] = $value->valor;

            }


        }
        $current_ano_2 =  "";

        $first_ano_2 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('ano');

        if(count($first_ano_2) > 0){

            $current_ano_2 =  $first_ano_2[0]->ano;

        }
       
        
 

        if(isset($request->ano_2)){

            $current_ano_2 = $request->ano_2;
        }



        if(isset($_GET["filter-year-1"])){

            if($_GET["filter-year-1"] == ""){

                $current_ano_2 =  $first_ano_2[0]->ano;

                
            }else{

                $current_ano_2 = $_GET["filter-year-1"];

            }

            
        }
        
        $ventas_2 = DB::table('ventas')
        ->leftJoin('regiones', DB::raw('lower(ventas.region)'), '=', DB::raw('lower(regiones.name)'))
        ->select('ventas.*', 'regiones.color')
        ->where('ventas.pais', $data->id)
        ->where('ventas.ano', $current_ano_2)
        ->where('ventas.seccion', "ventas-2")
        //->limit(100)
        ->get();
        $ventas_2_ano = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('ano');

        if($pais_selected == "Colombia"){
            $ventas_2_regiones = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('ano', $current_ano_2)->get()->unique('region');
        }else{
            $ventas_2_regiones = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('ano', $current_ano_2)->get()->unique('departamento');
        }

        
        $ventas_2_categoria = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('categoria');




        $ventas_2_regiones_data = array();
        if(count($ventas_2_regiones) > 0){

            foreach($ventas_2_regiones as $valor){

                if($pais_selected == "Colombia"){

                    if($valor->region != "N/A"){
                        $ventas_2_categoria_ = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('ano', $current_ano_2)->where('region', $valor->region)->get()->unique('categoria');

                        $name_region = strtolower($valor->region);
                        $ventas_2_regiones_data[$valor->region]["color"] = "#FFFFFF";

                        $query_regiones = DB::table('regiones')->where(DB::raw('lower(name)'), '=', $name_region)->get();

                        if(count($query_regiones) > 0){

                            $ventas_2_regiones_data[$valor->region]["color"] = $query_regiones[0]->color;

                        }

                        

                        if(count($ventas_2_categoria_) > 0){
    
                            foreach($ventas_2_categoria_ as $valor2){
    
    
                                $ventas_2_categoria_data = DB::table('ventas')
                                ->select(['marca', DB::raw("SUM(ventas_netas_toneladas) as toneladas_netas"), DB::raw("SUM(ventas_netas) as total_ventas")])
                                ->where('pais', $data->id)->where('seccion', "ventas-2")->where('region', $valor->region)->where('ano', $current_ano_2)->where("categoria", $valor2->categoria)
                                ->groupBy('marca')
                                ->get();
    
                                if(count($ventas_2_categoria_data)> 0){
    
                                    $ventas_2_regiones_data[$valor->region][$valor2->categoria] = $ventas_2_categoria_data;
    
    
    
                                }
    
    
    
    
                            }
    
    
    
    
                        }

                    }

                    




                }else{

                    if($valor->departamento != "N/A"){

                        $ventas_2_categoria_ = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('ano', $current_ano_2)->where('departamento', $valor->departamento)->get()->unique('categoria');

                        $name_region = strtolower($valor->departamento);
                        $ventas_2_regiones_data[$valor->departamento]["color"] = "#FFFFFF";

                        $query_regiones = DB::table('regiones')->where(DB::raw('lower(name)'), '=', $name_region)->get();

                        if(count($query_regiones) > 0){

                            $ventas_2_regiones_data[$valor->departamento]["color"] = $query_regiones[0]->color;

                        }

                        if(count($ventas_2_categoria_) > 0){
    
                            foreach($ventas_2_categoria_ as $valor2){
    
    
                                $ventas_2_categoria_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('ano', $current_ano_2)->where('departamento', $valor->departamento)->where("categoria", $valor2->categoria)->get();
    
                                if(count($ventas_2_categoria_data)> 0){
    
                                    $ventas_2_regiones_data[$valor->departamento][$valor2->categoria] = $ventas_2_categoria_data;
    
    
    
                                }
    
    
    
    
                            }
    
    
    
    
                        }

                    }







                }



            }

        }

        //dd($ventas_2_regiones_data);



        $first_periodo_3 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-3")->get()->unique('periodo');

        $current_periodo_3 =  "";
        if(count($first_periodo_3) > 0){

            $current_periodo_3 =  $first_periodo_3[0]->periodo;
        }


       
        
 

        if(isset($_GET["filter-periodo-1"])){

            if($_GET["filter-periodo-1"] == ""){

                $current_periodo_3 =  $first_periodo_3[0]->periodo;


            }else{

                $current_periodo_3 = $_GET["filter-periodo-1"];

            }

            
        }

        $ventas_3 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-3")->where('periodo', $current_periodo_3)->get();
        $ventas_3_periodo = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-3")->get()->unique('periodo');

        $labels = array();
        $dataset = array();

        $first_periodo = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('periodo');


        $current_periodo =  "";
        $current_categoria =  "";

        if(count($first_periodo) > 0){
            $current_periodo =  $first_periodo[0]->periodo;
            $current_categoria =  $first_periodo[0]->categoria;

        }

       
        


        if(isset($_GET["filter-periodo-2"]) && isset($_GET["filter-marca-1"])){

            $current_periodo = $_GET["filter-periodo-2"];
            $current_categoria = $_GET["filter-marca-1"];

            if($current_periodo == ""){

                $current_periodo =  $first_periodo[0]->periodo;

            }

            if($current_categoria == ""){

                $current_categoria =  $first_periodo[0]->categoria;
            }





        }


        $ventas_4_anos = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('ano');
        $ventas_4_mes = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('mes');
        $ventas_4_periodo = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('periodo');
        $ventas_4_categoria = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('categoria');
        
        $ventas_4_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->where('periodo',$current_periodo)->where('categoria',$current_categoria)->get()->unique('ano');
        $ventas_4_data_labels = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->where('periodo',$current_periodo)->where('categoria',$current_categoria)->get()->unique('mes');
        $ventas_4_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->where('periodo',$current_periodo)->where('categoria',$current_categoria)->get();


        if(count($ventas_4_data) > 0){

            foreach($ventas_4_data as $value){

                $dataset[$value->ano] = array();

            }


        }


        if(count($ventas_4_data_labels) > 0){

            foreach($ventas_4_data_labels as $value){


                    //$format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels, $value->mes);

            }


        }

        if(count($ventas_4_data_grafico) > 0){


                    foreach($ventas_4_data_grafico as $valor){

                        
                        array_push($dataset[$valor->ano], number_format($valor->valor,"0",",","."));

                    }



        }


        $labels2 = array();
        $dataset2 = array();

        $first_periodo_5 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('periodo');


       
        $current_periodo_5 =  $first_periodo_5[0]->periodo ?? "";
        $current_categoria_5 =  $first_periodo_5[0]->categoria ?? "";


        if(isset($_GET["filter-periodo-3"]) && isset($_GET["filter-marca-2"])){

            $current_periodo_5 = $_GET["filter-periodo-3"];
            $current_categoria_5 = $_GET["filter-marca-2"];

            if($current_periodo_5 == ""){

                $current_periodo_5 =  $first_periodo_5[0]->periodo ?? "";

            }

            if($current_categoria_5 == ""){

                $current_categoria_5 =  $first_periodo_5[0]->categoria ?? "";
            }





        }


        $ventas_5_anos = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('ano');
        $ventas_5_mes = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('mes');
        $ventas_5_periodo = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('periodo');
        $ventas_5_categoria = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('categoria');

        
        $ventas_5_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->where('periodo',$current_periodo_5)->where('categoria',$current_categoria_5)->get()->unique('ano');
        $ventas_5_data_labels = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->where('periodo',$current_periodo_5)->where('categoria',$current_categoria_5)->get()->unique('mes');
        $ventas_5_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->where('periodo',$current_periodo_5)->where('categoria',$current_categoria_5)->get();


        if(count($ventas_5_data) > 0){

            foreach($ventas_5_data as $value){

                $dataset2[$value->ano] = array();

            }


        }


        if(count($ventas_5_data_labels) > 0){

            foreach($ventas_4_data_labels as $value){


                    //$format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels2, $value->mes);

            }


        }

        if(count($ventas_5_data_grafico) > 0){


                    foreach($ventas_5_data_grafico as $valor){

                        
                        array_push($dataset2[$valor->ano], number_format($valor->valor,"0",",","."));

                    }



        }


        $labels3 = array();
        $dataset3 = array();
        $dataset4 = array();
        
        $ventas_6_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get()->unique('ano');
        $ventas_6_data_labels = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get()->unique('mes');
        $ventas_6_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get();



        


        // if(count($ventas_6_data) > 0){

        //     foreach($ventas_6_data as $value){

        //         $dataset3[$value->ano] = array();

        //     }


        // }


        if(count($ventas_6_data_labels) > 0){

            foreach($ventas_6_data_labels as $value){


                    //$format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels3, $value->mes);

            }


        }

        if(count($ventas_6_data_grafico) > 0){


                    foreach($ventas_6_data_grafico as $valor){

                        
                        array_push($dataset3, $valor->valor);
                        array_push($dataset4, $valor->valor_2);

                    }



        }



        $labels4 = array();
        $dataset5 = array();
        $dataset6 = array();
        
        $ventas_7_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get()->unique('ano');
        $ventas_7_data_labels = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get()->unique('mes');
        $ventas_7_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $current_year)->get();
        $ventas_8_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-6")->where('ano', $last_year)->get();



        


        // if(count($ventas_6_data) > 0){

        //     foreach($ventas_6_data as $value){

        //         $dataset3[$value->ano] = array();

        //     }


        // }


        if(count($ventas_7_data_labels) > 0){

            foreach($ventas_7_data_labels as $value){


                    //$format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels4, $value->mes);

            }


        }

        if(count($ventas_7_data_grafico) > 0){


                    foreach($ventas_7_data_grafico as $valor){

                        
                        array_push($dataset5, $valor->valor);
                        

                    }



        }

        if(count($ventas_8_data_grafico) > 0){


            foreach($ventas_8_data_grafico as $valor){

                
                array_push($dataset6, $valor->valor);
                

            }



        }

        $ventas_8 = DB::table('ventas')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "ventas-7")->get();




        $country_data = DB::table('data')->where('pais', $data->id)->get();

        $data_pais["pib"] = "";
        $data_pais["pib_per_capita"] = "";
        $data_pais["inflacion"] = "";
        $data_pais["salario_minimo"] = "";
        $data_pais["tasa_cambio"] = "";
        $data_pais["big_mac"] = "";
        $data_pais["poblacion_activa"] = "";
        $data_pais["consumo_hpm"] = "";
        $data_pais["consumo_hpm_fuente"] = "";
        $data_pais["share_volumen"] = "";
        $data_pais["share_volumen_fuente"] = "";
        $data_pais["precio_compra"] = "";
        $data_pais["precio_compra_fuente"] = "";
        $data_pais["share_valor"] = "";
        $data_pais["share_valor_fuente"] = "";
        $data_pais["tasa_desempleo"] = "";
        $data_pais["plan_operativo_local_real"] = "";
        $data_pais["plan_operativo_local_plan"] = "";
        $data_pais["plan_operativo_local_cumplimiento"] = "";
        $data_pais["plan_operativo_local_restante"] = "";
        $data_pais["plan_operativo_export_real"] = "";
        $data_pais["plan_operativo_export_plan"] = "";
        $data_pais["plan_operativo_export_cumplimiento"] = "";
        $data_pais["plan_operativo_export_restante"] = "";

        $data_pais["pib_fuente"] = "";
        $data_pais["pib_variacion"] = "";
        $data_pais["pib_per_capita_fuente"] = "";
        $data_pais["pib_per_capita_variacion"] = "";
        $data_pais["inflacion_fuente"] = "";
        $data_pais["inflacion_variacion"] = "";
        $data_pais["salario_minimo_fuente"] = "";
        $data_pais["salario_minimo_variacion"] = "";
        $data_pais["tasa_cambio_fuente"] = "";
        $data_pais["tasa_cambio_variacion"] = "";
        $data_pais["big_mac_fuente"] = "";
        $data_pais["big_mac_variacion"] = "";
        $data_pais["poblacion_activa_fuente"] = "";
        $data_pais["poblacion_activa_variacion"] = "";
        $data_pais["tasa_desempleo_fuente"] = "";
        $data_pais["tasa_desempleo_variacion"] = "";

        $replace = array("$", "%");

        if(count($country_data) > 0){


            foreach($country_data as $valor){

                if($valor->item == 'pib_(usd_mm)'){

                    $data_pais["pib"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["pib_fuente"] = $valor->fuente;
                    $data_pais["pib_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'pib_(usd_mm)')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["pib_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'pib_per_capital'){

                    $data_pais["pib_per_capita"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["pib_per_capita_fuente"] = $valor->fuente;
                    $data_pais["pib_per_capita_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'pib_per_capital')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["pib_per_capita_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'inflacion_(usd_mm)'){
                    
                    $data_pais["inflacion"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["inflacion_fuente"] = $valor->fuente;
                    $data_pais["inflacion_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'inflacion_(usd_mm)')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["inflacion_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'salario_minimo'){
                    
                    $data_pais["salario_minimo"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["salario_minimo_fuente"] = $valor->fuente;
                    $data_pais["salario_minimo_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'salario_minimo')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["salario_minimo_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'tasa_de_cambio'){
                    
                    $data_pais["tasa_cambio"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["tasa_cambio_fuente"] = $valor->fuente;
                    $data_pais["tasa_cambio_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'tasa_de_cambio')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["tasa_cambio_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'indice_big_mac'){
                    
                    $data_pais["big_mac"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["big_mac_fuente"] = $valor->fuente;
                    $data_pais["big_mac_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'indice_big_mac')->first();

                    if(!empty($country_data_last_year)){

                        if($country_data_last_year->dato != 0){

                            $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                            $variacion_porcentaje = $variacion * 100;
                            $data_pais["big_mac_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");
                        }

                       

                    }

                }elseif($valor->item == 'poblacion_activa'){
                    
                    $replace_ = array("$", "%");
                    $data_pais["poblacion_activa"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["poblacion_activa_fuente"] = $valor->fuente;
                    $data_pais["poblacion_activa_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'poblacion_activa')->first();

                    if(!empty($country_data_last_year)){

                        $variacion = str_replace($replace_, "", $valor->dato)/str_replace($replace_, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["poblacion_activa_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");

                    }

                }elseif($valor->item == 'tasa_de_desempleo'){
                    
                    $data_pais["tasa_desempleo"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["tasa_desempleo_fuente"] = $valor->fuente;
                    $data_pais["tasa_desempleo_variacion"] = "";

                    $country_data_last_year = DB::table('data')->where('pais', $data->id)->where('ano', $previous_year)->where('item', 'tasa_de_desempleo')->first();

                    if(!empty($country_data_last_year)){

                        if(!is_null($valor->dato) && !is_null($country_data_last_year->dato)){

                       
                        $variacion = str_replace($replace, "", $valor->dato)/str_replace($replace, "", $country_data_last_year->dato);
                        $variacion_porcentaje = $variacion * 100;
                        $data_pais["tasa_desempleo_variacion"] = number_format($variacion_porcentaje-100, "2", ",",".");
                    }

                    }

                }elseif($valor->item == 'consumo_hpm'){
                    
                    $data_pais["consumo_hpm"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["consumo_hpm_fuente"] = $valor->fuente;

                }elseif($valor->item == 'precio_compra_mb-ep_($/toneladas)'){
                    
                    $data_pais["precio_compra"] = number_format(str_replace($replace, "", $valor->dato ?? 0),"2", ",",".");
                    $data_pais["precio_compra_fuente"] = $valor->fuente;

                }elseif($valor->item == 'share_volumen'){
                    
                    $dato_tmp = $valor->dato ?? 0;
                    $data_pais["share_volumen"] = number_format(str_replace($replace, "", $dato_tmp*100 ),"2", ",",".");
                    $data_pais["share_volumen_fuente"] = $valor->fuente;

                }elseif($valor->item == 'share_valor'){
                    $dato_tmp = $valor->dato ?? 0;
                    $data_pais["share_valor"] = number_format(str_replace($replace, "", $dato_tmp*100),"2", ",",".");
                    $data_pais["share_valor_fuente"] = $valor->fuente;

                }elseif($valor->item == 'plan_operativo_local'){
                    
                    $data_pais["plan_operativo_local_real"] = $valor->dato ?? 0;
                    $data_pais["plan_operativo_local_plan"] = $valor->dato_2 ?? 0;
                    $data_pais["plan_operativo_local_cumplimiento"] = $valor->dato_3*100;
                    $data_pais["plan_operativo_local_restante"] = 100-($valor->dato_3*100);

                }elseif($valor->item == 'plan_operativo_export'){
                    
                    $data_pais["plan_operativo_export_real"] = $valor->dato ?? 0;
                    $data_pais["plan_operativo_export_plan"] = $valor->dato_2 ?? 0;
                    $data_pais["plan_operativo_export_cumplimiento"] = $valor->dato_3*100;
                    $data_pais["plan_operativo_export_restante"] = 100-($valor->dato_3*100);

                }




            }




        }

        $labels_kpi = array();
        $dataset_kpi = array();
        
        $kpi2_data = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-2")->get()->unique('name');
        $kpi2_data_labels = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-2")->get()->unique('ano');
        $kpi2_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-2")->get();


        if(count($kpi2_data) > 0){

            foreach($kpi2_data as $value){

                $dataset_kpi[$value->item] = array();

            }


        }


        if(count($kpi2_data_labels) > 0){

            foreach($kpi2_data_labels as $value){


                    $format_data = date("M-Y", strtotime($value->ano));
                    array_push($labels_kpi, $format_data);

            }


        }

        if(count($kpi2_data_grafico) > 0){


                    foreach($kpi2_data_grafico as $valor){

                        
                        array_push($dataset_kpi[$valor->item], $valor->dato);

                    }



        }


        $kpi3_data = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-3")->get();

        $kpi4_data = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-4")->get();


        
        $ventas_exportaciones_filtro = DB::table('ventas_exportaciones')->where('pais_origen', $data->id)->get()->unique('periodo');
        $current_periodo_hpm =  "";
        if(count($ventas_exportaciones_filtro) > 0){

            $current_periodo_hpm =  $ventas_exportaciones_filtro[0]->periodo;
        }

        $ventas_exportaciones = DB::table('ventas_exportaciones')->where('pais_origen', $data->id)->where('periodo', $current_periodo_hpm)->get();
        $ventas_exportaciones_total = DB::table('ventas_exportaciones')
        ->where('pais_origen', $data->id)
        ->where('periodo', $current_periodo_hpm)
        ->get()
        ->sum("kilos");



        $resultData['current_periodo_hpm'] = $current_periodo_hpm;
        $resultData['ventas_exportaciones'] = $ventas_exportaciones;
        $resultData['ventas_exportaciones_filtro'] = $ventas_exportaciones_filtro;
        $resultData['ventas_exportaciones_total'] = $ventas_exportaciones_total;



        $labels_demografico6 = array();
        $dataset_demografico6 = array();
        $dataset2_demografico6 = array();
        $colors_demografico6 = array();
        $demografico6_data = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-3")->orderBy('ano', 'asc')->get()->unique('ano');
        $demografico6_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "kpi-3")->orderBy('ano', 'asc')->get();

        $dataset_real = array();
        $dataset_planificado = array();


        if(count($demografico6_data) > 0){

            foreach($demografico6_data as $value){

                
                array_push($labels_demografico6, $value->ano);
            }


        }
        if(count($demografico6_data_grafico) > 0){


            foreach($demografico6_data_grafico as $key => $valor){

                
                
                array_push($dataset_real, ($valor->dato));
                array_push($dataset_planificado, ($valor->dato_2));


            }



        }


        $labels_plan_operativo_a = array();
        $dataset_plan_operativo_a = array();
        $dataset2_plan_operativo_a = array();
        $colors_plan_operativo_a = array();
        $plan_operativo_a_data = DB::table('data')->where('pais', $data->id)->where('seccion', "plan-operativo-a")->get()->unique('ano');
        $plan_operativo_a_data_grafico = DB::table('data')->where('pais', $data->id)->where('seccion', "plan-operativo-a")->get();

        $dataset_plan_operativo_a_real = array();
        $dataset__plan_operativo_a_planificado = array();


        if(count($plan_operativo_a_data) > 0){

            foreach($plan_operativo_a_data as $value){

                
                array_push($labels_plan_operativo_a, $value->ano);
            }


        }
        if(count($plan_operativo_a_data_grafico) > 0){


            foreach($plan_operativo_a_data_grafico as $key => $valor){

                
                
                array_push($dataset_plan_operativo_a_real, ($valor->dato));
                array_push($dataset__plan_operativo_a_planificado, ($valor->dato_2));


            }



        }


        $notificaciones = DB::table('notificaciones')->where('pais', $data->id)->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())->orderBy("created_at", "desc")->take(10)->get();
        $resultData['notificaciones'] = $notificaciones;
        
        $resultData['colores'] = [];

        for ($i = 0; $i < 100; $i++) {
            $resultData['colores'][] = self::generateRandomHexColor($resultData['colores']);
        }
        //$resultData['colores'] = array("#35495e", "#84cc16", "#facc15","#dc2727", "#fa09e2", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#000000" );
        $resultData['pais'] = $data;
        $resultData['data'] = $data_pais;
        $resultData['kpi2_data'] = $kpi2_data;
        $resultData['kpi2_data_grafico'] = $kpi2_data_grafico;
        $resultData['kpi2_labels'] = $labels_kpi;
        $resultData['kpi2_dataset'] = $dataset_kpi;
        $resultData['kpi4_data'] = $kpi4_data;
        $resultData['dataset_real'] = $dataset_real;
        $resultData['dataset_planificado'] = $dataset_planificado;
        $resultData['labels_demografico6'] = $labels_demografico6;
        $resultData['notificaciones'] = $notificaciones;

        $resultData['dataset_plan_operativo_a_real'] = $dataset_plan_operativo_a_real;
        $resultData['dataset__plan_operativo_a_planificado'] = $dataset__plan_operativo_a_planificado;
        $resultData['labels_plan_operativo_a'] = $labels_plan_operativo_a;



        $resultData['pais'] = $data;
        $resultData['menu'] = "ventas";
        $resultData['sub-menu'] = "mercado-local";
        $resultData['ventas_2'] = $ventas_2;
        $resultData['ventas_2_ano'] = $ventas_2_ano;
        $resultData['ventas_2_ano_selected'] = $current_ano_2;
        $resultData['ventas_2_regiones_data'] = $ventas_2_regiones_data;
        $resultData['ventas_3_periodo_selected'] = $current_periodo_3;
        $resultData['ventas_3'] = $ventas_3;
        $resultData['ventas_3_periodo'] = $ventas_3_periodo;
        $resultData['ventas_3_periodo_selected'] = $current_periodo_3;
        $resultData['breadcrumb'] = "Ventas";
        $resultData['breadcrumb2'] = "Mercado Local";
        $resultData['colores'] = [];

        for ($i = 0; $i < 100; $i++) {
            $resultData['colores'][] = self::generateRandomHexColor($resultData['colores']);
        }

        $resultData['colores2'] = [];

        for ($i = 0; $i < 100; $i++) {
            $resultData['colores2'][] = self::generateRandomHexColor($resultData['colores2']);
        }
        //$resultData['colores'] = array("#dc2727", "#facc15", "#facc15","#dc2727", "#fa09e2", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#35495e", "#35495e", "#35495e", "#35495e" );
        //$resultData['colores2'] = array("#35495e", "#84cc16", "#facc15","#dc2727", "#fa09e2", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#000000" );

        $resultData['ventas_4_data'] = $ventas_4_data;
        $resultData['ventas_4_data_grafico'] = $ventas_4_data_grafico;
        $resultData['ventas_4_labels'] = $labels;
        $resultData['ventas_4_dataset'] = $dataset;
        $resultData['ventas_4_periodo'] = $ventas_4_periodo;
        $resultData['ventas_4_categoria'] = $ventas_4_categoria;
        $resultData['ventas_4_periodo_selected'] = $current_periodo;
        $resultData['ventas_4_categoria_selected'] = $current_categoria;


        $resultData['ventas_5_data'] = $ventas_5_data;
        $resultData['ventas_5_data_grafico'] = $ventas_5_data_grafico;
        $resultData['ventas_5_labels'] = $labels2;
        $resultData['ventas_5_dataset'] = $dataset2;
        $resultData['ventas_5_periodo'] = $ventas_5_periodo;
        $resultData['ventas_5_categoria'] = $ventas_5_categoria;
        $resultData['ventas_5_periodo_selected'] = $current_periodo_5;
        $resultData['ventas_5_categoria_selected'] = $current_categoria_5;

        $resultData['ventas_6_data'] = $ventas_6_data;
        $resultData['ventas_6_data_grafico'] = $ventas_6_data_grafico;
        $resultData['ventas_6_labels'] = $labels3;
        $resultData['ventas_6_dataset'] = $dataset3;
        $resultData['ventas_6_dataset2'] = $dataset4;


        $resultData['ventas_7_data'] = $ventas_7_data;
        $resultData['ventas_7_data_grafico'] = $ventas_7_data_grafico;
        $resultData['ventas_7_labels'] = $labels4;
        $resultData['ventas_7_dataset'] = $dataset5;
        $resultData['ventas_7_dataset2'] = $dataset6;
        $resultData['current_year'] = $current_year;
        $resultData['last_year'] = $last_year;

        $resultData['ventas_8'] = $ventas_8;
        



        return view('usuarios/ventas-new-2', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function lisventasregiones(Request $request)
    {
        if ($request->ajax()) {

          // $data = DB::table('solicitud_cambios')
          // ->leftJoin('atletas', 'solicitud_cambios.atleta', '=', 'atletas.id')
          // ->select('atletas.*')
          // ->where('atletas.fecha_vencimiento', '<=', date("Y-m-d"))
          // ->get();

          $pais_selected = session('pais_selected');
          $data = $this->Paise->data_by_name($pais_selected);

          $first_ano_2 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('ano');

          if(count($first_ano_2) > 0){
  
              $current_ano_2 =  $first_ano_2[0]->ano;
  
          }
         
          
   
  
          if(isset($request->ano_2)){
  
              $current_ano_2 = $request->ano_2;
          }

          $data = DB::table('ventas')->where('pais', $data->id)->where('ano', $current_ano_2)->where('seccion', "ventas-2")->get();


          //$data = Atleta::whereNotNull("fecha_emision_carnet")->where('fecha_vencimiento', '>=', date('Y-m-d H:is'))->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }

        // return $data;
    }
    public function filtroInvestigacionGlobal(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);
            $ano = $request->ano;
            $global_data = DB::table('informes')->where('pais', $data->id)->where('year', $ano)->where('seccion', "global-investigacion")->get();

            return json_encode($global_data);
        }

        // return view('user');
    }
    public function filtroPanelHogares(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);

            
    
            if($request->tipo == 1){

                $current_year_categoria = date("Y");
                $current_categoria = "";
                $data_categorias = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "categoria")->get();

                $current_year_categoria = $request->ano;
                $current_categoria = $request->categoria;
    
                if($request->ano != "" && $request->categoria == ""){
    
                    $data_categorias = DB::table('panel_hogares')->where('pais', $data->id)->where('periodo', $current_year_categoria)->where('seccion', "categoria")->get();
    
    
    
                }elseif($request->ano == "" && $request->categoria != ""){
    
    
                    $data_categorias = DB::table('panel_hogares')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('seccion', "categoria")->get();
    
    
                }elseif($request->ano != "" && $request->categoria != ""){
    
                    $data_categorias = DB::table('panel_hogares')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('periodo', $current_year_categoria)->where('seccion', "categoria")->get();
    
    
    
                }


                return json_encode($data_categorias);

            }else if($request->tipo == 2){

                $current_year_2 = date("Y");

                $consumo_dentro_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumo_dentro_del_hogar")->get();


        if(isset($request->ano)){


            if($request->ano == ""){

                $consumo_dentro_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumo_dentro_del_hogar")->get();



            }else{

                $current_year_2 = $request->ano;
                $consumo_dentro_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('periodo', $current_year_2)->where('seccion', "consumo_dentro_del_hogar")->get();
            }


        }
        


        return json_encode($consumo_dentro_hogar_data);
                
            }else if($request->tipo == 3){

                $current_year_3 = date("Y");

                $consumo_fuera_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumo_fuera_del_hogar")->get();


                if(isset($request->ano)){
        
                    if($request->ano == ""){
        
        
                        $current_year_3 = date("Y");
                        $consumo_fuera_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumo_fuera_del_hogar")->get();
        
        
        
                    }else{
        
                        $current_year_3= $request->ano;
                        $consumo_fuera_hogar_data = DB::table('panel_hogares')->where('pais', $data->id)->where('periodo', $current_year_3)->where('seccion', "consumo_fuera_del_hogar")->get();
                    }
        
        
                }
                
        

                return json_encode($consumo_fuera_hogar_data);
                
            }else if($request->tipo == 4){

                $current_year_4 = date("Y");

                $lugar_de_compra_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "lugar_compra")->get();


                if(isset($request->ano)){
        
                    if($request->ano == ""){
        
        
                        $current_year_4 = date("Y");
                        $lugar_de_compra_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "lugar_compra")->get();
        
        
        
                    }else{
        
                        $current_year_4 = $request->ano;
                        $lugar_de_compra_data = DB::table('panel_hogares')->where('pais', $data->id)->where('periodo', $current_year_4)->where('seccion', "lugar_compra")->get();
                    }
        
        
                }
                


                return json_encode($lugar_de_compra_data);
                
            }else if($request->tipo == 5){

                $current_year_5 = date("Y");
                $current_cliente = "";
        
        
                $consumidores_data = DB::table('panel_hogares')->where('pais', $data->id)->where('seccion', "consumidores-clientes")->get();
        
        
        
                    $current_year_5 = $request->ano ?? "";
                    $current_cliente = $request->categoria ?? "";
        
                    if($request->ano != "" && $request->categoria == ""){
        
                        $consumidores_data = DB::table('panel_hogares')->where('pais', $data->id)->where('periodo', $current_year_5)->where('seccion', "consumidores-clientes")->get();
        
        
        
                    }elseif($request->ano == "" && $request->categoria != ""){
        
        
                        $consumidores_data = DB::table('panel_hogares')->where('pais', $data->id)->where('nombre_tipo', $current_cliente)->where('seccion', "consumidores-clientes")->get();
        
        
                    }elseif($request->ano != "" && $request->categoria != ""){
        
                        $consumidores_data = DB::table('panel_hogares')->where('pais', $data->id)->where('nombre_tipo', $current_cliente)->where('periodo', $current_year_5)->where('seccion', "consumidores-clientes")->get();
        
        
        
                    }
        
        
        
           

                return json_encode($consumidores_data);
                
            }
    
           



        }

        // return view('user');
    }
    public function filtroInvestigacionOtros(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);
            $ano = $request->ano;
            $query = DB::table('otros_data')->where('pais', $data->id)->where('ano', $ano)->where('seccion', "INVESTIGACION")->get();


         
            return json_encode($query);
        }

        // return view('user');
    }
    public function filtroPrecios(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);
            $ano = $request->ano;
            $global_data = DB::table('precios')->where('pais', $data->id)->where('periodo', $ano)->where('seccion', "precios-informes")->get();

            return json_encode($global_data);
        }

        // return view('user');
    }
    public function filtroAnalisisGlobal(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);
            $ano = $request->ano;
            $global_data = DB::table('informes')->where('pais', $data->id)->where('year', $ano)->where('seccion', "global-analisis")->get();

            return json_encode($global_data);
        }

        // return view('user');
    }
    public function filtroValoracionMarca(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);
            if(isset($request->marca)){

              $current_marca = $request->marca;
    
            }
    
            $valor_total_marca = DB::table('valoracion_marca')->where('pais', $data->id)->where('name', $current_marca)->where('seccion', "grafico-1")->where('name', "VALOR TOTAL MARCA")->first();
            $valor_marca_pais = DB::table('valoracion_marca')->where('pais', $data->id)->where('name', $current_marca)->where('seccion', "grafico-1")->where('name', "VALOR MARCA PAIS")->first();
    
            $labels = array();
            $dataset = array();
            $grafico_data = DB::table('valoracion_marca')->where('pais', $data->id)->where('seccion', "grafico-1")->orderBy("ano", "asc")->get()->unique('name');
            $grafico_data_labels = DB::table('valoracion_marca')->where('pais', $data->id)->where('seccion', "grafico-1")->orderBy("ano", "asc")->get()->unique('ano');
            $grafico_data_grafico = DB::table('valoracion_marca')->where('pais', $data->id)->where('seccion', "grafico-1")->where('name', $current_marca)->orderBy("ano", "asc")->get();
    
            $grafico_data_2 = DB::table('valoracion_marca')->where('pais', $data->id)->where('seccion', "grafico-1")->where('name', $current_marca)->orderBy("ano", "asc")->get();
    
    
            $dataset["valor_total_marca"] = array();
            $dataset["valor_marca_pais"] = array();
    
            // if(count($grafico_data) > 0){
    
            //     foreach($grafico_data as $value){
    
            //         $dataset[$value->name] = array();
    
            //     }
    
    
            // }
    
    
            if(count($grafico_data_labels) > 0){
    
                foreach($grafico_data_labels as $value){
    
    
                        $format_data = $value->ano;
                        array_push($labels, $format_data);
    
                }
    
    
            }
    
            if(count($grafico_data_grafico) > 0){
    
    
                        foreach($grafico_data_grafico as $valor){
    
                            
                            array_push($dataset["valor_total_marca"], $valor->valor_total);
                            array_push($dataset["valor_marca_pais"], $valor->valor_marca_pais);
    
                        }
    
    
    
            }

            $resultData['valor_total_marca'] = number_format($grafico_data_grafico[0]->valor_total ?? 0,"0",",",".");
            $resultData['valor_marca_pais'] = number_format($grafico_data_grafico[0]->valor_marca_pais ?? 0,"0",",",".");
            $resultData['marca_selected'] = $current_marca;
    
            $resultData['colores'] = [];

            for ($i = 0; $i < 100; $i++) {
                $resultData['colores'][] = self::generateRandomHexColor($resultData['colores']);
            }
            //$resultData['colores'] = array("#35495e", "#84cc16", "#facc15","#dc2727", "#fa09e2", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#000000" );
            $resultData['grafico_data'] = $grafico_data;
            $resultData['grafico_data_grafico'] = $grafico_data_grafico;
            $resultData['grafico_labels'] = $labels;
            $resultData['grafico_dataset'] = $dataset;

            return json_encode($resultData);
        }

        // return view('user');
    }

    public function filtroRedesSociales(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);


            if($request->tipo == 1){
                $current_year = date("Y");
                if(isset($request->ano)){
        
                    $current_year = $request->ano;
        
                }
                $query = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year)->where('seccion', "rrss-1")->get();
                return json_encode($query);


            }else if($request->tipo == 2){




        $current_year = date("Y");
        $current_marca = "";
        $current_marca_1 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-2")->orderBy("ano", "asc")->get()->unique('marca');
        if(count($current_marca_1)>0){

            $current_marca = $current_marca_1[0]->marca;
        }

        if(isset($request->marca)){


            $current_marca = $request->marca;

        }

        $current_year1 = "";
        $current_data_1 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-2")->orderBy("ano", "asc")->get()->unique('ano');
        if(count($current_data_1)>0){

            $current_year1 = $current_data_1[0]->ano;
        }

        $year_data_seccion1 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year1)->where('marca', $current_marca)->where('seccion', "rrss-2")->get()->unique('ano');
        $sentimiento_data_seccion1 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year1)->where('marca', $current_marca)->where('seccion', "rrss-2")->get()->unique('name');
        $marcas_data_seccion1 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year1)->where('seccion', "rrss-2")->get()->unique('marca');
        $labels_data_seccion1 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year1)->where('marca', $current_marca)->where('seccion', "rrss-2")->get()->unique('periodo');
        $data_seccion1 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year1)->where('marca', $current_marca)->where('seccion', "rrss-2")->get();

        $array_labels = array();
        $array_data_seccion1 = array();

        if(count($sentimiento_data_seccion1) > 0){

            foreach($sentimiento_data_seccion1 as $valor){

                $array_data_seccion1[$valor->name] = array();

            }



        }

        if(count($labels_data_seccion1) > 0){

            foreach($labels_data_seccion1 as $valor){

                
                array_push($array_labels, $valor->periodo);

                if(count($sentimiento_data_seccion1) > 0){

                    foreach($sentimiento_data_seccion1 as $valor2){

                        $query = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year)->where("name", $valor2->name)->where('marca', $current_marca)->where("periodo", $valor->periodo)->where('seccion', "rrss-2")->get();

                        if(count($query) > 0){

                            array_push($array_data_seccion1[$valor2->name], $query[0]->valor);
                        }else{

                            array_push($array_data_seccion1[$valor2->name], 0);
                        }

        
                       
        
                    }
        
        
        
                }




            }




        }

        $resultData['anos_seccion1'] = $year_data_seccion1;
        $resultData['marca_seccion1'] = $marcas_data_seccion1;
        $resultData['labels_seccion1'] = $array_labels;
        $resultData['sentimiento_data_seccion1'] = $sentimiento_data_seccion1;
        $resultData['dataset_seccion1'] = $array_data_seccion1;
        $resultData['current_marca1'] = $current_marca;
        $resultData['colores'] = [];

        for ($i = 0; $i < 100; $i++) {
            $resultData['colores'][] = self::generateRandomHexColor($resultData['colores']);
        }
        //$resultData['colores'] = array("#35495e", "#84cc16", "#facc15","#dc2727", "#fa09e2", "#ff3f00", "#0015ff", "#00ffeb", "#ffc600", "#000000" );

        return json_encode($resultData);

            }else if($request->tipo == 3){

                $current_marca2= "";
                $current_marca_2 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-3")->orderBy("ano", "asc")->get()->unique('marca');
                if(count($current_marca_2)>0){
        
                    $current_marca2 = $current_marca_2[0]->marca;
                }
        
                if(isset($request->marca)){


                    $current_marca2 = $request->marca;
        
                }
        
                $current_year2 = "";
                $current_data_2 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-3")->orderBy("ano", "asc")->get()->unique('ano');
                if(count($current_data_2)>0){
        
                    $current_year2 = $current_data_2[0]->ano;
                }
        
           
        
                $year_data_seccion2 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-3")->get()->unique('ano');
                $sentimiento_data_seccion2 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year2)->where('marca', $current_marca2)->where('seccion', "rrss-3")->get()->unique('name');
                $marcas_data_seccion2 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-3")->get()->unique('marca');
                $labels_data_seccion2 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year2)->where('marca', $current_marca2)->where('seccion', "rrss-3")->get()->unique('periodo');
                $data_seccion2 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year2)->where('marca', $current_marca2)->where('seccion', "rrss-3")->get();
        
                $array_labels2 = array();
                $array_data_seccion2 = array();
        
                if(count($sentimiento_data_seccion2) > 0){
        
                    foreach($sentimiento_data_seccion2 as $valor){
        
                        $array_data_seccion2[$valor->name] = array();
        
                    }
        
        
        
                }
        
                if(count($labels_data_seccion2) > 0){
        
                    foreach($labels_data_seccion2 as $valor){
        
                        
                        array_push($array_labels2, $valor->periodo);
        
                        if(count($sentimiento_data_seccion2) > 0){
        
                            foreach($sentimiento_data_seccion2 as $valor2){
        
                                $query = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year2)->where("name", $valor2->name)->where('marca', $current_marca2)->where("periodo", $valor->periodo)->where('seccion', "rrss-3")->get();
        
                                if(count($query) > 0){
        
                                    array_push($array_data_seccion2[$valor2->name], $query[0]->valor*100);
                                }else{
        
                                    array_push($array_data_seccion2[$valor2->name], 0);
                                }
        
                
                               
                
                            }
                
                
                
                        }
        
        
        
        
                    }
        
        
        
        
                }


                $resultData['anos_seccion2'] = $year_data_seccion2;
                $resultData['marca_seccion2'] = $marcas_data_seccion2;
                $resultData['year_data_seccion2'] = $year_data_seccion2;
                $resultData['labels_seccion2'] = $array_labels2;
                $resultData['sentimiento_data_seccion2'] = $sentimiento_data_seccion2;
                $resultData['dataset_seccion2'] = $array_data_seccion2;
                $resultData['current_marca2'] = $current_marca2;
                $resultData['current_year2'] = $current_year2;

                return json_encode($resultData);

            }else if($request->tipo == 4){


         $current_year = date("Y");
         $current_marca3 = "";
        $current_marca_3 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-4")->orderBy("ano", "asc")->get()->unique('marca');
        if(count($current_marca_3)>0){

            $current_marca3 = $current_marca_3[0]->marca;
        }

        if(isset($request->marca)){


            $current_marca3 = $request->marca;

        }

        $current_data_1 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-4")->orderBy("ano", "asc")->get()->unique('ano');
        if(count($current_data_1)>0){

            $current_year = $current_data_1[0]->ano;
        }

        $labels_grafico_3 = array();
        $dataset_grafico_3 = array();
        $dataset2_grafico_3 = array();
        $grafico3_data = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "rrss-4")->where('marca', $current_marca3)->get()->unique('marca');
        $grafico3_data_labels = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "rrss-4")->where('marca', $current_marca3)->get()->unique('periodo');
        $grafico3_data_grafico = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "rrss-4")->where('marca', $current_marca3)->get();
        $marcas_data_seccion3 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year)->where('seccion', "rrss-4")->get()->unique('marca');


        if(count($grafico3_data) > 0){

            foreach($grafico3_data as $value){

                $dataset_grafico_3[$value->marca] = array();

            }


        }


        if(count($grafico3_data_labels) > 0){

            foreach($grafico3_data_labels as $value){
                   
                    array_push($labels_grafico_3, $value->periodo);

            }


        }

        if(count($grafico3_data_grafico) > 0){


                    foreach($grafico3_data_grafico as $valor){

                        
                        array_push($dataset_grafico_3[$valor->marca], $valor->valor);

                    }



        }


        $resultData['grafico3_data'] = $grafico3_data;
        $resultData['grafico3_data_grafico'] = $grafico3_data_grafico;
        $resultData['grafico3_labels'] = $labels_grafico_3;
        $resultData['grafico3_dataset'] = $dataset_grafico_3;
        $resultData['marca_seccion3'] = $marcas_data_seccion3;
        $resultData['current_marca3'] = $current_marca3;

                return json_encode($resultData);

            }else if($request->tipo == 5){


                $current_year = date("Y");
                
                $current_marca4 = "";
                $current_marca_4 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-5")->orderBy("ano", "asc")->get()->unique('marca');
                if(count($current_marca_4)>0){
        
                    $current_marca4 = $current_marca_4[0]->marca;
                }
        
                if(isset($request->marca)){
        
        
                    $current_marca4 = $request->marca;
        
                }

                $current_data_1 = DB::table('rrss_data')->where('pais', $data->id)->where('seccion', "rrss-5")->orderBy("ano", "asc")->get()->unique('ano');
                if(count($current_data_1)>0){
        
                    $current_year = $current_data_1[0]->ano;
                }
        
                $labels_grafico_4 = array();
                $dataset_grafico_4 = array();
                $dataset2_grafico_4 = array();
                $grafico4_data = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "rrss-5")->where('marca', $current_marca4)->get()->unique('marca');
                $grafico4_data_labels = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "rrss-5")->where('marca', $current_marca4)->get()->unique('periodo');
                $grafico4_data_grafico = DB::table('rrss_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "rrss-5")->where('marca', $current_marca4)->get();
                $marcas_data_seccion4 = DB::table('rrss_data')->where('pais', $data->id)->where("ano", $current_year)->where('seccion', "rrss-5")->get()->unique('marca');
        
        
                if(count($grafico4_data) > 0){
        
                    foreach($grafico4_data as $value){
        
                        $dataset_grafico_4[$value->marca] = array();
        
                    }
        
        
                }
        
        
                if(count($grafico4_data_labels) > 0){
        
                    foreach($grafico4_data_labels as $value){
                           
                            array_push($labels_grafico_4, $value->periodo);
        
                    }
        
        
                }
        
                if(count($grafico4_data_grafico) > 0){
        
        
                            foreach($grafico4_data_grafico as $valor){
        
                                
                                array_push($dataset_grafico_4[$valor->marca], $valor->valor);
        
                            }
        
        
        
                }

       
       
                $resultData['grafico4_data'] = $grafico4_data;
                $resultData['grafico4_data_grafico'] = $grafico4_data_grafico;
                $resultData['grafico4_labels'] = $labels_grafico_4;
                $resultData['grafico4_dataset'] = $dataset_grafico_4;
                $resultData['marca_seccion4'] = $marcas_data_seccion4;
                $resultData['current_marca4'] = $current_marca4;
       
                       return json_encode($resultData);
       
                   }
        
        

           
        }

        // return view('user');
    }
    public function filtroClientes(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);


            $current_year = date("Y");
            $current_canal = "";
    
            $data_categorias = DB::table('clientes_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "clientes")->get();
    
    
         
    
                $current_year = $request->ano ?? "";
                $current_canal = $request->categoria ?? "";
    
                if($request->ano != "" && $request->categoria == ""){
    
                    $data_categorias = DB::table('clientes_data')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "clientes")->get();
    
    
    
                }elseif($request->ano == "" && $request->categoria != ""){
    
    
                    $data_categorias = DB::table('clientes_data')->where('pais', $data->id)->where('canal', $current_canal)->where('seccion', "clientes")->get();
    
    
                }elseif($request->ano != "" && $request->categoria != ""){
    
                    $data_categorias = DB::table('clientes_data')->where('pais', $data->id)->where('canal', $current_canal)->where('ano', $current_year)->where('seccion', "clientes")->get();
    
    
    
                }
    
    
    
       


         
            return json_encode($data_categorias);
        }

        // return view('user');
    }
    public function filtroSegmentaciones(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);

            if($request->tipo == 1){
                $current_year = date("Y");
                $current_canal = "";
        
                $data_clientes = DB::table('segmentaciones')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "segmentaciones-1")->where('tipo', "CLIENTES")->get();



              
        
                    $current_year_1 = $request->ano ?? "";
                    $current_categoria_1 = $request->categoria ?? "";
        
                    if($request->ano != "" && $request->categoria == ""){
        
                        $data_clientes = DB::table('segmentaciones')->where('pais', $data->id)->where('ano', $current_year_1)->where('seccion', "segmentaciones-1")->where('tipo', "CLIENTES")->get();
        
        
        
                    }elseif($request->ano == "" && $request->categoria != ""){
        
        
                        $data_clientes = DB::table('segmentaciones')->where('pais', $data->id)->where('categoria', $current_categoria_1)->where('seccion', "segmentaciones-1")->where('tipo', "CLIENTES")->get();
        
        
                    }elseif($request->ano != "" && $request->categoria != ""){
        
                        $data_clientes = DB::table('segmentaciones')->where('pais', $data->id)->where('categoria', $current_categoria_1)->where('ano', $current_year_1)->where('tipo', "CLIENTES")->where('seccion', "segmentaciones-1")->get();
        
        
        
                    }
        
        
        
              
                
    
                return json_encode($data_clientes);
             
                


            }else if($request->tipo == 2){

                $current_year_2 = date("Y");
                $current_categoria_2 = "";
                $data_consumidores = DB::table('segmentaciones')->where('pais', $data->id)->where('ano', $current_year_2)->where('seccion', "segmentaciones-1")->where('tipo', "CONSUMIDORES")->get();
        
        
        
              
        
                    $current_year_2 = $request->ano ?? "";
                    $current_categoria_2 = $request->categoria ?? "";
        
                    if($request->ano != "" && $request->categoria == ""){
        
                        $data_consumidores = DB::table('segmentaciones')->where('pais', $data->id)->where('ano', $current_year_2)->where('seccion', "segmentaciones-1")->where('tipo', "CONSUMIDORES")->get();
        
        
        
                    }elseif($request->ano == "" && $request->categoria != ""){
        
        
                        $data_consumidores = DB::table('segmentaciones')->where('pais', $data->id)->where('categoria', $current_categoria_2)->where('seccion', "segmentaciones-2")->where('tipo', "CONSUMIDORES")->get();
        
        
                    }elseif($request->ano != "" && $request->categoria != ""){
        
                        $data_consumidores = DB::table('segmentaciones')->where('pais', $data->id)->where('categoria', $current_categoria_2)->where('ano', $current_year_2)->where('tipo', "CONSUMIDORES")->where('seccion', "segmentaciones-1")->get();
        
        
        
                    }
        
        
        
              
                return json_encode($data_consumidores);
            }


            
        }

        // return view('user');
    }
    public function filtroAnalisisOtros(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);
            $ano = $request->ano;
            $query = DB::table('otros_data')->where('pais', $data->id)->where('ano', $ano)->where('seccion', "ANALISIS")->get();


         
            return json_encode($query);
        }

        // return view('user');
    }
    public function filtroInformacionSindicada(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);
            

            $current_year = date("Y");
            $current_proveedor = "";
    
            $data_informacion = DB::table('informacion_sindicada')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "informacion-sindicada")->get();
    
           
           

                $current_year = $request->ano ?? "";
                $current_proveedor = $request->proveedor ?? "";
    
                if($request->ano != "" && $request->proveedor == ""){
    
      
                    $data_informacion = DB::table('informacion_sindicada')->where('pais', $data->id)->where('ano', $current_year)->where('seccion', "informacion-sindicada")->get();
    
    
    
                }elseif($request->ano == "" && $request->proveedor != ""){
    
    
                    $data_informacion = DB::table('informacion_sindicada')->where('pais', $data->id)->where('proveedor', $current_proveedor)->where('seccion', "informacion-sindicada")->get();
    
    
                }elseif($request->ano != "" && $request->proveedor != ""){
    
                    $data_informacion = DB::table('informacion_sindicada')->where('pais', $data->id)->where('ano', $current_year)->where('proveedor', $current_proveedor)->where('seccion', "informacion-sindicada")->get();
    
    
    
                }
    
    
    
     


         
            return json_encode($data_informacion);
        }

        // return view('user');
    }
    public function filtroVentas(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);

            if($request->tipo == 1){


        $first_periodo_3 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-3")->get()->unique('periodo');

        $current_periodo_3 =  "";
        if(count($first_periodo_3) > 0){

            $current_periodo_3 =  $first_periodo_3[0]->periodo;
        }

        if(isset($request->periodo)){

            if($request->periodo == ""){

                $current_periodo_3 =  $first_periodo_3[0]->periodo;


            }else{

                $current_periodo_3 = $request->periodo;

            }

            
        }

        $ventas_3 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-3")->where('periodo', $current_periodo_3)->get();

        if(count($ventas_3) > 0){
            $cnt = 0;
            foreach($ventas_3 as $value){

                $ventas_3[$cnt]->volumen = number_format($value->volumen,"2",",",".");
                $ventas_3[$cnt]->valor = number_format($value->valor,"2",",",".");
                $ventas_3[$cnt]->valor_2 = number_format($value->valor_2,"2",",",".");

                $cnt++;
            }
        }

        return json_encode($ventas_3);

            }else if($request->tipo == 2){

                $current_ano_2 =  "";

                $first_ano_2 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('ano');
        
                if(count($first_ano_2) > 0){
        
                    $current_ano_2 =  $first_ano_2[0]->ano;
        
                }
               
            
        
                if(isset($request->ano)){
        
                    if($request->ano == ""){
        
                        $current_ano_2 =  $first_ano_2[0]->ano;
        
                        
                    }else{
        
                        $current_ano_2 = $request->ano;
        
                    }
        
                    
                }
                
                $ventas_2 = DB::table('ventas')
                ->leftJoin('regiones', DB::raw('lower(ventas.region)'), '=', DB::raw('lower(regiones.name)'))
                ->select('ventas.*', 'regiones.color')
                ->where('ventas.pais', $data->id)
                ->where('ventas.ano', $current_ano_2)
                ->where('ventas.seccion', "ventas-2")
                //->limit(100)
                ->get();
                $ventas_2_ano = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('ano');
        
                if($pais_selected == "Colombia"){
                    $ventas_2_regiones = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('ano', $current_ano_2)->get()->unique('region');
                }else{
                    $ventas_2_regiones = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('ano', $current_ano_2)->get()->unique('departamento');
                }
        
                
                $ventas_2_categoria = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->get()->unique('categoria');
        
        
        
        
                $ventas_2_regiones_data = array();
                if(count($ventas_2_regiones) > 0){
        
                    foreach($ventas_2_regiones as $valor){
        
                        if($pais_selected == "Colombia"){
        
                            if($valor->region != "N/A"){
                                $ventas_2_categoria_ = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('ano', $current_ano_2)->where('region', $valor->region)->get()->unique('categoria');
        
                                $name_region = strtolower($valor->region);
                                $ventas_2_regiones_data[$valor->region]["color"] = "#FFFFFF";
        
                                $query_regiones = DB::table('regiones')->where(DB::raw('lower(name)'), '=', $name_region)->get();
        
                                if(count($query_regiones) > 0){
        
                                    $ventas_2_regiones_data[$valor->region]["color"] = $query_regiones[0]->color;
        
                                }
        
                                
        
                                if(count($ventas_2_categoria_) > 0){
            
                                    foreach($ventas_2_categoria_ as $valor2){
            
            
                                        $ventas_2_categoria_data = DB::table('ventas')
                                        ->select(['marca', DB::raw("SUM(ventas_netas_toneladas) as toneladas_netas"), DB::raw("SUM(ventas_netas) as total_ventas")])
                                        ->where('pais', $data->id)->where('seccion', "ventas-2")->where('region', $valor->region)->where('ano', $current_ano_2)->where("categoria", $valor2->categoria)
                                        ->groupBy('marca')
                                        ->get();
            
                                        if(count($ventas_2_categoria_data)> 0){
            
                                            $ventas_2_regiones_data[$valor->region][$valor2->categoria] = $ventas_2_categoria_data;
            
            
            
                                        }
            
            
            
            
                                    }
            
            
            
            
                                }
        
                            }
        
                            
        
        
        
        
                        }else{
        
                            if($valor->departamento != "N/A"){
        
                                $ventas_2_categoria_ = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('ano', $current_ano_2)->where('departamento', $valor->departamento)->get()->unique('categoria');
        
                                $name_region = strtolower($valor->departamento);
                                $ventas_2_regiones_data[$valor->departamento]["color"] = "#FFFFFF";
        
                                $query_regiones = DB::table('regiones')->where(DB::raw('lower(name)'), '=', $name_region)->get();
        
                                if(count($query_regiones) > 0){
        
                                    $ventas_2_regiones_data[$valor->departamento]["color"] = $query_regiones[0]->color;
        
                                }
        
                                if(count($ventas_2_categoria_) > 0){
            
                                    foreach($ventas_2_categoria_ as $valor2){
            
            
                                        $ventas_2_categoria_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-2")->where('ano', $current_ano_2)->where('departamento', $valor->departamento)->where("categoria", $valor2->categoria)->get();
            
                                        if(count($ventas_2_categoria_data)> 0){
            
                                            $ventas_2_regiones_data[$valor->departamento][$valor2->categoria] = $ventas_2_categoria_data;
            
            
            
                                        }
            
            
            
            
                                    }
            
            
            
            
                                }
        
                            }
        
        
        
        
        
        
        
                        }
        
        
        
                    }
        
                }



                $resultData['ventas_2'] = $ventas_2;
                $resultData['ventas_2_ano'] = $ventas_2_ano;
                $resultData['ventas_2_ano_selected'] = $current_ano_2;
                $resultData['ventas_2_regiones_data'] = $ventas_2_regiones_data;
                return json_encode($resultData);

            }else if($request->tipo == 3){

                $first_periodo = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('periodo');

                $labels = array();
                $current_periodo =  "";
                $current_categoria =  "";
        
                if(count($first_periodo) > 0){
                    $current_periodo =  $first_periodo[0]->periodo;
                    $current_categoria =  $first_periodo[0]->categoria;
        
                }
        
               
                
        
        
              
        
                    $current_periodo = $request->periodo ?? "";
                    $current_categoria = $request->marca ?? "";
        
                    if($current_periodo == ""){
        
                        $current_periodo =  $first_periodo[0]->periodo;
        
                    }
        
                    if($current_categoria == ""){
        
                        $current_categoria =  $first_periodo[0]->categoria;
                    }
        
        
        
        
       
        
        
                $ventas_4_anos = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('ano');
                $ventas_4_mes = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('mes');
                $ventas_4_periodo = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('periodo');
                $ventas_4_categoria = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->get()->unique('categoria');
                
                $ventas_4_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->where('periodo',$current_periodo)->where('categoria',$current_categoria)->get()->unique('ano');
                $ventas_4_data_labels = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->where('periodo',$current_periodo)->where('categoria',$current_categoria)->get()->unique('mes');
                $ventas_4_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-4")->where('periodo',$current_periodo)->where('categoria',$current_categoria)->get();
        
        
                if(count($ventas_4_data) > 0){
        
                    foreach($ventas_4_data as $value){
        
                        $dataset[$value->ano] = array();
        
                    }
        
        
                }
        
        
                if(count($ventas_4_data_labels) > 0){
        
                    foreach($ventas_4_data_labels as $value){
        
        
                            //$format_data = date("M-Y", strtotime($value->ano));
                            array_push($labels, $value->mes);
        
                    }
        
        
                }
        
                if(count($ventas_4_data_grafico) > 0){
        
        
                            foreach($ventas_4_data_grafico as $valor){
        
                                
                                array_push($dataset[$valor->ano], number_format($valor->valor,"0",",","."));
        
                            }
        
        
        
                }

                $resultData['ventas_4_data'] = $ventas_4_data;
                $resultData['ventas_4_data_grafico'] = $ventas_4_data_grafico;
                $resultData['ventas_4_labels'] = $labels;
                $resultData['ventas_4_dataset'] = $dataset;
                $resultData['ventas_4_periodo'] = $ventas_4_periodo;
                $resultData['ventas_4_categoria'] = $ventas_4_categoria;
                $resultData['ventas_4_periodo_selected'] = $current_periodo;
                $resultData['ventas_4_categoria_selected'] = $current_categoria;

                return json_encode($resultData);
            }else if($request->tipo == 4){

                $labels2 = array();
                $dataset2 = array();
        
                $first_periodo_5 = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('periodo');
        
        
               
                $current_periodo_5 =  $first_periodo_5[0]->periodo ?? "";
                $current_categoria_5 =  $first_periodo_5[0]->categoria ?? "";
        
        
                if(isset($request->periodo) && isset($request->marca)){
        
                    $current_periodo_5 = $request->periodo;
                    $current_categoria_5 = $request->marca;
        
                    if($current_periodo_5 == ""){
        
                        $current_periodo_5 =  $first_periodo_5[0]->periodo ?? "";
        
                    }
        
                    if($current_categoria_5 == ""){
        
                        $current_categoria_5 =  $first_periodo_5[0]->categoria ?? "";
                    }
        
        
        
        
        
                }
        
        
                $ventas_5_anos = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('ano');
                $ventas_5_mes = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('mes');
                $ventas_5_periodo = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('periodo');
                $ventas_5_categoria = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->get()->unique('categoria');
        
                
                $ventas_5_data = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->where('periodo',$current_periodo_5)->where('categoria',$current_categoria_5)->get()->unique('ano');
                $ventas_5_data_labels = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->where('periodo',$current_periodo_5)->where('categoria',$current_categoria_5)->get()->unique('mes');
                $ventas_5_data_grafico = DB::table('ventas')->where('pais', $data->id)->where('seccion', "ventas-5")->where('periodo',$current_periodo_5)->where('categoria',$current_categoria_5)->get();
        
        
                if(count($ventas_5_data) > 0){
        
                    foreach($ventas_5_data as $value){
        
                        $dataset2[$value->ano] = array();
        
                    }
        
        
                }
        
        
                if(count($ventas_5_data_labels) > 0){
        
                    foreach($ventas_5_data_labels as $value){
        
        
                            //$format_data = date("M-Y", strtotime($value->ano));
                            array_push($labels2, $value->mes);
        
                    }
        
        
                }
        
                if(count($ventas_5_data_grafico) > 0){
        
        
                            foreach($ventas_5_data_grafico as $valor){
        
                                
                                array_push($dataset2[$valor->ano], number_format($valor->valor,"0",",","."));
        
                            }
        
        
        
                }


            }


            $resultData['ventas_5_data'] = $ventas_5_data;
            $resultData['ventas_5_data_grafico'] = $ventas_5_data_grafico;
            $resultData['ventas_5_labels'] = $labels2;
            $resultData['ventas_5_dataset'] = $dataset2;
            $resultData['ventas_5_periodo'] = $ventas_5_periodo;
            $resultData['ventas_5_categoria'] = $ventas_5_categoria;
            $resultData['ventas_5_periodo_selected'] = $current_periodo_5;
            $resultData['ventas_5_categoria_selected'] = $current_categoria_5;
            return json_encode($resultData);

        }

        // return view('user');
    }
    public function filtroVentasOtros(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);
            $ano = $request->ano;
            $query = DB::table('otros_data')->where('pais', $data->id)->where('ano', $ano)->where('seccion', "VENTAS")->get();


         
            return json_encode($query);
        }

        // return view('user');
    }

    public function filtroCategoria1(Request $request){


        $current_date = date("Y-m-d");
        $current_year_categoria = date("Y");
        $current_categoria = "";
        $pais_selected = session('pais_selected');
        $data = $this->Paise->data_by_name($pais_selected);
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));

        $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano",">=", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")->get();


        $current_year = $request->ano ?? "";
        $current_marca = $request->marca ?? "";
        $current_categoria = $request->categoria ?? "";
        $pais_id = $data->id;

        if($current_year != "" && $current_marca != "" && $current_categoria != ""){


            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('nombre_tipo_2', $current_marca)->where('seccion', "investigacion-adhoc")->where("ano", $current_year )->where('tipo', "categoria")->get();


        }else if($current_year == "" && $current_marca != "" && $current_categoria != ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('nombre_tipo_2', $current_marca)->where('seccion', "investigacion-adhoc")->where("ano",">=", $min_year )->where('tipo', "categoria")->get();


        }else if($current_year == "" && $current_marca == "" && $current_categoria != ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('seccion', "investigacion-adhoc")->where("ano",">=", $min_year )->where('tipo', "categoria")->get();

        }else if($current_year == "" && $current_marca == "" && $current_categoria == ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano",">=", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")
            ->orWhere(function ($query) use ($min_year, $pais_id) {
                $query->where('tipo_2', 'marca')
                      ->where('ano', '>=', $min_year)
                      ->where('pais', $pais_id);
            })
            ->get();

        }else if($current_year != "" && $current_marca == "" && $current_categoria != ""){

            

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('seccion', "investigacion-adhoc")->where("ano", $current_year )->where('tipo', "categoria")->get();


        }else if($current_year != "" && $current_marca == "" && $current_categoria == ""){

           
            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where("ano", $current_year)->where('tipo', "categoria")->get();


        }
        else if($current_year == "" && $current_marca != "" && $current_categoria == ""){

           
            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where("ano",">=", $min_year )->where('tipo', "categoria")->where('nombre_tipo_2', $current_marca)->get();


        }else if($current_year != "" && $current_marca != "" && $current_categoria == ""){

           
            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where("ano", $current_year )->where('tipo', "categoria")->where('nombre_tipo_2', $current_marca)->get();


        }

        return json_encode($data_categorias);


    }

    public function filtroCategoria2(Request $request){


        $current_date = date("Y-m-d");
        $current_year_categoria = date("Y");
        $current_categoria = "";
        $pais_selected = session('pais_selected');
        $data = $this->Paise->data_by_name($pais_selected);
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));

        $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano","<", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")->get();


        $current_year = $request->ano ?? "";
        $current_marca = $request->marca ?? "";
        $current_categoria = $request->categoria ?? "";
        $pais_id = $data->id;

        if($current_year != "" && $current_marca != "" && $current_categoria != ""){


            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('nombre_tipo_2', $current_marca)->where('seccion', "investigacion-adhoc")->where("ano", $current_year )->where('tipo', "categoria")->get();


        }else if($current_year == "" && $current_marca != "" && $current_categoria != ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('nombre_tipo_2', $current_marca)->where('seccion', "investigacion-adhoc")->where("ano","<", $min_year )->where('tipo', "categoria")->get();


        }else if($current_year == "" && $current_marca == "" && $current_categoria != ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('seccion', "investigacion-adhoc")->where("ano","<", $min_year )->where('tipo', "categoria")->get();

        }else if($current_year == "" && $current_marca == "" && $current_categoria == ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano","<", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "categoria")            
            ->orWhere(function ($query) use ($min_year, $pais_id ) {
                $query->where('tipo_2', 'marca')
                      ->where('ano', '>=', $min_year)
                      ->where('pais', $pais_id);
            })
            ->get();

        }else if($current_year != "" && $current_marca == "" && $current_categoria != ""){

            

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_categoria)->where('seccion', "investigacion-adhoc")->where("ano", $current_year )->where('tipo', "categoria")->get();


        }else if($current_year != "" && $current_marca == "" && $current_categoria == ""){

           
            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where("ano", $current_year)->where('tipo', "categoria")->get();


        }
        else if($current_year == "" && $current_marca != "" && $current_categoria == ""){

           
            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where("ano","<", $min_year )->where('tipo', "categoria")->where('nombre_tipo_2', $current_marca)->get();


        }else if($current_year != "" && $current_marca != "" && $current_categoria == ""){

           
            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('seccion', "investigacion-adhoc")->where("ano", $current_year )->where('tipo', "categoria")->where('nombre_tipo_2', $current_marca)->get();


        }

        return json_encode($data_categorias);


    }

    public function filtroCLiente1(Request $request){


        $current_date = date("Y-m-d");
        $current_year_categoria = date("Y");
        $current_categoria = "";
        $pais_selected = session('pais_selected');
        $data = $this->Paise->data_by_name($pais_selected);
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        $pais_id = $data->id;

        $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano",">=", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")
        ->orWhere(function ($query) use ($min_year, $pais_id) {
            $query->where('tipo', 'canal')
                  ->where('ano', '>=', $min_year)
                  ->where('pais', $pais_id);
        })
        ->get();


        $current_year = $request->ano ?? "";
        $current_cliente = $request->cliente ?? "";
        $current_canal = $request->canal ?? "";

        if($current_year != "" && $current_cliente != "" && $current_canal == ""){


            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_cliente)->where('seccion', "investigacion-adhoc")->where("ano", $current_year )->where('tipo', "cliente")->get();


        }else if($current_year != "" && $current_cliente == "" && $current_canal != ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_canal)->where('seccion', "investigacion-adhoc")->where("ano", $current_year )->where('tipo', "canal")->get();


        }else if($current_year == "" && $current_cliente == "" && $current_canal == ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano",">=", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")
            ->orWhere(function ($query) use ($min_year, $pais_id) {
                $query->where('tipo', 'canal')
                      ->where('ano', '>=', $min_year)
                      ->where('pais', $pais_id);
            })
            ->get();

        }else if($current_year != "" && $current_cliente == "" && $current_canal == ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano", $current_year )->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")
            ->orWhere(function ($query) use ($min_year, $pais_id) {
                $query->where('tipo', 'canal')
                      ->where('ano', '>=', $min_year)
                      ->where('pais', $pais_id);
            })
            ->get();

        }else if($current_year == "" && $current_cliente != "" && $current_canal == ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano",">=", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->where('nombre_tipo', $current_cliente)->get();

        }else if($current_year == "" && $current_cliente == "" && $current_canal != ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano",">=", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->where('nombre_tipo', $current_canal)->get();

        }

        return json_encode($data_categorias);


    }
    public function filtroCLiente2(Request $request){


        $current_date = date("Y-m-d");
        $current_year_categoria = date("Y");
        $current_categoria = "";
        $pais_selected = session('pais_selected');
        $data = $this->Paise->data_by_name($pais_selected);
        $min_year = date('Y', strtotime($current_date. ' - 2 years'));
        $pais_id = $data->id;

        $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano","<", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")
        ->orWhere(function ($query) use ($min_year, $pais_id) {
            $query->where('tipo', 'canal')
                  ->where('ano', '>=', $min_year)
                  ->where('pais', $pais_id);
        })
        ->get();


        $current_year = $request->ano ?? "";
        $current_cliente = $request->cliente ?? "";
        $current_canal = $request->canal ?? "";

        if($current_year != "" && $current_cliente != "" && $current_canal == ""){


            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_cliente)->where('seccion', "investigacion-adhoc")->where("ano", $current_year )->where('tipo', "cliente")->get();


        }else if($current_year != "" && $current_cliente == "" && $current_canal != ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where('nombre_tipo', $current_canal)->where('seccion', "investigacion-adhoc")->where("ano", $current_year )->where('tipo', "canal")->get();


        }else if($current_year == "" && $current_cliente == "" && $current_canal == ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano","<", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")
            ->orWhere(function ($query) use ($min_year, $pais_id) {
                $query->where('tipo', 'canal')
                      ->where('ano', '>=', $min_year)
                      ->where('pais', $pais_id);
            })
            ->get();

        }else if($current_year != "" && $current_cliente == "" && $current_canal == ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano", $current_year )->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")
            ->orWhere(function ($query) use ($min_year, $pais_id) {
                $query->where('tipo', 'canal')
                      ->where('ano', '>=', $min_year)
                      ->where('pais', $pais_id);
            })
            ->get();

        }else if($current_year == "" && $current_cliente != "" && $current_canal == ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano","<", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->where('nombre_tipo', $current_cliente)->get();

        }else if($current_year == "" && $current_cliente == "" && $current_canal != ""){

            $data_categorias = DB::table('informes_ad_hoc')->where('pais', $data->id)->where("ano","<", $min_year )->where('seccion', "investigacion-adhoc")->where('tipo', "cliente")->where('nombre_tipo', $current_canal)->get();

        }

        return json_encode($data_categorias);


    }
    public function filtroVentasHpm(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);



            $ventas_exportaciones_filtro = DB::table('ventas_exportaciones')->where('pais_origen', $data->id)->get()->unique('periodo');
            $current_periodo_hpm =  "";
            if(count($ventas_exportaciones_filtro) > 0){
    
                $current_periodo_hpm =  $ventas_exportaciones_filtro[0]->periodo;
            }


            if(isset($request->periodo)){

                if($request->periodo == ""){
    
                    $current_periodo_hpm =  $ventas_exportaciones_filtro[0]->periodo;
    
    
                }else{
    
                    $current_periodo_hpm = $request->periodo;
    
                }
    
                
            }
    
            $ventas_exportaciones = DB::table('ventas_exportaciones')->where('pais_origen', $data->id)->where('periodo', $current_periodo_hpm)->get();
            $ventas_exportaciones_total = DB::table('ventas_exportaciones')
            ->where('pais_origen', $data->id)
            ->where('periodo', $current_periodo_hpm)
            ->get()
            ->sum("kilos");
    
    
    
            $resultData['current_periodo_hpm'] = $current_periodo_hpm;
            $resultData['ventas_exportaciones'] = $ventas_exportaciones;
            $resultData['ventas_exportaciones_filtro'] = $ventas_exportaciones_filtro;
            $resultData['ventas_exportaciones_total'] = $ventas_exportaciones_total;

        
            return json_encode($resultData);

        }

        // return view('user');
    }

    public function filtroPrecioMaiz(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);
            $current_year = date("Y");

            if(isset($request->ano)){

                if($request->ano == ""){
    
                    $current_year =  $current_year;
    
    
                }else{
    
                    $current_year = $request->ano;
    
                }
    
                
            }



            $labels_historico_maiz = array();
            $dataset_historico_maiz['ap_ve'] = array();
            $dataset_historico_maiz['ap_col'] = array();
            $dataset_historico_maiz['igc'] = array();
            
    
            $historico_maiz_data_labels = DB::table('precios')->where('ano', $current_year)->where('seccion', "precio-compra-maiz")->get()->unique('mes');
            $historico_maiz_data_grafico = DB::table('precios')->where('ano', $current_year)->where('seccion', "precio-compra-maiz")->get();
    
    
    
    
    
            if(count($historico_maiz_data_labels) > 0){
    
                foreach($historico_maiz_data_labels as $value){
    
    
                        $format_data = date("M-Y", strtotime($value->ano));
                        array_push($labels_historico_maiz, $value->mes);
    
                }
    
    
            }
    
            if(count($historico_maiz_data_grafico) > 0){
    
    
                        foreach($historico_maiz_data_grafico as $valor){
                            
    
                            
                            array_push($dataset_historico_maiz['ap_ve'], $valor->ap_ve);
                            array_push($dataset_historico_maiz['ap_col'], $valor->ap_col);
                            array_push($dataset_historico_maiz['igc'], $valor->igc);
    
                        }
    
    
    
            }
    

            $resultData['dataset_precio_maiz'] = $dataset_historico_maiz;
            $resultData['labels_historico_maiz'] = $labels_historico_maiz;
        
            return json_encode($resultData);

        }

        // return view('user');
    }
    public function filtroComodities(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);
            $current_year = date("Y");

            if(isset($request->ano)){

                if($request->ano == ""){
    
                    $current_year =  $current_year;
    
    
                }else{
    
                    $current_year = $request->ano;
    
                }
    
                
            }


            $labels_comodities = array();
            $dataset_comodities['maiz_amarillo'] = array();
            $dataset_comodities['maiz_blanco'] = array();
            $dataset_comodities['trigo'] = array();
            $dataset_comodities['petroleo'] = array();
            
    
            $comodities_data_labels = DB::table('precios')->where('ano',$current_year)->where('seccion', "comodities")->get()->unique('mes');
            $comodities_anos = DB::table('precios')->where('seccion', "comodities")->get()->unique('ano');
            $comodities_data_grafico = DB::table('precios')->where('ano', $current_year)->where('seccion', "comodities")->get();
    
    
    
    
    
            if(count($comodities_data_labels) > 0){
    
                foreach($comodities_data_labels as $value){
    
    
                        $format_data = date("M-Y", strtotime($value->ano));
                        array_push($labels_comodities, $value->mes);
    
                }
    
    
            }
    
            if(count($comodities_data_grafico) > 0){
    
    
                        foreach($comodities_data_grafico as $valor){
                            
    
                            
                            array_push($dataset_comodities['maiz_amarillo'], $valor->maiz_amarillo);
                            array_push($dataset_comodities['maiz_blanco'], $valor->maiz_blanco);
                            array_push($dataset_comodities['trigo'], $valor->trigo);
                            array_push($dataset_comodities['petroleo'], $valor->petroleo);
    
                        }
    
    
    
            }
    

            $resultData['dataset_comodities'] = $dataset_comodities;
            $resultData['labels_comodities'] = $labels_comodities;
        
            return json_encode($resultData);

        }

        // return view('user');
    }

    public function graficoKpi(Request $request)
    {
        if ($request->ajax()) {
            $pais_selected = session('pais_selected');
            $data = $this->Paise->data_by_name($pais_selected);
            $item = $request->item;



            $labels_comodities = array();
            $dataset_comodities['item'] = array();
            $resultData['item_name'] = "";
            

            if($item == "canasta_alimentaria_normativa" || $item == "tasa_de_cambio" || $item == "diaspora_venezolana"){

                $comodities_data_labels = DB::table('data')->where('item',$item)->where('pais', $data->id)->orderByRaw("STR_TO_DATE(fecha_actualizacion, '%d/%m/%y')")->get()->unique('fecha_actualizacion');
                $comodities_data_grafico = DB::table('data')->where('item', $item)->where('pais', $data->id)->orderByRaw("STR_TO_DATE(fecha_actualizacion, '%d/%m/%y')")->get();


            }else if($item == "DEFICIT FISCAL" || $item == "RESERVAS INTERNACIONALES" || $item == "TASA DE INTERES"){

                $comodities_data_labels = DB::table('ventas')->where('name',$item)->where('pais', $data->id)->get()->unique('ano');
                $comodities_data_grafico = DB::table('ventas')->where('name', $item)->where('pais', $data->id)->get();
                
            }else{

                $comodities_data_labels = DB::table('data')->where('item',$item)->where('pais', $data->id)->get()->unique('ano');
                $comodities_data_grafico = DB::table('data')->where('item', $item)->where('pais', $data->id)->get();


            }
    

    
    
    
    
    
            if(count($comodities_data_labels) > 0){
    
                foreach($comodities_data_labels as $value){
    
    
                    if($item == "canasta_alimentaria_normativa" || $item == "tasa_de_cambio" || $item == "diaspora_venezolana"){
                        setlocale(LC_TIME, 'es_ES.UTF-8');
                        $formats = ['d/m/y', 'Y-m-d H:i:s'];
                        $date = false;
                        
                        foreach ($formats as $format) {
                            $date = DateTime::createFromFormat($format, $value->fecha_actualizacion);
                            if ($date !== false) {
                                break;
                            }
                        }
                        
                        if ($date !== false) {
                            $monthName = strftime('%B', $date->getTimestamp());
                            $year = strftime('%Y', $date->getTimestamp());
                            array_push($labels_comodities, $monthName."-".$year);
                        } else {
                            // Handle the case where the date couldn't be parsed with any of the formats
                        }

                    }else{

                        array_push($labels_comodities, $value->ano);

                    }
                    
    
                }
    
    
            }
    
            if(count($comodities_data_grafico) > 0){
    
    
                        foreach($comodities_data_grafico as $valor){
                            
    
                            if($item == "inflacion_(usd_mm)" || $item == "tasa_de_desempleo"){

                                array_push($dataset_comodities['item'], $valor->dato*100);

                            }else if($item == "DEFICIT FISCAL" || $item == "RESERVAS INTERNACIONALES" || $item == "TASA DE INTERES"){


                                if($item == "TASA DE INTERES"){

                                    array_push($dataset_comodities['item'], $value->valor*100);



                                }else{

                                    array_push($dataset_comodities['item'], $value->valor);
                                }
                                
        
                            }else{

                                array_push($dataset_comodities['item'], $valor->dato);
                            }
                            

                            $resultData['item_name'] = $valor->name;
    
                        }
    
    
    
            }
    

            $resultData['dataset_comodities'] = $dataset_comodities;
            $resultData['labels_comodities'] = $labels_comodities;
            
        
            return json_encode($resultData);

        }

        // return view('user');
    }
}
