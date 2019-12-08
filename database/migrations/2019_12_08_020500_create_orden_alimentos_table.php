<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_alimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha')->unique();
            $table->decimal('total_calorias',8,2);
            $table->decimal('total_carbohidratos',8,2);
            $table->decimal('total_grasas',8,2);
            $table->decimal('total_proteinas',8,2);
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
        Schema::dropIfExists('orden_alimentos');
    }
}
