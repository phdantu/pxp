<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trofeu extends Model
{
    protected $primaryKey = 'id_trofeus';
    protected $table = 'trofeus';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'trofeu_id_psn',
        'trofeu_nome',
        'trofeu_detalhe',
        'trofeu_tipo',
        'trofeu_oculto',
        'trofeu_taxa_ganho',
        'trofeu_icone_url_xl',
        'trofeu_icone_url_s',
        'trofeu_raridade',
        'grupo_trofeu_id',
        'jogos_id'
    ];
}
