<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_interest', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('interest_id')->unsigned();
            $table->foreign('interest_id')->references('id')->on('interests')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('event_interest');
    }
}
