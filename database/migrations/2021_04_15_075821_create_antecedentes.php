<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
            $table->boolean('activos');
            $table->string('tipo');
            $table->string('nombre');
            $table->unsignedBigInteger('idusuario');
            $table->foreign('idusuario', 'fk_antecedentes_usuarios')
            ->on('usuarios')
            ->references('id')
            ->onDelete('restrict');
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
        Schema::dropIfExists('antecedentes');
    }
}
