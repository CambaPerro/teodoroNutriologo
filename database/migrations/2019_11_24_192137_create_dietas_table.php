<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dietas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_nivel');
            $table->unsignedBigInteger('id_actividad')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('peso_ideal',8,2);
            $table->decimal('calorias',8,2);
            $table->decimal('imc',8,2);
            $table->string('tipo',20);
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_actividad')->references('id')->on('actividad_fisicas');
            $table->foreign('id_nivel')->references('id')->on('nivel_actividads');
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
        Schema::dropIfExists('dietas');
    }
}
