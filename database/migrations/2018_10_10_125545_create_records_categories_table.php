<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->string('titleSEO')->nullable();
            $table->text('descriptionSEO')->nullable();
            $table->string('keywordsSEO')->nullable();
            $table->string('photo')->nullable();
            $table->integer('parent_id')->default(0);
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
        Schema::dropIfExists('records_categories');
    }
}
