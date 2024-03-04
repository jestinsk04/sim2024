<?php

namespace App\Http\Controllers\CoreControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Storage;


class FileController extends Controller
{
   
    public function store(Request $request)
    {
  

      if ($request->file('file')) {

       
        $fileName = $request->file('file')->hashName();;
        $path = $request->file('file')->store('public/uploads');
      }

    //   $file->name = $fileName;
    //   $file->path = '/storage/'.$path;
    //   $file->save();

      return response()->json([ 'success' => $fileName]);
    }


    public function remvoeFile(Request $request)
    {
        $name =  $request->get('name');

        $result = "";


        if(Storage::exists('public/uploads/'.$name)){


            Storage::delete('public/uploads/'.$name);

            $result = "borrado";
     
        }else{
            $result = "no existe";
        }

        return $result;
    }

}