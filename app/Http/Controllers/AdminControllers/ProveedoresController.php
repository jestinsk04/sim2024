<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Proveedore;
use App\Models\Paise;
use DataTables;
use Auth;
use DB;
class ProveedoresController extends Controller
{



    public function __construct(Proveedore $proveedore, Paise $paise)
    {

        $this->Proveedore = $proveedore;
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
        $resultData['breadcrumb2'] = "Listado Proveedores";
        return view('admin/proveedores/display', [
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
        $resultData['breadcrumb2'] = "Agregar Proveedor";
        return view('admin/proveedores/add', [
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
        $id = $this->Proveedore->insert($request);
        return  Redirect::back()->with('update', 'Proveedor Guardado!');


       
    }
    public function update(Request $request)
    {

        $id = $request->id;

        $data = array();
        $message = array();
        $errorMessage = array();

        $data = array(
              'name' => $request->name,
              'updated_at' => date('Y-m-d H:i:s')

        );


        $this->Proveedore->updaterecord($id, $data);


        return redirect('admin/proveedores-display')->with('update', 'Proveedor Actualizado!');
    }
    public function delete(Request $request){
        $this->Proveedore->destroyrecord($request->id);
        return redirect()->back()->withErrors(["Registro Eliminado"]);
      }
    public function edit(Request $request)
    {

     
        $id = $request->id;

        $result = array();
        $resultData = array();
        $message = array();
        $errorMessage = array();
        $data = $this->Proveedore->edit($id);
        $resultData['data'] = $data;

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
        $resultData['breadcrumb2'] = "Editar Proveedor";

        return view("admin.proveedores.edit")->with('data', $resultData);
    }
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Proveedore::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<div class="flex justify-center items-center">
                        <a class="flex items-center mr-3" href="proveedores-edit/'.$row->id.'">
                            <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Editar
                        </a>
                        <a class="flex items-center text-danger delete-register" data-id="'.$row->id.'" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Eliminar
                        </a>
                      </div>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('user');
    }
}
