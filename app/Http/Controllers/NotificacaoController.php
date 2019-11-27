<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\NotificacaoDesafio;
use App\Repository\JogosRepository;
use App\Repository\NotificacaoRepository;
use App\User;


class NotificacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function insert(Request $request)
    {
        $data = $request->all();
        $array = [
            'lida' => false,
            'usuarioDestino' => $data['pokeUserTo'],
            'usuarioRemetente' => $data['pokeUserFrom'],
            'jogos' => $data['pokeJogo']
        ];
        $repository = new NotificacaoRepository();
        $repository->insert($array);

        return view('success',['method' => "Desafio",'value' => $array]);
    }

    public function getByUser()
    {
        $repository = new NotificacaoRepository();
        $usuario = User::find(Auth::user()->id);
        $value = $repository->getAllById($usuario->psnUser);
        return view('challenges',['notif' => $value]);
    }

}
