<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class CrearTablaEstadosSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('estados_solicitud', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nombreEstado', 20);
            $table->string('descripcionEstado');
            
            $table->timestamps();
        
        });

        $datos = array(
            array('nombreEstado' => 'Presentada', 
                  'descripcionEstado' => 'Formulario diligenciado por primera vez. Puede estar completo o no con sus respectivos anexos.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'En estudio', 
                  'descripcionEstado' => 'Solicitud con documentación en estudio y pendiente de verificación.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Con pendientes', 
                  'descripcionEstado' => 'Solicitud pre-aprobada que requiere completar documentación o verificar información presentada.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Rechazada', 
                  'descripcionEstado' => 'Solicitud revisada y rechazada por no cumplimiento de los requisitos.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Aprobada', 
                  'descripcionEstado' => 'Solicitud aprobada con documentación completa y sin revisiones o verificaciones pendientes.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'Desembolsada', 
                  'descripcionEstado' => 'Solicitud con desembolso efectivo.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
            array('nombreEstado' => 'En espera', 
                  'descripcionEstado' => 'Solicitud aprobada con cumplimiento de requisitos. Queda en cola de espera para desembolso.', 
                  'created_at'=> Carbon::now(), 
                  'updated_at'=> Carbon::now()),
        );

        DB::table('estados_solicitud')->insert($datos);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados_solicitud');
    }
}
