<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternoServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('externo_servicio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('externo_id')->unsigned();
            $table->integer('servicio_id')->unsigned();
            $table->timestamps();

            $table->foreign('externo_id')->references('id')->on('externos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('externo_servicio');
    }
}
