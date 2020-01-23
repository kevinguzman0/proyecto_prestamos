<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPerfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles', function (Blueprint $table) {

            $table->bigInteger('id')->unsigned()->primary();            
            $table->bigInteger('idEstadoPerfil')->unsigned();
            $table->string('cedula', 15);
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('foto', 100);
            $table->string('email', 100);
            $table->string('telefono1', 15);
            $table->string('telefono2', 15);
            $table->date('fechaNacimiento');
            $table->string('direccion', 100);
            $table->string('barrio', 100);
            $table->string('ciudad', 45);
            $table->string('areaTrabajo', 100);
            $table->string('cargoTrabajo', 100);           
            $table->boolean('afiliadoFondo'); 
                      
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
        Schema::dropIfExists('perfiles');
    }
}
