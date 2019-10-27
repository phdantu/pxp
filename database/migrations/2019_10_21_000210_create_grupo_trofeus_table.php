<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoTrofeusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_trofeus', function (Blueprint $table) {
            $table->bigIncrements('id_grupo_trofeus');
            $table->string('grupo_trofeu_id_psn',200);
            $table->string('grupo_trofeu_nome',200);
            $table->string('grupo_trofeu_detalhe',300);
            $table->string('grupo_trofeu_icone_url_xl',700);
            $table->string('grupo_trofeu_icone_url_s',700);
            $table->unsignedBigInteger('jogos_id');
            $table->foreign('jogos_id')->references('id_jogos')->on('jogos');
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
        Schema::dropIfExists('grupo_trofeus');
    }
}
