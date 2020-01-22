<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class CrearTablaPerfilesUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('perfiles_usuario', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nombrePerfil', 20);
            $table->string('descripcionPerfil');

            $table->timestamps();
            
        });

        $datos = array(
            array('nombrePerfil' => 'Registrado', 
                  'descripcionPerfil' => 'Usuario que se registró en el sistema.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombrePerfil' => 'Interesado', 
                  'descripcionPerfil' => 'Usuario que además de registrarse, presentó solicitud de préstamo.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombrePerfil' => 'Beneficiario', 
                  'descripcionPerfil' => 'Usuario registrado a quien se le aprobó su solicitud de crédito y/o está pagando un préstamo.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombrePerfil' => 'Cliente', 
                  'descripcionPerfil' => 'Usuario que ya pagó su préstamo y no tiene préstamos vigentes.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombrePerfil' => 'Directivo', 
                  'descripcionPerfil' => 'Personal administrativo con poder decisorio en temas relacionados con préstamos.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombrePerfil' => 'Inactivo', 
                  'descripcionPerfil' => 'Usuario que ha sido marcado manualmente en este estado.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
        );

        DB::table('perfiles_usuario')->insert($datos);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfiles_usuario');
    }
}
