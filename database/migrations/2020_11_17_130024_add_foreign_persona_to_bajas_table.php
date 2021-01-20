<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignPersonaToBajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bajas', function (Blueprint $table) {
            $table->mediumText('observacion_fecha')->nullable;
            $table->datetime('fecha_solicitud')->nullable();
            $table->integer('funcionario_id')->unsigned()->nullable();
            $table->integer('userfecha')->unsigned()->nullable();

            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('userfecha')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bajas', function (Blueprint $table) {
            $table->dropColumn('fecha_solicitud');
            $table->dropColumn('observacion_fecha');
            $table->dropColumn('funcionario_id');
            $table->dropColumn('userfecha');
        });
    }
}
