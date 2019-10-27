<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJogoUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogo_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id_jogo_usuario');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id_usuarios')->on('usuarios');
            $table->unsignedBigInteger('jogo_id');
            $table->foreign('jogo_id')->references('id_jogos')->on('jogos');
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
        Schema::dropIfExists('jogo_usuarios');
    }
}
