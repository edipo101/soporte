<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unidad');
            $table->string('funcionario');
            $table->string('cargo');
            $table->string('ipv4')->unique();
            $table->string('nombrepc')->nullable();
            $table->string('mac');
            $table->boolean('internet')->nullable();
            $table->boolean('sigma')->nullable();
            $table->boolean('sigep')->nullable();
            $table->string('redimpresora')->nullable();
            $table->enum('estado',['N','O'])->default('N');
            $table->mediumText('observacion')->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('direccions');
    }
}
