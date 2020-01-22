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
            $table->bigInteger('idCliente')->unsigned();
            $table->bigInteger('idEstadoSolicitud')->unsigned();
            $table->integer('monto');
            $table->integer('plazo');
            $table->decimal('cuota', 13, 4);
            $table->decimal('interes', 5, 2);
            $table->bigInteger('idAnalizadoPor')->unsigned();
            $table->dateTime('analizadoEn');

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
