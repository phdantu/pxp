<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $primaryKey = 'id_usuarios';
    protected $table = 'usuarios';

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
