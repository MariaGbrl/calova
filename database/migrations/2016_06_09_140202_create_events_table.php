<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_event');
            $table->string('tgl_event');
            $table->string('organizer');
            $table->string('location');
            $table->longText('gambar_event');
            $table->longText('isi');
            $table->string('link');
            $table->string('deadline');
            $table->string('biaya');
            $table->longText('persyaratan');
            $table->integer('highlight');
            $table->string('type');
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
        Schema::drop('events');
    }
}
