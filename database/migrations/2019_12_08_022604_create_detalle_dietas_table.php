<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleDietasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_dietas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_dieta');
            $table->unsignedBigInteger('id_orden');
            $table->boolean('estado')->default(1);
            $table->foreign('id_dieta')->references('id')->on('dietas');
            $table->foreign('id_orden')->references('id')->on('orden_alimentos');
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
        Schema::dropIfExists('detalle_dietas');
    }
}
