<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('externos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('unidad_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->mediumText('descripcion');
            $table->datetime('fecha_elaboracion');
            $table->datetime('fecha_entrega');
            $table->enum('estado',['E','R','F'])->default('E');
            $table->timestamps();

             $table->foreign('unidad_id')->references('id')->on('unidads')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('externos');
    }
}
