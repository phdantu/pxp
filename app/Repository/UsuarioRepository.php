<?php

namespace App\Repository;

use App\User;

class UsuarioRepository{

    public function getUsuarioById($id): object
    {
        return User::where('id',$id)->first();
    }

    public function getUsuarioByLogin($login): object
    {
        return User::where('email',$login)->first();
    }

    public function getUserByPsnUser($psnUser): object
    {
        return User::where('psnUser',$psnUser)->first();
    }

}
