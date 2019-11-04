<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product')->nullable();
            $table->string('user_id')->nullable();
            $table->string('emp_id')->nullable();
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->string('total')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('cheque_image')->nullable();
            $table->string('cheque_date')->nullable();
            $table->string('remainder_date')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('admin_approved')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('deals');
    }
}
