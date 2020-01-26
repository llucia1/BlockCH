<?php

use App\Models\VideoCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creamos 1 administrador
        /*factory(\App\User::class, 1)->create()->each(function ($user){
            \Silber\Bouncer\BouncerFacade::assign('Admin')->to($user);
        });
        // Creamos 15 Cliente
        factory(\App\User::class, 15)->create()->each(function ($user){
            \Silber\Bouncer\BouncerFacade::assign('Customer')->to($user);
        });*/
        // Creamos un usuario asignado al usuario rol customer id 2
        $user = \App\User::create([
            'name' => 'Rafael',
            //'email' => str_random(10).'@gmail.com',
            'email' => 'rafael@gmail.com',
            'password' => bcrypt('&4222SFCrb'),
            'parent' => 2,
            'country' => 'ESPAÑA',
            'city' => 'SEVILLA',
            'address' => 'Calle Burgos 32',
            'prefix' => 34,
            'telephone' => 666666666,
            'credits' => 30
        ]);
        \Silber\Bouncer\BouncerFacade::assign('Admin')->to($user);
        // Creamos 5 categorías para vídeos
        $categories = [
            ['name'=>'Blockchain'],
            ['name'=>'Minería'],
            ['name'=>'Criptomonedas'],
            ['name'=>'Busines'],
            ['name'=>'Red P2P'],
        ];
        foreach($categories as $category){
            VideoCategory::create($category);
        }
        // Creamos 15 referral
        /*factory(\App\Models\Referral::class, 15)->create()->each(function ($referral){
           
        });*/
        //creamos 5 cursos
        /*factory(\App\Models\Course::class, 5)->create()->each(function ($course){
           
        });*/
        //vinculamos un usuario a un curso
        /*\App\Models\UserCourse::create([
            'course_id' => 1,
            'user_id' => 17,
        ]);*/
        //creamos 5 webinars
        /*factory(\App\Models\Webminar::class, 5)->create()->each(function ($webinar){
           
        });*/
        //creamos 10 compras perdidas
        /*factory(\App\Models\OrderLost::class, 10)->create()->each(function ($orderLost){
           
        });*/
        //creamos 20 tickets de soporte
        /*factory(\App\Models\Support::class, 20)->create()->each(function ($support){
           
        });*/
        //creamos una configuración inicial para el sistema de créditos
        /*\App\Models\PointsByConcept::create([
            'point' => 2,
            'concept' => 'USER',
        ]);*/
        /*\App\Models\CreditsByPoint::create([
        ]);
        //creamos una colección de créditos al usuario 17
        factory(\App\Models\CreditsCollection::class, 15)->create()->each(function ($creditsCollection){
           
        });*/
    }
}
