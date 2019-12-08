<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ordens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_orden');
            $table->unsignedBigInteger('id_alimento');
            $table->foreign('id_orden')->references('id')->on('orden_alimentos');
            $table->foreign('id_alimento')->references('id')->on('detalle_alimentos');
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
        Schema::dropIfExists('detalle_ordens');
    }
}
