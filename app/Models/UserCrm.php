<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCrm extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'usuarios';
    public $timestamps = false;
    protected $fillable = ['idRol','nombre','apellidos','email','pass'];
}
