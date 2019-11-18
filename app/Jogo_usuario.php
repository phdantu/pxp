<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jogo_usuario extends Model
{
    protected $primaryKey = 'id_jogo_usuario';
    protected $table = 'jogo_usuarios';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'usuario_id',
        'trofeu_id'
    ];
}
