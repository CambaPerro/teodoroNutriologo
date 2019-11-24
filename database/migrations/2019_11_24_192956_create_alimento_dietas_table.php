<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentoDietasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimento_dietas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_dieta');
            $table->unsignedBigInteger('id_alimento');
            $table->foreign('id_dieta')->references('id')->on('dietas');
            $table->foreign('id_alimento')->references('id')->on('alimentos');
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
        Schema::dropIfExists('alimento_dietas');
    }
}
