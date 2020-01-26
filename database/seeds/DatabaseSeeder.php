<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //default data
        //carga la lista de paises
        Model::unguard();

        DB::table('countries')->delete();
        $json = File::get("database/data/countries.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            \App\Models\Country::create(array(
                'name' => $obj->name,
                'code' => $obj->code,
                'prefix' => $obj->prefix
            ));
        }

        Model::reguard();
        //cursos
        $this->call(CoursesDataSeeder::class);
        //datos demo
        $this->call(DemoDataSeeder::class);
        //videos
        $this->call(VideosDataSeeder::class);
    }
}
