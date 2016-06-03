<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareerTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_tag',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_career_user');

            // $table->foreign('id_user')->references('id')->on('users');
            // $table->foreign('id_career_user')->references('id')->on('career_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('career_tag');
    }
}
