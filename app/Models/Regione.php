<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Illuminate\Support\Str;
use Hash;


class Regione extends Model
{
    use HasFactory;


    public function paginator(){
        $data = Regione::select('*')
        ->orderBy('id')
        ->paginate(50);
           return $data;
    }
    public function data_by_name($variable){
      $data = Regione::select('*')
      ->where('name', $variable)
      ->first();
      return $data;
  }


 

    public function insert($request){



            $id = Regione::insertGetId([
              'name' => $request->name,
              'country'=>$request->country,
              'color'=>$request->color,
              'created_at' => date('Y-m-d H:i:s'),
          ]);


          return $id;

         



      }

      public function edit($id){
          $data = Regione::where('id','=', $id)->first();
          return $data;
        }
        
    public function updaterecord($id,$data){
      Regione::where('id', '=', $id)->update($data);

  
      }
      public function destroyrecord($id){
        Regione::where('id','=', $id)->delete();

      
      }
}
