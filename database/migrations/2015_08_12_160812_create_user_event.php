<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_event',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_event');

            // $table->foreign('id_user')->references('id')->on('users');
            // $table->foreign('id_event')->references('id')->on('event');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_event');
    }
}
