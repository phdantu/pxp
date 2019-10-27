<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    protected $primaryKey = 'id_jogos';
    protected $table = 'jogos';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

    }
    protected $fillable = [
        'jogo_id_psn',
        'jogo_nome',
        'jogo_detalhe',
        'jogo_url_imagem',
        'jogo_total_trofeus'
    ];
}
