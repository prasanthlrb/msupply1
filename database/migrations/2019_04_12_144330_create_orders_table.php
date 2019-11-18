<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('order_status')->default(0);
            $table->string('billing_id')->nullable();
            $table->string('shipping_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('shipping_type')->nullable();
            $table->string('shipping_value')->nullable();
            $table->string('project_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('brand_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
