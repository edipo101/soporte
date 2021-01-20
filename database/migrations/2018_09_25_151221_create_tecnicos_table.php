<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto')->default('default.jpg');
            $table->string('carnet')->unique();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('cargo')->default('TECNICO DE SISTEMAS');
            $table->enum('titulo',['Tec.', 'Prof.', 'Ing.'])->default('Tec.');
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
        Schema::dropIfExists('tecnicos');
    }
}
