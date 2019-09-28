<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('desc')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button_color')->nullable();
            $table->string('button_y')->nullable();
            $table->string('slider_position')->nullable();
            $table->string('slider_image')->nullable();
            $table->string('title_color')->nullable();
            $table->string('title_y')->nullable();
            $table->string('sub_color')->nullable();
            $table->string('sub_y')->nullable();
            $table->string('desc_color')->nullable();
            $table->string('desc_y')->nullable();
            $table->string('position')->nullable();
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
        Schema::dropIfExists('home_sliders');
    }
}
