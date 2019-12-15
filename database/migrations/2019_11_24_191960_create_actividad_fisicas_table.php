<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadFisicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_fisicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tipo')->nulable();
            $table->string('nombre',50);
            $table->string('descripcion',100);
            $table->decimal('calorias_quemadas',8,2);
            $table->foreign('id_tipo')->references('id')->on('tipo_actividads');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividad_fisicas');
    }
}
