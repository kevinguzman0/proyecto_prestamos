<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTablaConfiguraciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla_configuraciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('IdConfiguracion', 4);
            $table->string('NombreConfiguracion', 100);
            $table->string('ValorConfiguracion');
            $table->string('DescripcionConfiguracion', 255);
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
        Schema::dropIfExists('tabla_configuraciones');
    }
}
