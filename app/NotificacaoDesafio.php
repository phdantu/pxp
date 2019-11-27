<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacaoDesafio extends Model
{
    protected $primaryKey = 'id_notificacao';
    protected $table = 'notificacao_desafios';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'lida',
        'usuarioDestino',
        'usuarioRemetente',
        'jogos'
    ];
}
