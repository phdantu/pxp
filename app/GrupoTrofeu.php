<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoTrofeu extends Model
{
    protected $primaryKey = 'id_grupo_trofeus';
    protected $table = 'grupo_trofeus';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'grupo_trofeu_id_psn',
        'grupo_trofeu_nome',
        'grupo_trofeu_detalhe',
        'grupo_trofeu_icone_url_xl',
        'grupo_trofeu_icone_url_s',
        'jogos_id'
    ];
}
