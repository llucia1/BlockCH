<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLost extends Model
{
    protected $fillable = [
        'name', 'email', 'remember_token'
    ];
}
