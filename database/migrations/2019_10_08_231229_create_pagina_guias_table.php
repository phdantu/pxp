<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaginaGuiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagina_guias', function (Blueprint $table) {
            $table->bigIncrements('id_guia');
            $table->string('nome_guia', 200);
            $table->string('imagem_path', 200);
            $table->string('descricao_guia', 300);
            $table->string('link_guia', 200);
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
        Schema::dropIfExists('pagina_guias');
    }
}
