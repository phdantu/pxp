<?php

namespace App\Repository;

use App\Usuario_trofeu;

class UsuarioTrofeuRepository{

    public function vinculaUsuarioComTrofeu($trofeuDb,$trofeuPsn,$idUsuario,$jogo)
    {

        $verificaUsuarioTrofeu = Usuario_trofeu::where([
            ['trofeu_id','=',$trofeuDb->id_trofeus],
            ['usuario_id','=',$idUsuario]
        ])->first();

        if($verificaUsuarioTrofeu == null){
            $arrayUsuarioTrofeu = [
                'trofeu_id' => $trofeuDb->id_trofeus,
                'usuario_id' => $idUsuario,
                'data_conquistou_trofeu' => $trofeuPsn->earnedDate()
            ];
            $usuarioTrofeuSave = new Usuario_trofeu($arrayUsuarioTrofeu);
            $usuarioTrofeuSave->save();
        }
    }

    public function vinculaUsuarioComTrofeus($trofeus,$idUsuario,$jogo)
    {
        foreach($trofeus as $trophy)
        {
            //$this->vinculaUsuarioComTrofeu($trophy,$idUsuario,$jogo);
        }
    }
}
