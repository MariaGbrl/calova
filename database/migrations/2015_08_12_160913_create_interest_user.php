<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_user',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_interest_tag');

            // $table->foreign('id_user')->references('id')->on('users');
            // $table->foreign('id_interest_tag')->references('id')->on('interest_tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('interest_user');
    }
}
