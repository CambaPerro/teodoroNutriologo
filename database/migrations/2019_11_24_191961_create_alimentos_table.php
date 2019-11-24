<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_orden');
            $table->unsignedBigInteger('id_categoria');
            $table->string('nombre',50);
            $table->string('porcion',50);
            $table->decimal('calorias',8,2);
            $table->decimal('carbohidratos',8,2);
            $table->decimal('grasas',8,2);
            $table->decimal('proteinas',8,2);
            $table->foreign('id_orden')->references('id')->on('orden_alilmeticios');
            $table->foreign('id_categoria')->references('id')->on('categoria_alimentos');
            
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
        Schema::dropIfExists('alimentos');
    }
}
