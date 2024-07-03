<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaTable extends Migration
{
    public function up()
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->id();
            $table->integer('grupo_id');
            $table->integer('estudiante_id');
            $table->date('fecha');
            $table->time('hora_entrada')->nullable();
            $table->timestamps();

            $table->foreign('grupo_id')->references('id')->on('grupo');
            $table->foreign('estudiante_id')->references('id')->on('estudiante');
        });
    }

    public function down()
    {
        Schema::dropIfExists('asistencia');
    }
}

