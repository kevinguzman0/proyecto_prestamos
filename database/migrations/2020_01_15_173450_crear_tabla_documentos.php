<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('idSolicitud')->unsigned();
            $table->bigInteger('idCliente')->unsigned();
            $table->string('documento', 100);
            $table->string('archivoOriginal');
            $table->string('descripcionDocumento');
            $table->boolean('revisado');
            $table->boolean('aprobado'); 
            $table->bigInteger('idAnalizadoPor')->unsigned()->nullable();
            $table->dateTime('analizadoEn')->nullable();

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
        Schema::dropIfExists('documentos');
    }
}
