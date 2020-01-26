<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    protected $fillable = ['course_id','user_id'];

    //relaciones
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

}
