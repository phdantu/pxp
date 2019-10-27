<?php

namespace App\Repository;

use App\Usuario;

class UsuarioRepository{

    public function getUsuarioById($id): object
    {
        return Usuario::where('id_usuarios',$id)->first();
    }

    public function getUsuarioByLogin($login): object
    {
        return Usuario::where('login_usuarios',$login)->first();
    }
}
