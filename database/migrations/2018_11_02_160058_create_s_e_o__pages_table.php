<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSEOPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_e_o__pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page');
            $table->string('titleSEO')->nullable();
            $table->text('descriptionSEO')->nullable();
            $table->string('keywordsSEO')->nullable();
            $table->timestamps();
        });
        Artisan::call('db:seed', ['--class' => PagesTableSeeder::class,]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_e_o__pages');
    }
}
