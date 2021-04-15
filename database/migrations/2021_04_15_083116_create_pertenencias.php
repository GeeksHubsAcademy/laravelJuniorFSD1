<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertenencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertenencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('idusuario');                
            $table->foreign('idusuario', 'fk_pertenencias_usuarios')
            ->on('usuarios')
            ->references('id')
            ->onDelete('restrict');
            $table->unsignedBigInteger('idgrupo');                  
            $table->foreign('idgrupo', 'fk_pertenencias_grupos')   
            ->on('grupos')
            ->references('id')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertenencias');
    }
}
