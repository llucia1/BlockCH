<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'password','country','city',
        'address','prefix','telephone','parent','remember_token','referral_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','parent'
    ];

    protected $dates = ['deleted_at'];

    public function deleteOrRestore()
    {
        ($this->trashed()) ? $this->restore() : $this->delete();
        return $this;
    }
    
    //relaciones
    public function referral()
    {
        return $this->hasMany('App\Models\Referral');
    }

    public function userCourse()
    {
        return $this->hasMany('App\Models\UserCourse');
    }
    /**
     * Este método es utilizado a nivel interno para comprobar si el usuario tiene o no asignado
     * dicho rol. Es utilizado principalmente por el Middleware/CheckRole, que controla desde las rutas
     * quien tiene o no permiso para acceder a dichas rutas.
     * @param $result -- booleano, inicia false
     * @param $roles -- alamcenamos la cadena con los roles que tienen permisos
     * @param $rolesArray -- alamcenamos el istado de roles en formato de vector
     * @param $myRoles -- alamcenamos los roles del usuario logado
     * 
    */
    public function hasRole(string $roleSlug)
    {
        $result = false;
        $roles = $roleSlug;
        $rolesArray = explode(';',$roles);  
        $myRoles = auth()->user()->roles;
        //recorremos el vector y comprobramos si coinciden alguno
        foreach ($myRoles as $key => $rol) {

            if (in_array($rol->name, $rolesArray)) {
                //si hay por lo menos una coincidencia, result = true y detemos
                $result = true;
                break;
            }
        }
        //devolvemos el resultado
        return $result;
    }

    //Mutators
    public function setTelephoneAttribute($value)
    {
        if( $value != '')
            $this->attributes['telephone'] = str_replace(' ', '', $value);
    }

    public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = str_replace(' ', '', $value);
    }
    // Accesors
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


}
