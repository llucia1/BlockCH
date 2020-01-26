<?php

namespace App\Models;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // Accesors
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    //metodo que crea url internas de referidos de cada usuario
    static function setReferralOwn($userId)
    {
        //donde almacenamos el referral_token
        $referral_token = Crypt::encryptString(str_random(10).$userId);
        //instanciamos y creamos la url para register
        $referral = new Referral;
        //seteamos los datos
        $referral->user_id = $userId;
        $referral->url = 'register/'.$referral_token;
        $referral->name = 'Registro';
        $referral->own = 1;
        //guardamos
        $referral->save();
        //creamos todos las url rferral para el registro con compra de curso
        $courses = Course::all();
        foreach ($courses as $key => $course) {
            
            $referral = new Referral;
            //seteamos los datos
            $referral->user_id = $userId;
            $referral->url = 'new-account/sign-up-form/'.$course->id.'/'.$referral_token;
            $referral->name = 'Curso '.$course->name;
            $referral->own = 1;
            //guardamos
            $referral->save();
        }
        //guardamos el referral_token en el usuario
        $user = User::withTrashed()->findOrFail($userId);
        $user->referral_token = $referral_token;
        $user->save();
    }

}
