<?php

namespace App\Repository;
use App\Repository\JogosRepository;
use App\Jogo_usuario;
use App\Jogo;

class UsuarioJogoRepository{


    public function vinculaUsuarioComJogo($game,$idUsuario){
        $jogoRepository = new JogosRepository;
        $jogoDB = $jogoRepository->findByPsnId($game->titleId());

        $verificaUsuarioJogo = Jogo_usuario::where([
            ['usuario_id ','=',$idUsuario],
            ['jogo_id','=',$jogoDB->id_jogos]
        ])->first();

        if($verificaUsuarioJogo == null){
            $arrayUsuarioJogo = [
                'usuario_id' => $idUsuario,
                'jogo_id' => $jogoDB->id_jogos
            ];
            $usuarioJogoSave = new Jogo_usuario($arrayUsuarioJogo);
            $usuarioJogoSave->save();
        }
    }
}
