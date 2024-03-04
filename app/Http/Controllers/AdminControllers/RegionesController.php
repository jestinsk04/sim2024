<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Regione;
use App\Models\Paise;
use DataTables;
use Auth;
use DB;

class RegionesController extends Controller
{



    public function __construct(Regione $regiones, Paise $paise)
    {

        $this->Regione = $regiones;
        $this->Paise = $paise;
    
    }

        /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function display()
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
        $resultData['breadcrumb2'] = "Listado Regiones";
        return view('admin/regiones/display', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            // 'layout' => 'side-menu'
        ])->with('data', $resultData);
    }

    public function add()
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

        $countries = DB::table('countries')->get();

        $resultData['permisos'] = $data_permisos;
        $resultData['paises'] = $data_paises;
        $resultData['paises_list'] = $paises;
        $resultData['countries'] = $countries;

        $pais_selected = session('pais_selected');
        $data = $this->Paise->data_by_name($pais_selected);

        $country_data = DB::table('data')->where('pais', $data->id)->get();



        $resultData['pais'] = $data;
        $resultData['menu'] = "admin";
        $resultData['sub-menu'] = "";
        $resultData['breadcrumb'] = "Admin";
        $resultData['breadcrumb2'] = "Agregar Region";
        $data = $this->Paise->paginator();
        $resultData['paises'] = $data;
        return view('admin/regiones/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            // 'layout' => 'side-menu'
        ])->with('data', $resultData);
    }
    public function insert(Request $request)
    {

        $data = array();
        $message = array();
        $errorMessage = array();
        $id = $this->Regione->insert($request);
        return  Redirect::back()->with('update', 'Region Guardada!');


       
    }
    public function update(Request $request)
    {

        $id = $request->id;

        $data = array();
        $message = array();
        $errorMessage = array();


     


            $data = array(
                'name' => $request->name,
                'country'=>$request->country,
                'color'=>$request->color,
                'updated_at' => date('Y-m-d H:i:s')
          );
  
  
          $this->Regione->updaterecord($id, $data);


   

       


        return redirect('admin/regiones-display')->with('update', 'Region Actualizada!');
    }
    public function delete(Request $request){
        $this->Regione->destroyrecord($request->id);
        return redirect()->back()->withErrors(["Registro Eliminado"]);
      }
    public function edit(Request $request)
    {


        $result = array();
        $resultData = array();
        $message = array();
        $errorMessage = array();
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

        $countries = DB::table('countries')->get();


        $resultData['permisos'] = $data_permisos;
        $resultData['paises'] = $data_paises;
        $resultData['paises_list'] = $paises;

        $pais_selected = session('pais_selected');
        $data = $this->Paise->data_by_name($pais_selected);

        $country_data = DB::table('data')->where('pais', $data->id)->get();


        $resultData['countries'] = $countries;
        $resultData['pais'] = $data;
        $resultData['menu'] = "admin";
        $resultData['sub-menu'] = "";
        $resultData['breadcrumb'] = "Admin";
        $resultData['breadcrumb2'] = "Editar Region";
     
        $id = $request->id;

        $data = $this->Regione->edit($id);
        $resultData['data'] = $data;
        $data = $this->Paise->paginator();
        $resultData['paises'] = $data;
        return view("admin.regiones.edit")->with('data', $resultData);
    }
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Regione::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('pais', function($row){

                        $pais = "";

                        $query = DB::table('paises')->where('id', $row->country)->get();

                        if(count($query) > 0){

                            $pais = $query[0]->name;

                        }

                        return $pais;
                    })
                    ->addColumn('action', function($row){

                        $btn = '<div class="flex justify-center items-center">
                        <a class="flex items-center mr-3" href="regiones-edit/'.$row->id.'">
                            <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Editar
                        </a>
                        <a class="flex items-center text-danger delete-register" data-id="'.$row->id.'" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Eliminar
                        </a>
                      </div>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'imagen'])
                    ->make(true);
        }

        return view('user');
    }
}
