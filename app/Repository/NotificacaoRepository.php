<?php

namespace App\Repository;

use App\NotificacaoDesafio;
use DB;

class NotificacaoRepository{

    public function insert(array $notificacao)
    {
        $notif = new NotificacaoDesafio($notificacao);
        $notif->save();
    }

    /* public function get(): array
    {
        return $array[];
    } */

    public function getAllById($idUser)
    {
        return NotificacaoDesafio::where('usuarioDestino',$idUser)->get();
    }

    public function editToRead(NotificacaoDesafio $notificacao)
    {
        $notificacao = NotificacaoDesafio::where('id_notificacao',$notificacao->id_notificacao);

        $notificacao->lida = true;
        $notificacao->save();

    }
}
