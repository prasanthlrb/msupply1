<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaintLitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paint_lits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('price_type')->nullable();
            $table->string('paint_lit')->nullable();
            $table->string('value_type')->nullable();
            $table->string('amount')->nullable();
            $table->string('product_id');
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
        Schema::dropIfExists('paint_lits');
    }
}
