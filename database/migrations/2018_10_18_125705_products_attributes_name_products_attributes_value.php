<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsAttributesNameProductsAttributesValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_attributes_name_products_attributes_value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('products_attributes_name_id')->unsigned();
            $table->foreign('products_attributes_name_id', 'pan2_id_foreign')->references('id')->on('products_attributes_names');
            $table->integer('products_attributes_value_id')->unsigned();
            $table->foreign('products_attributes_value_id', 'pav2_id_foreign')->references('id')->on('products_attributes_values');
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
        Schema::dropIfExists('products_attributes_name_products_attributes_value');
    }
}
