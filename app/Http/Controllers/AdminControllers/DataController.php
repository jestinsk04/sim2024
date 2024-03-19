<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Paise;
use App\Imports\ImportHelper;
use App\Imports\ImportHelperSheet;
use App\Imports\ImportExcelToArray;
use DataTables;
use Excel;
use DB;
use Auth;
class DataController extends Controller
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
    public function import_form()
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
        $resultData['breadcrumb2'] = "Importar Data";
        return view('admin/data/import', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            // 'layout' => 'side-menu'
        ])->with('data', $resultData);
    }

    public function import_sheet(Request $request)
    {


        $result = new ImportExcelToArray();
        $temp = Excel::import($result,$request->file('select_file'));

        $kpi_data_1 = $result->sheetData['KPI-PAIS'];
        $kpi_data_2 = $result->sheetData['PRECIOS-HPM'];
        $kpi_data_3 = $result->sheetData['PLAN-OPERATIVO-H'];
        $kpi_data_4 = $result->sheetData['VENTAS-EXPORTACIONES'];
        $demografico_data_1 = $result->sheetData['KPI-DEMO'];
        $demografico_data_2 = $result->sheetData['DEMO-PAREA'];
        $demografico_data_3 = $result->sheetData['DEMO-HPERSONAS'];
        $demografico_data_4 = $result->sheetData['DEMO-NSE'];
        $demografico_data_5 = $result->sheetData['DEMO-PIRAMIDE'];
        $demografico_data_6 = $result->sheetData['DEMO-GASTOHOGAR'];
        $demografico_data_7 = $result->sheetData['DEMO-POBLACIONM'];
        $global_analisis = $result->sheetData['GLOBAL-ANALISIS'];
        $global_investigacion = $result->sheetData['GLOBAL-INVESTIGACION'];
        $investigacion_adhoc = $result->sheetData['ADHOC-ESTUDIOS'];
        $comunidad_online_1 = $result->sheetData['CL-CALENDARIO'];
        $comunidad_online_2 = $result->sheetData['CL-ENGAGEMENT'];
        $comunidad_online_3 = $result->sheetData['CL-RESEARCH'];
        $panel_hogares = $result->sheetData['PANELHOGARES'];
        $valoracion_mercado_1 = $result->sheetData['VALORACION-INFORMES'];
        $valoracion_mercado_2 = $result->sheetData['VALORACION-MERCADOT'];
        $valoracion_mercado_3 = $result->sheetData['VALORACION-MERCADOP'];
        //$valoracion_marca = $result->sheetData['ANALISIS-VALORACION-MARCA'];
        $clientes = $result->sheetData['CLIENTES-INFORMES'];
        $segmentaciones_1 = $result->sheetData['SEGM-INFORMES'];
        $segmentaciones_2 = $result->sheetData['SEGM-DATOS'];
        $informacion_sindicada = $result->sheetData['INFO-SINDICADA'];
        $tendencias = $result->sheetData['TENDENCIAS'];
        $ventas_1 = $result->sheetData['KPI-VENTA'];
        $ventas_2 = $result->sheetData['VENTA-REGIONES'];
        $ventas_3 = $result->sheetData['VENTA-TOTALPAIS'];
        $ventas_4 = $result->sheetData['VENTA-HISTORICOV'];
        $ventas_5 = $result->sheetData['VENTAS-MERCADO-LOCAL-5'];
        //$ventas_6 = $result->sheetData['VENTAS-MERCADO-LOCAL-6'];
        $ventas_7 = $result->sheetData['VENTAS-MARGENES'];
        $otros = $result->sheetData['VENTA-OTROS'];
        $rrss_1 = $result->sheetData['RRSS-INFORMES'];
        $rrss_2 = $result->sheetData['RRSS-SENTIMIENTOS'];
        $rrss_3 = $result->sheetData['RRSS-SOM'];
        $rrss_4 = $result->sheetData['RRSS-MENCIONES'];
        $rrss_5 = $result->sheetData['RRSS-INTERACCIONES'];
        $plan_operativo_a = $result->sheetData['PLAN-OPERATIVO-A'];
        $precios_comodities = $result->sheetData['PRECIOS-COMMODITIES'];
        $precios_compra_maiz = $result->sheetData['PRECIOS-COMPRA-MAIZ'];
        $precios_informes = $result->sheetData['PRECIOS-INFORMES'];
        $continuos_informes = $result->sheetData['CONTINUOS'];



        if(count($kpi_data_1) > 0){

            foreach($kpi_data_1 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->item = $value["item"];
                        $object->dato = $value["datos"];
                        $object->ano = $value["ano"];
                        $object->fecha_actualizacion = $value["fecha_actualizacion"];
                        $object->pais = $value["pais"];
                        $object->frecuencia = $value["frecuencia_de_actualizacion"];
                        $object->fuente = $value["fuente"];
                        $object->url = $value["url"];
                        $object->seccion = "kpi-1";
                        
                        if(!empty($object)){



        $codigo_item = trim(strtolower(str_replace(" ","_", $object->item)));
        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            if($object->dato != NULL){

                $find_data = DB::table('data')->where('pais', $find_country[0]->id)->where('item', $codigo_item)->where('fecha_actualizacion', $object->fecha_actualizacion)->where('seccion', $object->seccion)->get();

                if(count($find_data) > 0){
    
    
         
                    $data_update = array(
                        'name'=>$object->item,
                        'dato'=>$object->dato,
                        'fecha_actualizacion'=>$object->fecha_actualizacion,
                        'frecuencia'=>$object->frecuencia,
                        'fuente'=>$object->fuente,
                        'url'=>$object->url,
                        'ano'=>$object->ano,
                        'seccion'=>$object->seccion,
                        'updated_at' => date('Y-m-d H:i:s')
                  
                    );
                  
                  
                      DB::table('data')->where('id', '=', $find_data[0]->id)->update($data_update);
    
    
    
    
                }else{
    
    
                    $id = DB::table('data')->insertGetId([
                        'name'=>$object->item,
                        'dato'=>$object->dato,
                        'fecha_actualizacion'=>$object->fecha_actualizacion,
                        'frecuencia'=>$object->frecuencia,
                        'fuente'=>$object->fuente,
                        'url'=>$object->url,
                        'ano'=>$object->ano,
                        'item'=>$codigo_item,
                        'pais'=>$find_country[0]->id,
                        'pais_name'=>$find_country[0]->name,
                        'seccion'=>$object->seccion,
                         'created_at' => date('Y-m-d H:i:s'),
                 
                       ]);
    
    
                       $notificacion = DB::table('notificaciones')->insertGetId([
                        'title'=>"Nueva Data",
                        'description'=>"Se agrego nueva data en KPI",
                        'pais'=>$find_country[0]->id,
                        'pais_name'=>$find_country[0]->name,
                        'created_at' => date('Y-m-d H:i:s'),
                 
                       ]);
    
    
    
    
    
    
    
                }


            }










        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($kpi_data_2) > 0){

            foreach($kpi_data_2 as $key => $value){

                $object = new \stdClass();
                $object->item = $value["marca"];
                $object->dato = $value["precio"];
                $object->ano = str_replace("/", "-", $value["periodo"]);
                $object->pais = $value["pais"];
                $object->seccion = "kpi-2";

                if(!empty($object)){



                    $codigo_item = trim(strtolower(str_replace(" ","_", $object->item)));
                    $pais_lower = trim(strtolower($object->pais));
            
                    $find_country = DB::table('paises')
                    ->where(DB::raw('lower(name)'), $pais_lower)
                    ->get();
            
                    if(count($find_country) > 0){
            
                        $find_data = DB::table('data')->where('pais', $find_country[0]->id)->where('item', $codigo_item)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();
            
                        if(count($find_data) > 0){
            
            
                 
                            $data_update = array(
                                'name'=>$object->item,
                                'dato'=>$object->dato,
                                'ano'=>$object->ano,
                                'seccion'=>$object->seccion,
                                'updated_at' => date('Y-m-d H:i:s')
                          
                            );
                          
                          
                              DB::table('data')->where('id', '=', $find_data[0]->id)->update($data_update);
            
            
            
            
                        }else{
            
            
                            $id = DB::table('data')->insertGetId([
                                'name'=>$object->item,
                                'dato'=>$object->dato,
                                'ano'=>$object->ano,
                                'item'=>$codigo_item,
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'seccion'=>$object->seccion,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);

                               $notificacion = DB::table('notificaciones')->insertGetId([
                                'title'=>"Nueva Data",
                                'description'=>"Se agrego nueva data en KPI",
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);
            
            
            
            
            
            
            
                        }
            
            
            
            
            
            
            
            
                    }
            
            
                                    }


            }





        }

        if(count($kpi_data_3) > 0){

            foreach($kpi_data_3 as $key => $value){

                $object = new \stdClass();
                $object->item = $value["nombre"];
                $object->dato = $value["real_ton"];
                $object->dato_2 = $value["plan_ton"];
                $object->dato_3 = $value["cumplimiento"];
                $object->pais = $value["pais"];
                $object->ano = $value["ano"];
                $object->status = $value["status"];
                $object->seccion = "kpi-3";

                if(!empty($object)){



                    $codigo_item = trim(strtolower(str_replace(" ","_", $object->item)));
                    $pais_lower = trim(strtolower($object->pais));
            
                    $find_country = DB::table('paises')
                    ->where(DB::raw('lower(name)'), $pais_lower)
                    ->get();
            
                    if(count($find_country) > 0){
            
                        $find_data = DB::table('data')->where('pais', $find_country[0]->id)->where('item', $codigo_item)->where('ano', $object->ano)->where('status', $object->status)->where('seccion', $object->seccion)->get();
            
                        if(count($find_data) > 0){
            
            
                 
                            $data_update = array(
                                'name'=>$object->item,
                                'dato'=>$object->dato,
                                'dato_2'=>$object->dato_2,
                                'dato_3'=>$object->dato_3,
                                'seccion'=>$object->seccion,
                                'ano'=>$object->ano,
                                'status'=>$object->status,
                                'updated_at' => date('Y-m-d H:i:s')
                          
                            );
                          
                          
                              DB::table('data')->where('id', '=', $find_data[0]->id)->update($data_update);
            
            
            
            
                        }else{
            
            
                            $id = DB::table('data')->insertGetId([
                                'name'=>$object->item,
                                'dato'=>$object->dato,
                                'dato_2'=>$object->dato_2,
                                'dato_3'=>$object->dato_3,
                                'item'=>$codigo_item,
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'seccion'=>$object->seccion,
                                'ano'=>$object->ano,
                                'status'=>$object->status,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);


                               $notificacion = DB::table('notificaciones')->insertGetId([
                                'title'=>"Nueva Data",
                                'description'=>"Se agrego nueva data en KPI",
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);
            
            
            
            
            
            
            
                        }
            
            
            
            
            
            
            
            
                    }
            
            
                                    }


            }





        }

        if(count($kpi_data_4) > 0){

            foreach($kpi_data_4 as $key => $value){

                $object = new \stdClass();
                $object->pais = $value["pais_origen"];
                $object->responsable = $value["responsable"];
                $object->codigo_material = $value["cod_material"];
                $object->descripcion = $value["descripcion"];
                $object->categoria = $value["categoria"];
                $object->region = $value["region"];
                $object->subregion = $value["sub_region"];
                $object->pais_destino = ucfirst(strtolower($value["pais_destino"]));
                $object->kilos = $value["kilos"];
                $object->periodo = $value["periodo"];
                
                $object->seccion = "kpi-4";

                if(!empty($object)){


                    $pais_lower = trim(strtolower($object->pais));
            
                    $find_country = DB::table('paises')
                    ->where(DB::raw('lower(name)'), $pais_lower)
                    ->get();
            
                    if(count($find_country) > 0){
            
                        $find_data = DB::table('ventas_exportaciones')->where('pais_origen', $find_country[0]->id)->where('pais_destino', $object->pais_destino)->where('periodo', $object->periodo)->get();
            
                        if(count($find_data) > 0){
            
            
                 
                            $data_update = array(
                                'pais_origen'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'responsable'=>$object->responsable,
                                'codigo_material'=>$object->codigo_material,
                                'descripcion'=>$object->descripcion,
                                'categoria'=>$object->categoria,
                                'region'=>$object->region,
                                'sub_region'=>$object->subregion,
                                'pais_destino'=>$object->pais_destino,
                                'kilos'=>$object->kilos,
                                'periodo'=>$object->periodo,
                                'updated_at' => date('Y-m-d H:i:s')
                          
                            );
                          
                          
                              DB::table('ventas_exportaciones')->where('id', '=', $find_data[0]->id)->update($data_update);
            
            
            
            
                        }else{
            
            
                            $id = DB::table('ventas_exportaciones')->insertGetId([
                                'pais_origen'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'responsable'=>$object->responsable,
                                'codigo_material'=>$object->codigo_material,
                                'descripcion'=>$object->descripcion,
                                'categoria'=>$object->categoria,
                                'region'=>$object->region,
                                'sub_region'=>$object->subregion,
                                'pais_destino'=>$object->pais_destino,
                                'kilos'=>$object->kilos,
                                'periodo'=>$object->periodo,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);

            $notificacion = DB::table('notificaciones')->insertGetId([
                'title'=>"Nueva Data",
                'description'=>"Se agrego nueva data en KPI",
                'pais'=>$find_country[0]->id,
                'pais_name'=>$find_country[0]->name,
                'created_at' => date('Y-m-d H:i:s'),
         
               ]);
            
            
            
            
            
            
            
                        }
            
            
            
            
            
            
            
            
                    }
            
            
                                    }


            }





        }

        if(count($demografico_data_1) > 0){

            foreach($demografico_data_1 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->item = $value["item"];
                        $object->dato = $value["datos"];
                        $object->ano = $value["ano"];
                        $object->fecha_actualizacion = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value["fecha_actualizacion"]);
                        $object->pais = $value["pais"];
                        $object->frecuencia = $value["frecuencia_de_actualizacion"];
                        $object->fuente = $value["fuente"];
                        $object->url = "";
                        $object->seccion = "demografico-1";
                        
                        if(!empty($object)){



        $codigo_item = trim(strtolower(str_replace(" ","_", $object->item)));
        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('data')->where('pais', $find_country[0]->id)->where('item', $codigo_item)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'fecha_actualizacion'=>$object->fecha_actualizacion,
                    'frecuencia'=>$object->frecuencia,
                    'fuente'=>$object->fuente,
                    'url'=>$object->url,
                    'ano'=>$object->ano,
                    'seccion'=>$object->seccion,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('data')->insertGetId([
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'fecha_actualizacion'=>$object->fecha_actualizacion,
                    'frecuencia'=>$object->frecuencia,
                    'fuente'=>$object->fuente,
                    'url'=>$object->url,
                    'ano'=>$object->ano,
                    'item'=>$codigo_item,
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'seccion'=>$object->seccion,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Demografico",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($demografico_data_2) > 0){

            foreach($demografico_data_2 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->item = $value["zona"];
                        $object->dato = $value["datos_absoluto"];
                        $object->dato_2 = $value["dato_porcentaje"];
                        $object->ano = $value["ano"];
                        $object->pais = $value["pais"];
                        $object->seccion = "demografico-2";
                        
                        if(!empty($object)){



        $codigo_item = trim(strtolower(str_replace(" ","_", $object->item)));
        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('data')->where('pais', $find_country[0]->id)->where('item', $codigo_item)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'dato_2'=>$object->dato_2,
                    'ano'=>$object->ano,
                    'seccion'=>$object->seccion,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('data')->insertGetId([
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'dato_2'=>$object->dato_2,
                    'ano'=>$object->ano,
                    'item'=>$codigo_item,
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'seccion'=>$object->seccion,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Demografico",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($demografico_data_3) > 0){

            foreach($demografico_data_3 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->item = $value["item"];
                        $object->dato = $value["dato_absoluto"];
                        $object->dato_2 = $value["dato_porcentaje"];
                        $object->ano = $value["ano"];
                        $object->pais = $value["pais"];
                        $object->seccion = "demografico-3";
                        
                        if(!empty($object)){



        $codigo_item = trim(strtolower(str_replace(" ","_", $object->item)));
        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('data')->where('pais', $find_country[0]->id)->where('item', $codigo_item)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'dato_2'=>$object->dato_2,
                    'ano'=>$object->ano,
                    'seccion'=>$object->seccion,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('data')->insertGetId([
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'dato_2'=>$object->dato_2,
                    'ano'=>$object->ano,
                    'item'=>$codigo_item,
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'seccion'=>$object->seccion,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Demografico",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($demografico_data_4) > 0){

            foreach($demografico_data_4 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->item = $value["item"];
                        $object->dato = $value["dato_absoluto"];
                        $object->dato_2 = $value["dato_porcentaje"];
                        $object->ano = $value["ano"];
                        $object->pais = $value["pais"];
                        $object->seccion = "demografico-4";
                        
                        if(!empty($object)){



        $codigo_item = trim(strtolower(str_replace(" ","_", $object->item)));
        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('data')->where('pais', $find_country[0]->id)->where('item', $codigo_item)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'dato_2'=>$object->dato_2,
                    'ano'=>$object->ano,
                    'seccion'=>$object->seccion,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('data')->insertGetId([
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'dato_2'=>$object->dato_2,
                    'ano'=>$object->ano,
                    'item'=>$codigo_item,
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'seccion'=>$object->seccion,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Demografico",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($demografico_data_5) > 0){

            foreach($demografico_data_5 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->item = $value["item"];
                        $object->dato = $value["dato_absoluto_hombres"];
                        $object->dato_2 = $value["dato_porcentaje_hombres"];
                        $object->dato_3 = $value["dato_absoluto_mujeres"];
                        $object->dato_4 = $value["dato_porcentaje_mujeres"];
                        $object->ano = $value["ano"];
                        $object->pais = $value["pais"];
                        $object->seccion = "demografico-5";
                        
                        if(!empty($object)){



        $codigo_item = trim(strtolower(str_replace(" ","_", $object->item)));
        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('data')->where('pais', $find_country[0]->id)->where('item', $codigo_item)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'dato_2'=>$object->dato_2,
                    'dato_3'=>$object->dato_3,
                    'dato_4'=>$object->dato_4,
                    'ano'=>$object->ano,
                    'seccion'=>$object->seccion,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('data')->insertGetId([
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'dato_2'=>$object->dato_2,
                    'dato_3'=>$object->dato_3,
                    'dato_4'=>$object->dato_4,
                    'ano'=>$object->ano,
                    'item'=>$codigo_item,
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'seccion'=>$object->seccion,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Demografico",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($demografico_data_6) > 0){

            foreach($demografico_data_6 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->item = $value["item"];
                        $object->dato = $value["dato"];
                        $object->ano = $value["ano"];
                        $object->pais = $value["pais"];
                        $object->seccion = "demografico-6";
                        
                        if(!empty($object)){



        $codigo_item = trim(strtolower(str_replace(" ","_", $object->item)));
        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('data')->where('pais', $find_country[0]->id)->where('item', $codigo_item)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'ano'=>$object->ano,
                    'seccion'=>$object->seccion,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('data')->insertGetId([
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'ano'=>$object->ano,
                    'item'=>$codigo_item,
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'seccion'=>$object->seccion,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Demografico",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($demografico_data_7) > 0){

            foreach($demografico_data_7 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->item = $value["item"];
                        $object->dato = $value["dato_porcentaje"];
                        $object->dato_2 = $value["dato_absoluto"];
                        $object->ano = $value["ano"];
                        $object->pais = $value["pais"];
                        $object->seccion = "demografico-7";
                        
                        if(!empty($object)){



        $codigo_item = trim(strtolower(str_replace(" ","_", $object->item)));
        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('data')->where('pais', $find_country[0]->id)->where('item', $codigo_item)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'dato_2'=>$object->dato_2,
                    'ano'=>$object->ano,
                    'seccion'=>$object->seccion,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('data')->insertGetId([
                    'name'=>$object->item,
                    'dato'=>$object->dato,
                    'dato_2'=>$object->dato_2,
                    'ano'=>$object->ano,
                    'item'=>$codigo_item,
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'seccion'=>$object->seccion,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Demografico",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($global_analisis) > 0){

            foreach($global_analisis as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->descripcion = trim($value["descripcion"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = "global-analisis";
                        $object->ano = $value["fecha"];;
                        $object->fecha_formato = date("Y-m-d", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('informes')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('year', $object->ano)->where('seccion', $object->seccion)->get();

         
            $archivo_name = $object->url;
 




            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'date'=>$object->fecha_formato,
                    'year'=>$object->ano,
                    'description'=>$object->descripcion,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('informes')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('informes')->insertGetId([
                    'name'=>$object->nombre,
                    'date'=>$object->fecha_formato,
                    'year'=>$object->ano,
                    'description'=>$object->descripcion,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Analisis Global",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($global_investigacion) > 0){

            foreach($global_investigacion as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->descripcion = trim($value["descripcion"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = "global-investigacion";
                        $object->ano = $value["fecha"];
                        $object->fecha_formato = date("Y-m-d", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('informes')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('year', $object->ano)->where('seccion', $object->seccion)->get();

            $archivo_name = $object->url;

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'date'=>$object->fecha_formato,
                    'year'=>$object->ano,
                    'description'=>$object->descripcion,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('informes')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('informes')->insertGetId([
                    'name'=>$object->nombre,
                    'date'=>$object->fecha_formato,
                    'year'=>$object->ano,
                    'description'=>$object->descripcion,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Investigacion Global",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($investigacion_adhoc) > 0){

            foreach($investigacion_adhoc as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->ano = $value["ano"];
                        $object->tipo = trim(strtolower($value["tipo"]));
                        $object->nombre_tipo = trim($value["nombre_tipo"]);
                        $object->tipo_2 = trim(strtolower($value["tipo_2"]));
                        $object->nombre_tipo_2 = trim($value["nombre_tipo_2"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = "investigacion-adhoc";

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('informes_ad_hoc')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            $archivo_name = "";

            if($object->url != ""){

                $archivo_name = $object->url;

            }
            

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'tipo'=>$object->tipo,
                    'nombre_tipo'=>$object->nombre_tipo,
                    'ano'=>$object->ano,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                    'tipo_2'=>$object->tipo_2,
                    'nombre_tipo_2'=>$object->nombre_tipo_2,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('informes_ad_hoc')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('informes_ad_hoc')->insertGetId([
                    'name'=>$object->nombre,
                    'tipo'=>$object->tipo,
                    'nombre_tipo'=>$object->nombre_tipo,
                    'ano'=>$object->ano,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                    'tipo_2'=>$object->tipo_2,
                    'nombre_tipo_2'=>$object->nombre_tipo_2,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Informes Ad Hoc",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($comunidad_online_1) > 0){

            foreach($comunidad_online_1 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->ano = trim($value["ano"]);
                        $object->quarter = $value["q"];
                        $object->tema = trim($value["tema"]);
                        $object->nombre = trim($value["nombre"]);
                        $object->objetivo = trim($value["objetivo"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = "conexion-latina-1";

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('comunidad_online')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            $archivo_name = $object->url;

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'ano'=>$object->ano,
                    'tema'=>$object->tema,
                    'objetivo'=>$object->objetivo,
                    'quarter'=>$object->quarter,
                    'tema'=>$object->tema,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('comunidad_online')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('comunidad_online')->insertGetId([
                    'name'=>$object->nombre,
                    'ano'=>$object->ano,
                    'tema'=>$object->tema,
                    'objetivo'=>$object->objetivo,
                    'quarter'=>$object->quarter,
                    'tema'=>$object->tema,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Comunidad Online",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }



        if(count($comunidad_online_2) > 0){

            foreach($comunidad_online_2 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->quarter = trim($value["q"]);
                        $object->tema = $value["tema"];
                        $object->nombre = trim($value["nombre"]);
                        $object->objetivo = trim($value["objetivo"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->ano = $value["ano"];
                        $object->seccion = "conexion-latina-2";

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('comunidad_online')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            $archivo_name = $object->url;

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'ano'=>$object->ano,
                    'tema'=>$object->tema,
                    'objetivo'=>$object->objetivo,
                    'quarter'=>$object->quarter,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('comunidad_online')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('comunidad_online')->insertGetId([
                    'name'=>$object->nombre,
                    'ano'=>$object->ano,
                    'tema'=>$object->tema,
                    'objetivo'=>$object->objetivo,
                    'quarter'=>$object->quarter,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Comunidad Online",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($comunidad_online_3) > 0){

            foreach($comunidad_online_3 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->objetivo = $value["orientacion"];
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->ano = $value["ano"];
                        $object->seccion = "conexion-latina-3";

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('comunidad_online')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            $archivo_name = $object->url;

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'ano'=>$object->ano,
                    'objetivo'=>$object->objetivo,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('comunidad_online')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('comunidad_online')->insertGetId([
                    'name'=>$object->nombre,
                    'ano'=>$object->ano,
                    'objetivo'=>$object->objetivo,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'archivo'=>$archivo_name,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Comunidad Online",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($panel_hogares) > 0){

            foreach($panel_hogares as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->tipo = trim($value["tipo"]);
                        $object->nombre_tipo = trim($value["nombre_tipo"]);
                        $object->periodo = trim($value["periodo"]);
                        $object->frecuencia = trim($value["frecuencia"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = trim(strtolower(str_replace(" ","_",$value["tipo"])));
                        $object->ano = date("Y", $object->fecha);
                        $object->fecha_formato = date("Y-m-d", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('panel_hogares')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();



            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'tipo'=>$object->tipo,
                    'nombre_tipo'=>$object->nombre_tipo,
                    'periodo'=>$object->periodo,
                    'frecuencia'=>$object->frecuencia,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('panel_hogares')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('panel_hogares')->insertGetId([
                    'name'=>$object->nombre,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'tipo'=>$object->tipo,
                    'nombre_tipo'=>$object->nombre_tipo,
                    'periodo'=>$object->periodo,
                    'frecuencia'=>$object->frecuencia,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Panel Hogares",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($valoracion_mercado_1) > 0){

            foreach($valoracion_mercado_1 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->categoria = trim($value["categoria"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = "informes";
                        $object->ano = date("Y", $object->fecha);
                        $object->fecha_formato = date("Y-m-d", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('valoracion_mercado')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();



            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'categoria'=>$object->categoria,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('valoracion_mercado')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('valoracion_mercado')->insertGetId([
                    'name'=>$object->nombre,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'categoria'=>$object->categoria,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Valoracion de mercado",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($valoracion_mercado_2) > 0){

            foreach($valoracion_mercado_2 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["canasta"]);
                        $object->ano = trim($value["ano"]);
                        $object->dato = trim($value["porcentaje"]);
                        $object->pais = $value["pais"];
                        $object->seccion = "grafico-1";

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('valoracion_mercado')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();



            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'ano'=>$object->ano,
                    'dato'=>$object->dato,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('valoracion_mercado')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('valoracion_mercado')->insertGetId([
                    'name'=>$object->nombre,
                    'ano'=>$object->ano,
                    'dato'=>$object->dato,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Valoracion de mercado",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($valoracion_mercado_3) > 0){

            foreach($valoracion_mercado_3 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["categoria"]);
                        $object->ano = trim($value["ano"]);
                        $object->dato = trim($value["mmbs"]);
                        $object->porcentaje = trim($value["porcentaje"]);
                        $object->pais = $value["pais"];
                        $object->seccion = "grafico-2";

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('valoracion_mercado')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();



            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'ano'=>$object->ano,
                    'dato'=>$object->dato,
                    'porcentaje'=>$object->porcentaje,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('valoracion_mercado')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('valoracion_mercado')->insertGetId([
                    'name'=>$object->nombre,
                    'ano'=>$object->ano,
                    'dato'=>$object->dato,
                    'porcentaje'=>$object->porcentaje,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Valoracion de mercado",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);





            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        // if(count($valoracion_marca) > 0){

        //     foreach($valoracion_marca as $key => $value){

        //         // dd($value);

        //                 $object = new \stdClass();
        //                 $object->nombre = trim($value["marca"]);
        //                 $object->ano = trim($value["periodo"]);
        //                 $object->valor_total = trim($value["valor_total"]);
        //                 $object->valor_marca_pais = trim($value["valor_marca_pais"]);
        //                 $object->pais = $value["pais"];
        //                 $object->seccion = "grafico-1";

        //                 //dd($object->fecha);
                        
        //                 if(!empty($object)){


        // $pais_lower = trim(strtolower($object->pais));

        // $find_country = DB::table('paises')
        // ->where(DB::raw('lower(name)'), $pais_lower)
        // ->get();

        // if(count($find_country) > 0){

        //     $find_data = DB::table('valoracion_marca')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();



        //     if(count($find_data) > 0){


     
        //         $data_update = array(
        //             'name'=>$object->nombre,
        //             'ano'=>$object->ano,
        //             'valor_total'=>$object->valor_total,
        //             'valor_marca_pais'=>$object->valor_marca_pais,
        //             'pais'=>$find_country[0]->id,
        //             'seccion'=>$object->seccion,
        //             'pais_name'=>$find_country[0]->name,
        //             'updated_at' => date('Y-m-d H:i:s')
              
        //         );
              
              
        //           DB::table('valoracion_marca')->where('id', '=', $find_data[0]->id)->update($data_update);




        //     }else{


        //         $id = DB::table('valoracion_marca')->insertGetId([
        //             'name'=>$object->nombre,
        //             'ano'=>$object->ano,
        //             'valor_total'=>$object->valor_total,
        //             'valor_marca_pais'=>$object->valor_marca_pais,
        //             'pais'=>$find_country[0]->id,
        //             'seccion'=>$object->seccion,
        //             'pais_name'=>$find_country[0]->name,
        //              'created_at' => date('Y-m-d H:i:s'),
             
        //            ]);


        //            $notificacion = DB::table('notificaciones')->insertGetId([
        //             'title'=>"Nueva Data",
        //             'description'=>"Se agrego nueva data en Valoracion marca",
        //             'pais'=>$find_country[0]->id,
        //             'pais_name'=>$find_country[0]->name,
        //             'created_at' => date('Y-m-d H:i:s'),
             
        //            ]);




        //     }








        // }


        //                 }


                        

        //     }
        //     // dd($result->sheetData['KPI-1']);


        // }


        if(count($clientes) > 0){

            foreach($clientes as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->canal = trim($value["canal"]);
                        $object->periodo = trim($value["periodo"]);
                        $object->descripcion = trim($value["descripcion"]);
                        $object->frecuencia = trim($value["frecuencia"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = "clientes";
                        $object->ano = date("Y", $object->fecha);
                        $object->fecha_formato = date("Y-m-d", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('clientes_data')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();


            $archivo = file_get_contents($object->url);
            $archivo_name = $object->nombre."_".$object->ano;
            $archivo_name = str_replace(" ", "_", $archivo_name);
            $archivo_name = str_replace("/", "", $archivo_name);
            $archivo_name = trim(strtolower($archivo_name)).".pdf";


            file_put_contents(public_path('storage/pdfs/'.$archivo_name), $archivo);



            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'descripcion'=>$object->descripcion,
                    'frecuencia'=>$object->frecuencia,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'canal'=>$object->canal,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('clientes_data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('clientes_data')->insertGetId([
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'descripcion'=>$object->descripcion,
                    'frecuencia'=>$object->frecuencia,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'canal'=>$object->canal,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Clientes",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);




            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($segmentaciones_1) > 0){

            foreach($segmentaciones_1 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->categoria = trim($value["categoria"]);
                        $object->periodo = trim($value["periodo"]);
                        $object->descripcion = trim($value["descripcion"]);
                        $object->frecuencia = trim($value["frecuencia"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = "segmentaciones-1";
                        $object->tipo = trim($value["tipo"]);
                        $object->ano = date("Y", $object->fecha);
                        $object->fecha_formato = date("Y-m-d", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('segmentaciones')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();


            $archivo_name = $object->url;



            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'descripcion'=>$object->descripcion,
                    'frecuencia'=>$object->frecuencia,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'categoria'=>$object->categoria,
                    'tipo'=>$object->tipo,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('segmentaciones')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('segmentaciones')->insertGetId([
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'descripcion'=>$object->descripcion,
                    'frecuencia'=>$object->frecuencia,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'categoria'=>$object->categoria,
                    'tipo'=>$object->tipo,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Segmentaciones",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($segmentaciones_2) > 0){

            foreach($segmentaciones_2 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["grupo"]);
                        $object->cantidad_clientes = trim($value["cantidad_clientes"]);
                        $object->porcentaje = trim($value["porcentaje"]);
                        $object->periodo = trim($value["periodo"]);
                        $object->pais = $value["pais"];
                        $object->seccion = "segmentaciones-2";
                        $object->tipo = trim($value["tipo"]);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('segmentaciones')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('periodo', $object->periodo)->where('seccion', $object->seccion)->get();



            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'cantidad_clientes'=>$object->cantidad_clientes,
                    'porcentaje'=>$object->porcentaje,
                    'periodo'=>$object->periodo,
                    'tipo'=>$object->tipo,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('segmentaciones')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('segmentaciones')->insertGetId([
                    'name'=>$object->nombre,
                    'cantidad_clientes'=>$object->cantidad_clientes,
                    'porcentaje'=>$object->porcentaje,
                    'periodo'=>$object->periodo,
                    'tipo'=>$object->tipo,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Segmentaciones",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($informacion_sindicada) > 0){

            foreach($informacion_sindicada as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->proveedor = trim($value["proveedor"]);
                        $object->periodo = trim($value["periodo"]);
                        $object->frecuencia = trim($value["frecuencia"]);
                        $object->descripcion = trim($value["descripcion"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = "informacion-sindicada";
                        $object->ano = date("Y", $object->fecha);
                        $object->fecha_formato = date("Y-m-d", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('informacion_sindicada')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();


            $archivo_name = $object->url;



            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'descripcion'=>$object->descripcion,
                    'frecuencia'=>$object->frecuencia,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('informacion_sindicada')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('informacion_sindicada')->insertGetId([
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'descripcion'=>$object->descripcion,
                    'frecuencia'=>$object->frecuencia,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'proveedor'=>$object->proveedor,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Informacion Sindicada",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($tendencias) > 0){

            foreach($tendencias as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->fuente = trim($value["fuente"]);
                        $object->descripcion_detallada = trim($value["descripcion_detallada"]);
                        $object->categoria = trim($value["categoria"]);
                        $object->descripcion = trim($value["descripcion"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = "tendencias";
                        $object->ano = date("Y", $object->fecha);
                        $object->fecha_formato = date("Y-m-d", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('tendencias')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            $archivo_name = $object->url;



            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,

                    'descripcion'=>$object->descripcion,
                    'descripcion_detallada'=>$object->descripcion_detallada,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'fuente'=>$object->fuente,
                    'categoria'=>$object->categoria,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('tendencias')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('tendencias')->insertGetId([
                    'name'=>$object->nombre,

                    'descripcion'=>$object->descripcion,
                    'descripcion_detallada'=>$object->descripcion_detallada,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'fuente'=>$object->fuente,
                    'categoria'=>$object->categoria,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Tendencias",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);




            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }



        if(count($ventas_1) > 0){

            foreach($ventas_1 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->valor = trim($value["valor"]);
                        $object->pais = $value["pais"];
                        $object->fuente = $value["fuente"];
                        $object->seccion = "ventas-1";
                        $object->ano = date("Y", $object->fecha);
                        $object->fecha_formato = date("Y-m-d", $object->fecha);
                        $object->fecha_actualizacion = date("d/m/Y", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('ventas')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('fecha_actualizacion', $object->fecha_actualizacion)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'valor'=>$object->valor,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'fuente'=>$object->fuente,
                    'fecha_actualizacion'=>$object->fecha_actualizacion,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('ventas')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('ventas')->insertGetId([
                    'name'=>$object->nombre,
                    'valor'=>$object->valor,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'fuente'=>$object->fuente,
                    'fecha_actualizacion'=>$object->fecha_actualizacion,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Ventas",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);




            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($ventas_2) > 0){

            foreach($ventas_2 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->ano = trim($value["ano"]);
                        $object->mes = trim($value["mes"]);
                        $object->departamento = trim($value["departamento"]);
                        $object->region = trim($value["regiones"]);
                        $object->categoria = trim($value["categoria"]);
                        $object->marca = trim($value["marca"]);
                        $object->ventas_netas_toneladas = trim($value["ventas_netas_toneladas"]);
                        $object->ventas_netas = trim($value["ventas_netas"]);
                        $object->pais = $value["pais"];
                        $object->seccion = "ventas-2";

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('ventas')->where('pais', $find_country[0]->id)->where('categoria', $object->categoria)->where('ano', $object->ano)->where('mes', $object->mes)->where('marca', $object->marca)->where('departamento', $object->departamento)->where('region', $object->region)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'ano'=>$object->ano,
                    'mes'=>$object->mes,
                    'departamento'=>$object->departamento,
                    'region'=>$object->region,
                    'categoria'=>$object->categoria,
                    'marca'=>$object->marca,
                    'ventas_netas_toneladas'=>$object->ventas_netas_toneladas,
                    'ventas_netas'=>$object->ventas_netas,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('ventas')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('ventas')->insertGetId([
                    'ano'=>$object->ano,
                    'mes'=>$object->mes,
                    'departamento'=>$object->departamento,
                    'region'=>$object->region,
                    'categoria'=>$object->categoria,
                    'marca'=>$object->marca,
                    'ventas_netas_toneladas'=>$object->ventas_netas_toneladas,
                    'ventas_netas'=>$object->ventas_netas,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Ventas",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($ventas_3) > 0){

            foreach($ventas_3 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->periodo = trim($value["periodo"]);
                        $object->ano = trim($value["ano"]);
                        $object->mes =  trim($value["mes"]);
                        $object->categoria = trim($value["categoria"]);
                        $object->volumen = trim($value["volumen"]);
                        $object->valor = $value["valor"];
                        $object->valor_2 = $value["precio"];
                        $object->pais = $value["pais"];
                        $object->seccion = "ventas-3";


                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('ventas')->where('pais', $find_country[0]->id)->where('periodo', $object->periodo)->where('ano', $object->ano)->where('mes', $object->mes)->where('categoria', $object->categoria)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'periodo'=>$object->periodo,
                    'ano'=>$object->ano,
                    'mes'=>$object->mes,
                    'categoria'=>$object->categoria,
                    'volumen'=>$object->volumen,
                    'valor'=>$object->valor,
                    'valor_2'=>$object->valor_2,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('ventas')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('ventas')->insertGetId([
                    'periodo'=>$object->periodo,
                    'ano'=>$object->ano,
                    'mes'=>$object->mes,
                    'categoria'=>$object->categoria,
                    'volumen'=>$object->volumen,
                    'valor'=>$object->valor,
                    'valor_2'=>$object->valor_2,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Ventas",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);





            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($ventas_4) > 0){

            foreach($ventas_4 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->valor = trim($value["volumen"]);
                        $object->mes = trim($value["mes"]);
                        $object->ano = trim($value["ano"]);
                        $object->pais = $value["pais"];
                        $object->categoria = $value["categoria"];
                        $object->periodo = $value["periodo"];
                        $object->seccion = "ventas-4";

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('ventas')->where('pais', $find_country[0]->id)->where('mes', $object->mes)->where('ano', $object->ano)->where('categoria', $object->categoria)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'valor'=>$object->valor,
                    'mes'=>$object->mes,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'categoria'=>$object->categoria,
                    'periodo'=>$object->periodo,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('ventas')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('ventas')->insertGetId([
                    'valor'=>$object->valor,
                    'mes'=>$object->mes,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'categoria'=>$object->categoria,
                    'periodo'=>$object->periodo,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Ventas",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);




            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($ventas_5) > 0){

            foreach($ventas_5 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->valor = trim($value["valor"]);
                        $object->mes = trim($value["mes"]);
                        $object->ano = trim($value["ano"]);
                        $object->pais = $value["pais"];
                        $object->periodo = $value["periodo"];
                        $object->categoria = $value["categoria"];
                        $object->seccion = "ventas-5";

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('ventas')->where('pais', $find_country[0]->id)->where('mes', $object->mes)->where('ano', $object->ano)->where('categoria', $object->categoria)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'valor'=>$object->valor,
                    'mes'=>$object->mes,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'categoria'=>$object->categoria,
                    'periodo'=>$object->periodo,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('ventas')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('ventas')->insertGetId([
                    'valor'=>$object->valor,
                    'mes'=>$object->mes,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'categoria'=>$object->categoria,
                    'periodo'=>$object->periodo,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Ventas",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);




            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($otros) > 0){

            foreach($otros as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->periodo = trim($value["periodo"]);
                        $object->descripcion = trim($value["descripcion"]);
                        $object->frecuencia = trim($value["frecuencia"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = $value["seccion"];
                        $object->ano = date("Y", $object->fecha);
                        $object->fecha_formato = date("Y-m-d", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('otros_data')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();


            $archivo = file_get_contents($object->url);
            $archivo_name = $object->nombre."_".$object->ano;
            $archivo_name = str_replace(" ", "_", $archivo_name);
            $archivo_name = str_replace("/", "", $archivo_name);
            $archivo_name = trim(strtolower($archivo_name)).".pdf";


            file_put_contents(public_path('storage/pdfs/'.$archivo_name), $archivo);



            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'descripcion'=>$object->descripcion,
                    'frecuencia'=>$object->frecuencia,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('otros_data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('otros_data')->insertGetId([
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'descripcion'=>$object->descripcion,
                    'frecuencia'=>$object->frecuencia,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Otros",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);




            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        // if(count($ventas_6) > 0){

        //     foreach($ventas_6 as $key => $value){

        //         // dd($value);

        //                 $object = new \stdClass();
        //                 $object->nombre = trim($value["nombre"]);
        //                 $object->valor = trim($value["real"]);
        //                 $object->valor_2 = trim($value["plan"]);
        //                 $object->porcentaje = trim($value["cumplimiento"]);
        //                 $object->mes = trim($value["mes"]);
        //                 $object->ano = trim($value["ano"]);
        //                 $object->pais = $value["pais"];
        //                 $object->seccion = "ventas-6";

        //                 //dd($object->fecha);
                        
        //                 if(!empty($object)){


        // $pais_lower = trim(strtolower($object->pais));

        // $find_country = DB::table('paises')
        // ->where(DB::raw('lower(name)'), $pais_lower)
        // ->get();

        // if(count($find_country) > 0){

        //     $find_data = DB::table('ventas')->where('pais', $find_country[0]->id)->where('mes', $object->mes)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

        //     if(count($find_data) > 0){


     
        //         $data_update = array(
        //             'name'=>$object->nombre,
        //             'valor'=>$object->valor,
        //             'valor_2'=>$object->valor_2,
        //             'porcentaje'=>$object->porcentaje,
        //             'mes'=>$object->mes,
        //             'ano'=>$object->ano,
        //             'pais'=>$find_country[0]->id,
        //             'seccion'=>$object->seccion,
        //             'pais_name'=>$find_country[0]->name,
        //             'updated_at' => date('Y-m-d H:i:s')
              
        //         );
              
              
        //           DB::table('ventas')->where('id', '=', $find_data[0]->id)->update($data_update);




        //     }else{


        //         $id = DB::table('ventas')->insertGetId([
        //             'name'=>$object->nombre,
        //             'valor'=>$object->valor,
        //             'valor_2'=>$object->valor_2,
        //             'porcentaje'=>$object->porcentaje,
        //             'mes'=>$object->mes,
        //             'ano'=>$object->ano,
        //             'pais'=>$find_country[0]->id,
        //             'seccion'=>$object->seccion,
        //             'pais_name'=>$find_country[0]->name,
        //              'created_at' => date('Y-m-d H:i:s'),
             
        //            ]);


        //            $notificacion = DB::table('notificaciones')->insertGetId([
        //             'title'=>"Nueva Data",
        //             'description'=>"Se agrego nueva data en Ventas",
        //             'pais'=>$find_country[0]->id,
        //             'pais_name'=>$find_country[0]->name,
        //             'created_at' => date('Y-m-d H:i:s'),
             
        //            ]);




        //     }








        // }


        //                 }


                        

        //     }
        //     // dd($result->sheetData['KPI-1']);


        // }
        if(count($ventas_7) > 0){

            foreach($ventas_7 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["categoria"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->valor = trim($value["margen"]);
                        $object->volumen = trim($value["volumen"]);
                        $object->ventas = trim($value["ventas"]);
                        $object->pais = $value["pais"];
                        $object->seccion = "ventas-7";
                        $object->ano = date("Y", $object->fecha);
                        $object->fecha_formato = date("Y-m-d", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('ventas')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'valor'=>$object->valor,
                    'volumen'=>$object->volumen,
                    'ventas'=>$object->ventas,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('ventas')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('ventas')->insertGetId([
                    'name'=>$object->nombre,
                    'valor'=>$object->valor,
                    'volumen'=>$object->volumen,
                    'ventas'=>$object->ventas,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);

                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en Ventas",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);







            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($rrss_1) > 0){

            foreach($rrss_1 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["nombre"]);
                        $object->fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["fecha"]);
                        $object->periodo = trim($value["periodo"]);
                        $object->descripcion = trim($value["descripcion"]);
                        $object->frecuencia = trim($value["frecuencia"]);
                        $object->url = $value["url"];
                        $object->pais = $value["pais"];
                        $object->seccion = "rrss-1";
                        $object->ano = date("Y", $object->fecha);
                        $object->fecha_formato = date("Y-m-d", $object->fecha);

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('rrss_data')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();


            $archivo_name = $object->url;



            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'descripcion'=>$object->descripcion,
                    'frecuencia'=>$object->frecuencia,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('rrss_data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('rrss_data')->insertGetId([
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'descripcion'=>$object->descripcion,
                    'frecuencia'=>$object->frecuencia,
                    'fecha'=>$object->fecha_formato,
                    'ano'=>$object->ano,
                    'url'=>$object->url,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'archivo'=>$archivo_name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en RRSS",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);




            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($rrss_2) > 0){

            foreach($rrss_2 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["sentimiento"]);
                        $object->marca = trim($value["marca"]);
                        $object->periodo = trim($value["periodo"]);
                        $object->valor = trim($value["valor"]);
                        $object->pais = $value["pais"];
                        $object->seccion = "rrss-2";
                        $object->ano = $value["ano"];

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('rrss_data')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('marca', $object->marca)->where('periodo', $object->periodo)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'marca'=>$object->marca,
                    'valor'=>$object->valor,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('rrss_data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('rrss_data')->insertGetId([
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'marca'=>$object->marca,
                    'valor'=>$object->valor,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en RRSS",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);




            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($rrss_3) > 0){

            foreach($rrss_3 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->nombre = trim($value["rrss"]);
                        $object->marca = trim($value["marca"]);
                        $object->periodo = trim($value["periodo"]);
                        $object->valor = trim($value["valor"]);
                        $object->pais = $value["pais"];
                        $object->seccion = "rrss-3";
                        $object->ano = $value["ano"];

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('rrss_data')->where('pais', $find_country[0]->id)->where('name', $object->nombre)->where('ano', $object->ano)->where('marca', $object->marca)->where('periodo', $object->periodo)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'marca'=>$object->marca,
                    'valor'=>$object->valor,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('rrss_data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('rrss_data')->insertGetId([
                    'name'=>$object->nombre,
                    'periodo'=>$object->periodo,
                    'marca'=>$object->marca,
                    'valor'=>$object->valor,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en RRSS",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);




            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($rrss_4) > 0){

            foreach($rrss_4 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->marca = trim($value["marca"]);
                        $object->periodo = trim($value["periodo"]);
                        $object->valor = trim($value["menciones"]);
                        $object->pais = $value["pais"];
                        $object->seccion = "rrss-4";
                        $object->ano = $value["ano"];

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('rrss_data')->where('pais', $find_country[0]->id)->where('ano', $object->ano)->where('marca', $object->marca)->where('periodo', $object->periodo)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'periodo'=>$object->periodo,
                    'marca'=>$object->marca,
                    'valor'=>$object->valor,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('rrss_data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('rrss_data')->insertGetId([
                    'periodo'=>$object->periodo,
                    'marca'=>$object->marca,
                    'valor'=>$object->valor,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en RRSS",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);




            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }

        if(count($rrss_5) > 0){

            foreach($rrss_5 as $key => $value){

                // dd($value);

                        $object = new \stdClass();
                        $object->marca = trim($value["marca"]);
                        $object->periodo = trim($value["periodo"]);
                        $object->valor = trim($value["interacciones"]);
                        $object->pais = $value["pais"];
                        $object->seccion = "rrss-5";
                        $object->ano = $value["ano"];

                        //dd($object->fecha);
                        
                        if(!empty($object)){


        $pais_lower = trim(strtolower($object->pais));

        $find_country = DB::table('paises')
        ->where(DB::raw('lower(name)'), $pais_lower)
        ->get();

        if(count($find_country) > 0){

            $find_data = DB::table('rrss_data')->where('pais', $find_country[0]->id)->where('ano', $object->ano)->where('marca', $object->marca)->where('periodo', $object->periodo)->where('seccion', $object->seccion)->get();

            if(count($find_data) > 0){


     
                $data_update = array(
                    'periodo'=>$object->periodo,
                    'marca'=>$object->marca,
                    'valor'=>$object->valor,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                    'updated_at' => date('Y-m-d H:i:s')
              
                );
              
              
                  DB::table('rrss_data')->where('id', '=', $find_data[0]->id)->update($data_update);




            }else{


                $id = DB::table('rrss_data')->insertGetId([
                    'periodo'=>$object->periodo,
                    'marca'=>$object->marca,
                    'valor'=>$object->valor,
                    'ano'=>$object->ano,
                    'pais'=>$find_country[0]->id,
                    'seccion'=>$object->seccion,
                    'pais_name'=>$find_country[0]->name,
                     'created_at' => date('Y-m-d H:i:s'),
             
                   ]);


                   $notificacion = DB::table('notificaciones')->insertGetId([
                    'title'=>"Nueva Data",
                    'description'=>"Se agrego nueva data en RRSS",
                    'pais'=>$find_country[0]->id,
                    'pais_name'=>$find_country[0]->name,
                    'created_at' => date('Y-m-d H:i:s'),
             
                   ]);




            }








        }


                        }


                        

            }
            // dd($result->sheetData['KPI-1']);


        }


        if(count($plan_operativo_a) > 0){

            foreach($plan_operativo_a as $key => $value){

                $object = new \stdClass();
                $object->item = $value["nombre"];
                $object->dato = $value["real_ton"];
                $object->dato_2 = $value["plan_ton"];
                $object->dato_3 = $value["cumplimiento"];
                $object->pais = $value["pais"];
                $object->ano = $value["periodo"];
                $object->status = $value["status"];
                $object->seccion = "plan-operativo-a";

                if(!empty($object)){



                    $codigo_item = trim(strtolower(str_replace(" ","_", $object->item)));
                    $pais_lower = trim(strtolower($object->pais));
            
                    $find_country = DB::table('paises')
                    ->where(DB::raw('lower(name)'), $pais_lower)
                    ->get();
            
                    if(count($find_country) > 0){
            
                        $find_data = DB::table('data')->where('pais', $find_country[0]->id)->where('item', $codigo_item)->where('ano', $object->ano)->where('status', $object->status)->where('seccion', $object->seccion)->get();
            
                        if(count($find_data) > 0){
            
            
                 
                            $data_update = array(
                                'name'=>$object->item,
                                'dato'=>$object->dato,
                                'dato_2'=>$object->dato_2,
                                'dato_3'=>$object->dato_3,
                                'seccion'=>$object->seccion,
                                'ano'=>$object->ano,
                                'status'=>$object->status,
                                'updated_at' => date('Y-m-d H:i:s')
                          
                            );
                          
                          
                              DB::table('data')->where('id', '=', $find_data[0]->id)->update($data_update);
            
            
            
            
                        }else{
            
            
                            $id = DB::table('data')->insertGetId([
                                'name'=>$object->item,
                                'dato'=>$object->dato,
                                'dato_2'=>$object->dato_2,
                                'dato_3'=>$object->dato_3,
                                'item'=>$codigo_item,
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'seccion'=>$object->seccion,
                                'ano'=>$object->ano,
                                'status'=>$object->status,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);


                               $notificacion = DB::table('notificaciones')->insertGetId([
                                'title'=>"Nueva Data",
                                'description'=>"Se agrego nueva data en Plan Operativo A",
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);
            
            
            
            
            
            
            
                        }
            
            
            
            
            
            
            
            
                    }
            
            
                                    }


            }





        }




        if(count($precios_comodities) > 0){

            foreach($precios_comodities as $key => $value){

                $object = new \stdClass();
                $object->mes = $value["mes"];
                $object->ano = $value["ano"];
                $object->maiz_amarillo = $value["maiz_amarillo"];
                $object->maiz_blanco = $value["maiz_blanco"];
                $object->trigo = $value["trigo_us_srw"];
                $object->petroleo = $value["petroleo_wti"];
                $object->seccion = "comodities";

                if(!empty($object)){



            
                        $find_data = DB::table('precios')->where('mes', $object->mes)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();
            
                        if(count($find_data) > 0){
            
            
                 
                            $data_update = array(
                                'seccion'=>$object->seccion,
                                'mes'=>$object->mes,
                                'ano'=>$object->ano,
                                'maiz_amarillo'=>$object->maiz_amarillo,
                                'maiz_blanco'=>$object->maiz_blanco,
                                'trigo'=>$object->trigo,
                                'petroleo'=>$object->petroleo,
                                'updated_at' => date('Y-m-d H:i:s')
                          
                            );
                          
                          
                              DB::table('precios')->where('id', '=', $find_data[0]->id)->update($data_update);
            
            
            
            
                        }else{
            
            
                            $id = DB::table('precios')->insertGetId([
                                'seccion'=>$object->seccion,
                                'mes'=>$object->mes,
                                'ano'=>$object->ano,
                                'maiz_amarillo'=>$object->maiz_amarillo,
                                'maiz_blanco'=>$object->maiz_blanco,
                                'trigo'=>$object->trigo,
                                'petroleo'=>$object->petroleo,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);


                               $notificacion = DB::table('notificaciones')->insertGetId([
                                'title'=>"Nueva Data",
                                'description'=>"Se agrego nueva data en Precios Commodities",
                                'pais'=>0,
                                'pais_name'=>'General',
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);
            
            
            
            
            
            
            
                        }
            
            
            
            
            
            
            
            
                
            
            
                                    }


            }





        }


        if(count($precios_compra_maiz) > 0){

            foreach($precios_compra_maiz as $key => $value){

                $object = new \stdClass();
                $object->mes = $value["mes"];
                $object->ano = $value["ano"];
                $object->ap_ve = $value["ap_ve"];
                $object->ap_col = $value["ap_col"];
                $object->igc = $value["igc"];
                $object->seccion = "precio-compra-maiz";

                if(!empty($object)){


                        $find_data = DB::table('precios')->where('mes', $object->mes)->where('ano', $object->ano)->where('seccion', $object->seccion)->get();
            
                        if(count($find_data) > 0){
            
            
                 
                            $data_update = array(
                                'seccion'=>$object->seccion,
                                'mes'=>$object->mes,
                                'ano'=>$object->ano,
                                'ap_ve'=>$object->ap_ve,
                                'ap_col'=>$object->ap_col,
                                'igc'=>$object->igc,
                                'updated_at' => date('Y-m-d H:i:s')
                          
                            );
                          
                          
                              DB::table('precios')->where('id', '=', $find_data[0]->id)->update($data_update);
            
            
            
            
                        }else{
            
            
                            $id = DB::table('precios')->insertGetId([
                                'seccion'=>$object->seccion,
                                'mes'=>$object->mes,
                                'ano'=>$object->ano,
                                'ap_ve'=>$object->ap_ve,
                                'ap_col'=>$object->ap_col,
                                'igc'=>$object->igc,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);


                               $notificacion = DB::table('notificaciones')->insertGetId([
                                'title'=>"Nueva Data",
                                'description'=>"Se agrego nueva data en Precios Compra Maiz",
                                'pais'=>0,
                                'pais_name'=>'General',
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);
            
            
            
            
            
            
            
                        }
            
            
            
            
            
            
            
            
            
                                    }


            }





        }


        if(count($precios_informes) > 0){

            foreach($precios_informes as $key => $value){

                $object = new \stdClass();
                $object->nombre = $value["nombre"];
                $object->ano = $value["ano"];
                $object->descripcion = $value["descripcion"];
                $object->tipo = $value["tipo"];
                $object->url = $value["url"];
                $object->pais = $value["pais"];
                $object->seccion = "precios-informes";

                if(!empty($object)){

                    $pais_lower = trim(strtolower($object->pais));
            
                    $find_country = DB::table('paises')
                    ->where(DB::raw('lower(name)'), $pais_lower)
                    ->get();
            
                    if(count($find_country) > 0){
            
                        $find_data = DB::table('precios')->where('pais', $find_country[0]->id)->where('periodo', $object->ano)->where('nombre', $object->nombre)->where('seccion', $object->seccion)->get();
            
                        if(count($find_data) > 0){
            
            
                 
                            $data_update = array(
                                'nombre'=>$object->nombre,
                                'descripcion'=>$object->descripcion,
                                'tipo'=>$object->tipo,
                                'url'=>$object->url,
                                'periodo'=>$object->ano,
                                'seccion'=>$object->seccion,
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'updated_at' => date('Y-m-d H:i:s')
                          
                            );
                          
                          
                              DB::table('precios')->where('id', '=', $find_data[0]->id)->update($data_update);
            
            
            
            
                        }else{
            
            
                            $id = DB::table('precios')->insertGetId([
                                'nombre'=>$object->nombre,
                                'descripcion'=>$object->descripcion,
                                'tipo'=>$object->tipo,
                                'url'=>$object->url,
                                'periodo'=>$object->ano,
                                'seccion'=>$object->seccion,
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);


                               $notificacion = DB::table('notificaciones')->insertGetId([
                                'title'=>"Nueva Data",
                                'description'=>"Se agrego nueva data en Precios Informes",
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);
            
            
            
            
            
            
            
                        }
            
            
            
            
            
            
            
            
                    }
            
            
                                    }


            }





        }


        if(count($continuos_informes) > 0){

            foreach($continuos_informes as $key => $value){

                $object = new \stdClass();
                $object->nombre = $value["nombre"];
                $object->ano = $value["ano"];
                $object->descripcion = $value["descripcion"];
                $object->segmento = $value["segmento"];
                $object->url = $value["url"];
                $object->pais = $value["pais"];
                $object->seccion = "continuos-informes";

                if(!empty($object)){

                    $pais_lower = trim(strtolower($object->pais));
            
                    $find_country = DB::table('paises')
                    ->where(DB::raw('lower(name)'), $pais_lower)
                    ->get();
            
                    if(count($find_country) > 0){
            
                        $find_data = DB::table('continuos')->where('pais', $find_country[0]->id)->where('ano', $object->ano)->where('nombre', $object->nombre)->where('seccion', $object->seccion)->get();
            
                        if(count($find_data) > 0){
            
            
                 
                            $data_update = array(
                                'nombre'=>$object->nombre,
                                'descripcion'=>$object->descripcion,
                                'segmento'=>$object->segmento,
                                'url'=>$object->url,
                                'ano'=>$object->ano,
                                'seccion'=>$object->seccion,
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'updated_at' => date('Y-m-d H:i:s')
                          
                            );
                          
                          
                              DB::table('continuos')->where('id', '=', $find_data[0]->id)->update($data_update);
            
            
            
            
                        }else{
            
            
                            $id = DB::table('continuos')->insertGetId([
                                'nombre'=>$object->nombre,
                                'descripcion'=>$object->descripcion,
                                'segmento'=>$object->segmento,
                                'url'=>$object->url,
                                'ano'=>$object->ano,
                                'seccion'=>$object->seccion,
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);


                               $notificacion = DB::table('notificaciones')->insertGetId([
                                'title'=>"Nueva Data",
                                'description'=>"Se agrego nueva data en Continuos",
                                'pais'=>$find_country[0]->id,
                                'pais_name'=>$find_country[0]->name,
                                'created_at' => date('Y-m-d H:i:s'),
                         
                               ]);
            
            
            
            
            
            
            
                        }
            
            
            
            
            
            
            
            
                    }
            
            
                                    }


            }





        }








        //echo "Procesado";
return back()->with('update', 'Data guardada.');
    }
}
