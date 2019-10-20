<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location')->nullable();
            $table->string('product_id')->nullable();
            $table->string('price')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('location_managements');
    }
}
