<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogos', function (Blueprint $table) {
            $table->bigIncrements('id_jogos');
            $table->string('jogo_id_psn',15);
            $table->string('jogo_nome',150);
            $table->string('jogo_detalhe',500);
            $table->string('jogo_url_imagem',1000);
            $table->integer('jogo_total_trofeus');
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
        Schema::dropIfExists('jogos');
    }
}
