<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_transports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vehicle_name')->nullable();
            $table->string('other')->nullable();
            $table->string('user_id');
            $table->string('price');
            $table->string('transport_id');
            $table->string('distance')->nullable();
            $table->string('order_item')->nullable();
            $table->string('total')->nullable();
            $table->string('status')->default(0);
            $table->string('shipping')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
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
        Schema::dropIfExists('order_transports');
    }
}
