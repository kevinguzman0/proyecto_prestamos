<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class CrearTablaEstadosPerfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('estados_perfil', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nombreEstado', 20);
            $table->string('descripcionEstado');

            $table->timestamps();
            
        });

        $datos = array(
            array('nombreEstado' => 'Registrado', 
                  'descripcionEstado' => 'Usuario que se registró en el sistema.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Interesado', 
                  'descripcionEstado' => 'Usuario que presentó solicitud de crédito.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Cliente', 
                  'descripcionEstado' => 'Usuario que tiene o tuvo vigente algún(os) préstamo(s).', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Directivo', 
                  'descripcionEstado' => 'Personal administrativo con poder decisorio en temas relacionados con solicitudes y préstamos.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Inactivo', 
                  'descripcionEstado' => 'Usuario que ha sido marcado manualmente en este estado.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
        );

        DB::table('estados_perfil')->insert($datos);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados_perfil');
    }
}
