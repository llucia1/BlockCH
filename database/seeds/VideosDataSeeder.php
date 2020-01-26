<?php

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VideosDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $json = File::get("database/data/videos.json");
        $data = json_decode($json);
        foreach ($data as $obj) {

            Video::create(array(
                'video_category_id' => $obj->video_category_id,
                'name' => $obj->name,
                'code' => $obj->code,
                'category_name' => $obj->category_name,
            ));
                
        }

        Model::reguard();
    }
}
