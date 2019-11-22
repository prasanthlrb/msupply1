<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category');
            $table->number('sub_category')->nullable();
            $table->number('second_sub_category')->nullable();
            $table->number('third_sub_category')->nullable();
            $table->string('group')->nullable();
            $table->string('product_name');
            $table->string('brand_name')->nullable();
            $table->longText('product_description')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('product_image')->nullable();
            $table->string('regular_price')->nullable();
            $table->string('sales_price')->nullable();
            $table->string('sku')->nullable();
            $table->integer('stock_quantity')->nullable();
            $table->integer('low_stock')->nullable();
            $table->string('weight')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('shipping_type')->nullable();
            $table->string('shipping_amount')->nullable();
            $table->string('hot_product')->nullable();
            $table->string('review')->nullable();
            $table->string('new_product')->nullable();
            $table->string('recommended')->nullable();
            $table->string('featured')->nullable();
            $table->string('group_product')->nullable();
            $table->string('related_product')->nullable();
            $table->string('tax')->nullable();
            $table->number('items')->nullable();
            $table->number('order_limit')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('price_type')->nullable();
            $table->string('value_type')->nullable();
            $table->string('amount')->nullable();
            $table->string('active')->default(0);
            $table->string('map_location')->nullable();
            $table->string('default_unit_type')->nullable();
            $table->string('delivery_from')->nullable();
            $table->string('delivery_to')->nullable();
            $table->string('notes', 5120)->nullable();
            $table->string('lat', 5120)->nullable();
            $table->string('lng', 5120)->nullable();
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
        Schema::dropIfExists('products');
    }
}
