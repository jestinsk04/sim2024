<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Paise;
use DataTables;
use Auth;
use DB;
use Illuminate\Support\Str;
use Hash;
use App\Mail\NewUsuarioRegister;
use Mail;
class UsuariosController extends Controller
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
        $resultData['breadcrumb2'] = "Listado Usuarios";
        return view('admin/usuarios/display', [
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
        $resultData['breadcrumb2'] = "Agregar Usuario";
        $data = $this->Paise->paginator();
        $resultData['paises'] = $data;
        return view('admin/usuarios/add', [
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
        $id = $this->User->insert($request);
        return  Redirect::back()->with('update', 'Usuario Guardado!');


       
    }
    public function reiniciar_clave(Request $request)
    {

        $id = $request->id;

        $data = array();
        $message = array();
        $errorMessage = array();

        $password = Str::random(8);

        $user_data = DB::table('users')->where('id', $id)->get();



        $data = array(
            'password' => Hash::make($password),
            'updated_at' => date('Y-m-d H:i:s')

        );


        $this->User->updaterecord($id, $data);


        $data_booking["email"] = $user_data[0]->email;
        $data_booking["name"] = $user_data[0]->name;
        $data_booking["password"] = $password;

        try{
          Mail::to($user_data[0]->email)->send(new NewUsuarioRegister($data_booking));
        }catch(\Exception $e){
                           
                          }


        return redirect('admin/usuarios-display')->with('update', 'Clave Enviada!');
    }
    public function update(Request $request)
    {

        $id = $request->id;

        $data = array();
        $message = array();
        $errorMessage = array();

        $accesos = "";



        if(isset($request->accesos)){
            $accesos = json_encode($request->accesos);
        }



        $data = array(
            'name' => $request->name,
            'lname' => $request->lname,
            'email' => $request->email,
            'image'=>$request->image,
            'permisos' => $accesos,
            'updated_at' => date('Y-m-d H:i:s')

        );


        $this->User->updaterecord($id, $data);


        return redirect('admin/usuarios-display')->with('update', 'Usuario Actualizado!');
    }
    public function delete(Request $request){
        $this->User->destroyrecord($request->id);
        return redirect()->back()->withErrors(["Registro Eliminado"]);
      }
    public function edit(Request $request)
    {

     
        $id = $request->id;

        $result = array();
        $resultData = array();
        $message = array();
        $errorMessage = array();
        $data = $this->User->edit($id);
        $resultData['data'] = $data;
        $paises = $this->Paise->paginator();
        $resultData['paises_edit'] = $paises;

        $data_permisos = array();
        $data_paises = array();

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
        $resultData['breadcrumb2'] = "Editar Usuario";


        return view("admin.usuarios.edit")->with('data', $resultData);
    }
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->where('role_id', 1)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('datos', function($row){

                        $datos = '<a href="" class="font-medium whitespace-nowrap">'.$row->name.' '.$row->lname.'</a>
                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">'.$row->email.'</div>';

                        return $datos;
                    })
                    ->addColumn('imagen', function($row){

                        $imagen = '<div class="flex">
                        <div class="w-10 h-10 image-fit zoom-in">
                            <img alt="'.$row->name.'" class="tooltip rounded-full" src="https://sim-ep.com/storage/uploads/'.$row->image.'" >
                        </div>
                        </div>';
                        return $imagen;
                    })
                    ->addColumn('action', function($row){

                        $btn = '<div class="flex justify-center items-center">
                        <a class="flex items-center mr-3" href="usuarios-edit/'.$row->id.'">
                            <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Editar
                        </a>
                        <a class="flex items-center mr-3" href="usuarios-clave/'.$row->id.'">
                            <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Reenviar Clave
                        </a>
                        <a class="flex items-center text-danger delete-register" data-id="'.$row->id.'" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Eliminar
                        </a>
                      </div>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'imagen' , 'datos'])
                    ->make(true);
        }

        // return view('user');
    }
}
