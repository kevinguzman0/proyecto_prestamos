<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('monto');
            $table->integer('plazo');
            $table->decimal('cuota15', 13, 4);
            $table->decimal('cuota30', 13, 4);
            $table->decimal('tasa', 5, 2);
            $table->integer('idEstadoSolicitud')->unsigned();
            $table->foreign('idEstadoSolicitud')->references('id')->on('estado_solicitudes');
            $table->integer('idCliente')->unsigned();
            $table->foreign('idCliente')->references('id')->on('usuarios');
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
        Schema::dropIfExists('solicitudes');
    }
}
