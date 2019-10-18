<?php

namespace App\Repository;

use App\Repository\Usuario;
use App\Repository\Trofeu;
use App\Repository\Jogo;
use App\Repository\Usuario_trofeu;

class UsuarioTrofeuRepository{

    public function vinculaUsuarioComTrofeu($trofeu,$idUsuario,$jogo)
    {
        $verificaUsuarioTrofeu = Usuario_trofeu::where([
            ['trofeu_id','=',$trofeu->id_trofeus],
            ['usuario_id','=',$idUsuario]
        ])->first();

        if($verificaUsuarioTrofeu == null){
            $trofeuBD = Trofeu::where([
                ['trofeu_nome','=',$trofeu->trofeu_nome],
                ['jogos_id','=',$jogo->id_jogos]
            ]);
            $arrayUsuarioTrofeu = [
                'trofeu_id' => $trofeu,
                'usuario_id' => $idUsuario,
                'data_conquistou_trofeu' => $trofeu->earnedDate()
            ];
            dd($arrayUsuarioTrofeu);
            $usuarioTrofeuSave = new Usuario_trofeu($arrayUsuarioTrofeu);
            $usuarioTrofeuSave->save();
        }
    }

    public function vinculaUsuarioComTrofeus($trofeus,$idUsuario,$jogo)
    {
        foreach($trofeus as $trophy)
        {
            $this->vinculaUsuarioComTrofeu($trophy,$idUsuario,$jogo);
        }
    }
}
