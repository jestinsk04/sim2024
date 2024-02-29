<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Illuminate\Support\Str;
use Hash;


class Proveedore extends Model
{
    use HasFactory;


    public function paginator(){
        $data = Proveedore::select('*')
        ->orderBy('id')
        ->paginate(50);
           return $data;
    }
    public function data_by_name($variable){
      $data = Proveedore::select('*')
      ->where('name', $variable)
      ->first();
      return $data;
  }


 

    public function insert($request){

          $id = Proveedore::insertGetId([
              'name' => $request->name,
              'created_at' => date('Y-m-d H:i:s'),
          ]);


          return $id;
      }

      public function edit($id){
          $data = Proveedore::where('id','=', $id)->first();
          return $data;
        }
        
    public function updaterecord($id,$data){
        Proveedore::where('id', '=', $id)->update($data);

  
      }
      public function destroyrecord($id){
        Proveedore::where('id','=', $id)->delete();

      
      }
}
