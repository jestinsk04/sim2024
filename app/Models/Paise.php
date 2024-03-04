<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Illuminate\Support\Str;
use Hash;


class Paise extends Model
{
    use HasFactory;


    public function paginator(){
        $data = Paise::select('*')
        ->orderBy('id')
        ->paginate(100);
           return $data;
    }
    public function data_by_name($variable){
      $data = Paise::select('*')
      ->where('name', $variable)
      ->first();
      return $data;
  }


 

    public function insert($request){



          $country_data = DB::table('countries')->where('countries_id', $request->pais)->get();

          

          if(count($country_data) > 0){

            $id = Paise::insertGetId([
              'name' => $country_data[0]->countries_name,
              'image'=>'https://flagcdn.com/256x192/'.strtolower($country_data[0]->countries_iso_code_2).'.png',
              'iso'=>$country_data[0]->countries_iso_code_2,
              'tipo'=>$request->tipo,
              'email'=>$request->email,
              'mapa'=>$request->mapa,
              'simbolo_moneda'=>$request->moneda,
              'created_at' => date('Y-m-d H:i:s'),
          ]);


          return $id;

          }else{

            return 0;

          }



      }

      public function edit($id){
          $data = Paise::where('id','=', $id)->first();
          return $data;
        }
        
    public function updaterecord($id,$data){
        Paise::where('id', '=', $id)->update($data);

  
      }
      public function destroyrecord($id){
        Paise::where('id','=', $id)->delete();

      
      }
}
