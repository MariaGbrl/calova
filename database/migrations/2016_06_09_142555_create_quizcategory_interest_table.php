<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizcategoryInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizcategory_interest', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('interest_id')->unsigned();
            $table->foreign('interest_id')->references('id')->on('interests')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quizcategory_id')->unsigned();
            $table->foreign('quizcategory_id')->references('id')->on('quizcategory')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('quizcategory_interest');
    }
}
