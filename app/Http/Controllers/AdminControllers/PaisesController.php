<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Paise;
use DataTables;
use Auth;
use DB;

class PaisesController extends Controller
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
        $resultData['breadcrumb2'] = "Listado Paises";
        return view('admin/paises/display', [
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
        $resultData['breadcrumb2'] = "Agregar País";
        return view('admin/paises/add', [
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
        $id = $this->Paise->insert($request);
        return  Redirect::back()->with('update', 'País Guardado!');


       
    }
    public function update(Request $request)
    {

        $id = $request->id;

        $data = array();
        $message = array();
        $errorMessage = array();


        $country_data = DB::table('countries')->where('countries_id', $request->pais)->get();


        if(count($country_data)>0){


            $data = array(
                'name' => $country_data[0]->countries_name,
                'image'=>'https://flagcdn.com/256x192/'.strtolower($country_data[0]->countries_iso_code_2).'.png',
                'iso'=>$country_data[0]->countries_iso_code_2,
                'tipo'=>$request->tipo,
                'email'=>$request->email,
                'mapa'=>$request->mapa,
                'simbolo_moneda'=>$request->moneda,
                'updated_at' => date('Y-m-d H:i:s')
          );
  
  
          $this->Paise->updaterecord($id, $data);


        }

       


        return redirect('admin/paises-display')->with('update', 'País Actualizado!');
    }
    public function delete(Request $request){
        $this->Paise->destroyrecord($request->id);
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
        $resultData['breadcrumb2'] = "Editar País";
     
        $id = $request->id;

        $data = $this->Paise->edit($id);
        $resultData['data'] = $data;
        return view("admin.paises.edit")->with('data', $resultData);
    }
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Paise::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('imagen', function($row){

                        $imagen = '<div class="flex">
                        <div class="w-10 h-10 image-fit zoom-in">
                            <img alt="'.$row->name.'" class="tooltip rounded-full" src="'.$row->image.'" >
                        </div>
                        </div>';
                        return $imagen;
                    })
                    ->addColumn('action', function($row){

                        $btn = '<div class="flex justify-center items-center">
                        <a class="flex items-center mr-3" href="paises-edit/'.$row->id.'">
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
