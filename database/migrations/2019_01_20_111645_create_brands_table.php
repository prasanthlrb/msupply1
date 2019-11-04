<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand');
            $table->string('brand_image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('order_type')->nullable();
            $table->string('order_unit_type')->nullable();
            $table->string('order_limit')->nullable();
            $table->string('free_shipping')->nullable();
            $table->string('paid_base')->nullable();
            $table->string('paid_type')->nullable();
            $table->string('paid_value')->nullable();
            $table->string('description', 5000)->nullable();
            $table->string('status');
            $table->string('active')->default(0);
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
        Schema::dropIfExists('brands');
    }
}
