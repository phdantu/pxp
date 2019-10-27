<?php
namespace App\Repository;

use App\Jogo;
use App\GrupoTrofeu;
use App\Repository\JogosRepository;

class GrupoTrofeusRepository{

    public function salvarTrofeuGrupo($trophyGroupId, string $idJogoPsn): bool
    {
        $jogo = Jogo::where('jogo_id_psn',$idJogoPsn)->first();
        $grupoTrofeu = GrupoTrofeu::where([
            ['grupo_trofeu_id_psn', '=', $trophyGroupId->group->trophyGroupId],
            ['jogos_id', '=', $jogo->id_jogos]])->first();

        if($grupoTrofeu == null){
            $trofeuGrupo = [
                'grupo_trofeu_id_psn' => $trophyGroupId->group->trophyGroupId,
                'grupo_trofeu_nome' => $trophyGroupId->group->trophyGroupName,
                'grupo_trofeu_detalhe' => $trophyGroupId->group->trophyGroupDetail,
                'grupo_trofeu_icone_url_xl' => $trophyGroupId->group->trophyGroupIconUrl,
                'grupo_trofeu_icone_url_s' => $trophyGroupId->group->trophyGroupSmallIconUrl,
                'jogos_id' => $jogo->id_jogos
            ];

            try {
                $grupoTrofeuSave = new GrupoTrofeu($trofeuGrupo);
                $grupoTrofeuSave->save();
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
        return true;
    }

    public function getGrupoTrofeuByIdJogo($idJogo): object
    {
        return GrupoTrofeu::where('jogos_id',$idJogo)->get();
    }

}
