<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_sitio')->unsigned();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('valor');
            $table->timestamps();
            $table->foreign('id_sitio')
                ->references('id')
                ->on('sitios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('historial_pagos');
    }
}
