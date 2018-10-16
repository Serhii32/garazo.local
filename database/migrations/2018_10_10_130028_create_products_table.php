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
            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->string('main_photo')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('most_saled')->unsigned()->default(0);
            $table->boolean('novelty')->default(0);
            $table->boolean('promo_action')->default(0);
            $table->boolean('best')->default(0);
            $table->string('titleSEO')->nullable();
            $table->text('descriptionSEO')->nullable();
            $table->string('keywordsSEO')->nullable();
            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('products_categories');
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
