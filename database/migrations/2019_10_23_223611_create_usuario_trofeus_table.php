<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTrofeusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_trofeus', function (Blueprint $table) {
            $table->bigIncrements('id_usuario_trofeu');
            $table->unsignedBigInteger('trofeu_id');
            $table->foreign('trofeu_id')->references('id_trofeus')->on('trofeus');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id_usuarios')->on('usuarios');
            $table->dateTime('data_conquistou_trofeu');
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
        Schema::dropIfExists('usuario_trofeus');
    }
}
