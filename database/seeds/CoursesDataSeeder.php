<?php
use App\Models\Course;
use App\Models\CourseChapter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CoursesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Curso Bitcoin
        Course::create(array(
            'name' => 'Economía Digital y Planificación Financiera',
            'amount' => 59,
            'short_description' => 'Aprende comprar y usar las Criptomonedas'
        ));
        //creamos los capítulos del curso de Bitcoin
        $json = File::get("database/data/chapters_course.json");
        $data = json_decode($json);
        foreach ($data as $obj) {

            CourseChapter::create(array(
                'course_id' => $obj->course_id,
                'name' => $obj->name,
                'video' => $obj->video,
                'attached' => $obj->attached,
            ));
                
        }
    }

}