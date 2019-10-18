<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario_trofeu extends Model
{
    protected $primaryKey = 'id_usuario_trofeu';
    protected $table = 'usuarios_trofeus';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'trofeu_id',
        'usuario_id',
        'data_conquistou_trofeu'
    ];
}
