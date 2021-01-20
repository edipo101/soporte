<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nro_ticket')->unique();
            $table->integer('gestion');
            $table->integer('unidad_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('solicitante')->nullable();
            $table->string('telef_referencia');
            $table->string('celular_referencia');
            $table->integer('componente_id')->unsigned();
            $table->mediumText('observacion');
            $table->enum('prioridad',['normal','alta'])->default('normal');
            $table->enum('estado',['R','A','F'])->default('R');
            $table->datetime('fecha_asignada')->nullable();
            $table->datetime('fecha_entrega')->nullable();
            $table->string('empresa')->nullable();
            $table->enum('factura',['E','N'])->default('N')->nullable();
            $table->enum('ordencompra',['E','N'])->default('N')->nullable();
            $table->enum('garantia',['E','N'])->default('N')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('unidad_id')->references('id')->on('unidads')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('componente_id')->references('id')->on('componentes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tickets');
    }
}
