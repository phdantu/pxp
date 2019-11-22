<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacaoDesafiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacao_desafios', function (Blueprint $table) {
            $table->bigIncrements('id_notificacao');
            $table->boolean('lida')->default(false);
            $table->unsignedBigInteger('usuarioDestino');
            $table->foreign('usuarioDestino')->references('users')->on('id');
            $table->unsignedBigInteger('usuarioRemetente');
            $table->foreign('usuarioRemetente')->references('users')->on('id');
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
        Schema::dropIfExists('notificacao_desafios');
    }
}
