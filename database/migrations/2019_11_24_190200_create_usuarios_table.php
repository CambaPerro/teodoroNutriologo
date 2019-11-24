<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email',50)->unique();
            $table->string('password',50);
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->date('fecha_nacimiento');
            $table->decimal('altura',8,2);
            $table->decimal('peso',8,2);
            $table->string('sexo',10);
            $table->string('tipo',10);
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
        Schema::dropIfExists('usuarios');
    }
}
