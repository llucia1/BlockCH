<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webminars', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name');
            $table->text('text')->nullable();
            $table->string('url');
            $table->date('start');
            $table->string('start_date');
            $table->string('start_hour');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webminars');
    }
}
