<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id_usuarios');
            $table->string('usuario_login',50);
            $table->string('usuario_nome');
            $table->string('usuario_email')->unique();
            $table->timestamp('usuario_email_verified_at')->nullable();
            $table->string('password');
            $table->string('usuario_psn_login');
            $table->string('usuario_ticket_uuid');
            $table->integer('usuario_exp');
            $table->date('usuario_dt_nasc');
            $table->rememberToken();
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
        Schema::dropIfExists('usuarios');
    }
}
