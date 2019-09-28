<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_name')->nullable();
            $table->string('customer_list')->nullable();
            $table->string('customer_action')->nullable();
            $table->string('company_verify')->nullable();
            $table->string('user')->nullable();
            $table->string('user_create')->nullable();
            $table->string('user_action')->nullable();
            $table->string('review')->nullable();
            $table->string('review_approval')->nullable();
            $table->string('category')->nullable();
            $table->string('category_create')->nullable();
            $table->string('category_action')->nullable();
            $table->string('catalog')->nullable();
            $table->string('catalog_create')->nullable();
            $table->string('catalog_delete')->nullable();
            $table->string('catalog_edit')->nullable();
            $table->string('brand')->nullable();
            $table->string('brand_create')->nullable();
            $table->string('brand_action')->nullable();
            $table->string('attribute')->nullable();
            $table->string('attribute_create')->nullable();
            $table->string('attribute_edit')->nullable();
            $table->string('attribute_delete')->nullable();
            $table->string('attribute_terms')->nullable();
            $table->string('attribute_set')->nullable();
            $table->string('attribute_set_create')->nullable();
            $table->string('attribute_set_edit')->nullable();
            $table->string('attribute_set_delete')->nullable();
            $table->string('order')->nullable();
            $table->string('order_action')->nullable();
            $table->string('transport_booking')->nullable();
            $table->string('transport_booking_action')->nullable();
            $table->string('cms')->nullable();
            $table->string('cms_slider')->nullable();
            $table->string('cms_slider_create')->nullable();
            $table->string('cms_slider_action')->nullable();
            $table->string('cms_home_layout')->nullable();
            $table->string('cms_home_layout_edit')->nullable();
            $table->string('cms_home_layout_delete')->nullable();
            $table->string('cms_home_layout_create')->nullable();
            $table->string('ads')->nullable();
            $table->string('TermsAndCondition')->nullable();
            $table->string('ShippingDetails')->nullable();
            $table->string('PrivacyPolicy')->nullable();
            $table->string('about')->nullable();
            $table->string('faq')->nullable();
            $table->string('faq_create')->nullable();
            $table->string('faq_edit')->nullable();
            $table->string('faq_delete')->nullable();
            $table->string('transport')->nullable();
            $table->string('transport_create')->nullable();
            $table->string('transport_edit')->nullable();
            $table->string('transport_delete')->nullable();
            $table->string('setting')->nullable();
            $table->string('setting_contact_info')->nullable();
            $table->string('setting_social_media_link')->nullable();
            $table->string('report')->nullable();
            $table->string('report_order')->nullable();
            $table->string('report_transport')->nullable();
            $table->string('role')->nullable();
            $table->string('role_create')->nullable();
            $table->string('role_edit')->nullable();
            $table->string('role_delete')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
