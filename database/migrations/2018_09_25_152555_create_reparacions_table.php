<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReparacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_informe')->unique();
            $table->integer('ticket_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('asunto');
            $table->integer('gestion');
            $table->mediumText('caracteristicas');
            $table->mediumText('diagnostico');
            $table->mediumText('trabajo_realizado');
            $table->mediumText('recomendaciones');
            $table->datetime('fecha_informe')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('reparacions');
    }
}
