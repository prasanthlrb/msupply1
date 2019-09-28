<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaintingGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('painting_guides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('finishers')->nullable();
            $table->string('coverage')->nullable();
            $table->string('drying')->nullable();
            $table->string('coating')->nullable();
            $table->string('description_image')->nullable();
            $table->string('product_id')->nullable();
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
        Schema::dropIfExists('painting_guides');
    }
}
