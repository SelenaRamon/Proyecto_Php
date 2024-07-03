<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudianteGrupoTable extends Migration
{
    public function up()
    {
        Schema::create('estudiante_grupo', function (Blueprint $table) {
            $table->id();
            $table->integer('estudiante_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->timestamps();

            $table->foreign('estudiante_id')->references('id')->on('estudiante');
            $table->foreign('grupo_id')->references('id')->on('grupo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudiante_grupo');
    }
}
    