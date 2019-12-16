<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('perfilUsuario', 2)->unsigned();
            $table->foreign('perfilUsuario')->references('id')->on('perfiles_usuario');
            $table->string('cedula', 15);
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('foto', 100);
            $table->string('email', 100)->unique();
            $table->string('telefono1', 15);
            $table->string('telefono2', 15);
            $table->date('fechaNacimiento');
            $table->string('direccion', 100);
            $table->string('barrio', 100);
            $table->string('cuidad', 45);
            $table->string('areaTrabajo', 100);
            $table->string('cargoTrabajo', 100);           
            $table->date('fechaCreacion');
            $table->date('fechaModificacion');
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
        Schema::dropIfExists('usuarios');
    }
}
