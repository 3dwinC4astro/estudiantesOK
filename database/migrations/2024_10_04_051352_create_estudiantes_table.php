<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id(); // ID auto-incremental
            $table->string('nombre'); // Nombre del estudiante
            $table->string('apellidos'); // Apellidos del estudiante
            $table->string('celular'); // Celular del estudiante
            $table->string('correo')->unique(); // Email único del estudiante
            $table->string('programa'); // Programa académico
            $table->integer('semestre'); // Semestre del estudiante
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}
