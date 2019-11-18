<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Repository\UsuarioRepository;

class UserController extends Controller
{
    public function primeiroLogin()
    {
        $valores = request()->all();
        request()->validate([
            'inputNome' => 'required',
            'inputEmail' => 'required',
            'inputSenha' => ['required','min:6'],
            'inputPsnLogin' => 'required',
            'inputUuid' => 'required',
            'input2SV' => ['required','size:6']
        ]);
        $uuid = $this->pegaTicketUuid($valores['inputUuid']);
        $arrayUser = [
            'name' => $valores['inputNome'],
            'email' => $valores['inputEmail'],
            'password' => Hash::make($valores['inputSenha']),
            'psnUser' => $valores['inputPsnLogin'],
            'uuid' => $uuid,
            '2sv' => $valores['2sv']
        ];
        $userRepository = new UsuarioRepository;
        $userRepository->inserir($arrayUser);


    }

    private function pegaTicketUuid($link): string
    {
        $stringBusca = "ticket_uuid=";
        return substr($link,strpos($link,$stringBusca)+12,36);
    }

}
