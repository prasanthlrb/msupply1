<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->string('sales_price');
            $table->string('product_id');
            $table->string('order_id');
            $table->string('qty');
            $table->string('tax_type')->nullable();
            $table->string('tax')->nullable();
            $table->string('tax_percent')->nullable();
            $table->string('total_price');
            $table->string('user_id');
            $table->string('commands')->nullable();
            $table->string('rating')->nullable();
            $table->string('unit_type')->nullable();
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
        Schema::dropIfExists('order_items');
    }
}
