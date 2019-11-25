<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_alimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_orden');
            $table->unsignedBigInteger('id_alimento');
            $table->decimal('cantidad',8,2);
            $table->string('porcion',10);
            $table->foreign('id_orden')->references('id')->on('orden_alimenticios');
            $table->foreign('id_alimento')->references('id')->on('alimentos');
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
        Schema::dropIfExists('detalle_alimentos');
    }
}
