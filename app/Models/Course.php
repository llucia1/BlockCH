<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name','amount','short_description'];
    
    //relaciones
    public function chapters()
    {
        return $this->hasMany('App\Models\CourseChapter');
    }

    public function userCourses()
    {
        return $this->hasOne('App\Models\UserCourse');
    }
    //devuelve una colección de cursos, obviando los cursos nya comprados
    static function  getCoursesCollection($id)
    {
        $courses = '';//almacenamos la colección de cursos
        $coursesUser = '';//almacenamos los cursos del susario
        //consultamos los cursos del usuario
        $coursesUser = UserCourse::select('course_id')
        ->Where('user_id',$id)
        ->get();
        //realizamos la consulta
        $courses = Course::whereNotIn('id',$coursesUser->toArray())->get();
        return $courses;
    }
}
