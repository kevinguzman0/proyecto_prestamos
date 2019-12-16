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
            $table->integer('idSolicitud', 11); 
            $table->integer('monto', 11);
            $table->integer('plazo', 3);
            $table->decimal('cuota15', 13, 4);
            $table->decimal('cuota30', 13, 4);
            $table->decimal('tasa', 5, 2);
            $table->integer('idEstadoSolicitud', 2)->unsigned();
            $table->foreign('idEstadoSolicitud')->references('id')->on('estado_solicitud');
            $table->integer('idCliente', 11)->unsigned();
            $table->foreign('idEstadoSolicitud')->references('id')->on('usuarios');
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
