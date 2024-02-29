<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Illuminate\Support\Str;
use Hash;
use App\Mail\NewUsuarioRegister;
use Mail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that appends to returned entities.
     *
     * @var array
     */
    // protected $appends = ['photo'];

    // /**
    //  * The getter that return accessible URL for user photo.
    //  *
    //  * @var array
    //  */
    // public function getPhotoUrlAttribute()
    // {
    //     if ($this->foto !== null) {
    //         return url('media/user/' . $this->id . '/' . $this->foto);
    //     } else {
    //         return url('media-example/no-image.png');
    //     }
    // }

    public function paginator(){
        $data = User::select('*')
        ->where("role_id", 1)
        ->orderBy('id')
        ->paginate(50);
           return $data;
    }
    public function insert($request){

        $password = Str::random(8);
        $accesos = "";

        if(isset($request->accesos)){
            $accesos = json_encode($request->accesos);
        }

        $id = User::insertGetId([
            'name' => $request->name,
            'lname' => $request->lname,
            'email' => $request->email,
            'image'=>$request->image,
            'password' => Hash::make($password),
            'role_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'permisos' => $accesos,
        ]);

        $data_booking["email"] = $request->email;
        $data_booking["name"] = $request->name;
        $data_booking["password"] = $password;

        try{
          Mail::to($request->email)->send(new NewUsuarioRegister($data_booking));
        }catch(\Exception $e){
                           
                          }

        return $id;
    }

    public function edit($id){
        $data = User::where('id','=', $id)->first();

        $data->permisos = json_decode($data->permisos, true);
        return $data;
      }
      
  public function updaterecord($id,$data){
      User::where('id', '=', $id)->update($data);


    }
    public function destroyrecord($id){
      User::where('id','=', $id)->delete();

    
    }
}
