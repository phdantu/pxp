<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrofeusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trofeus', function (Blueprint $table) {
            $table->bigIncrements('id_trofeus');
            $table->bigInteger('trofeu_id_psn');
            $table->string('trofeu_nome');
            $table->string('trofeu_detalhe');
            $table->string('trofeu_tipo');
            $table->boolean('trofeu_oculto');
            $table->string('trofeu_taxa_ganho');
            $table->string('trofeu_icone_url_xl');
            $table->string('trofeu_icone_url_s');
            $table->integer('trofeu_raridade');
            $table->unsignedBigInteger('grupo_trofeu_id');
            $table->foreign('grupo_trofeu_id')->references('id_grupo_trofeus')->on('grupo_trofeus');
            $table->unsignedBigInteger('jogos_id');
            $table->foreign('jogos_id')->references('jogos_id')->on('grupo_trofeus');
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
        Schema::dropIfExists('trofeus');
    }
}
