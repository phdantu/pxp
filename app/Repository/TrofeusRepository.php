<?php
namespace App\Repository;

use App\Trofeu;
use App\Jogo;
use App\GrupoTrofeu;
use App\Repository\JogosRepository;


use DB;

class TrofeusRepository {



    public function __construct()
    {

    }

    public function salvarTrofeus(array $trofeus,$jogoPsnId,$trophyGroupIdPsn)
    {
        foreach($trofeus as $trofeu){
            $this::salvarSingleTrofeu($trofeu,$jogoPsnId,$trophyGroupIdPsn);
        }
    }


    public function salvarSingleTrofeu($trofeu,$jogoPsnId,$trophyGroupIdPsn)
    {
        DB::enableQueryLog();

        $gameBD = Jogo::where('jogo_id_psn',$jogoPsnId)->first();
        $trophyGroupBD = GrupoTrofeu::where([
            ['grupo_trofeu_id_psn','=',$trophyGroupIdPsn],
            ['jogos_id','=',$gameBD->id_jogos]])->first();

        $trofeuSalvar = Trofeu::where([
            ['trofeu_id_psn','=',$trofeu->trophy->trophyId],
            ['grupo_trofeu_id','=',$trophyGroupBD->id_grupo_trofeus],
            ['jogos_id','=',$gameBD->id_jogos]])->first();

        $queries = DB::getQueryLog();
        /* print_r($gameBD);
        print_r($trophyGroupBD);
        print_r($queries);
        dd($trofeuSalvar);
        dd($trofeuSalvar); */
        if($trofeuSalvar == null){
            $arrayAtributesTrofeu = [
                'trofeu_id_psn' => $trofeu->trophy->trophyId,
                'trofeu_nome' => $trofeu->trophy->trophyName,
                'trofeu_detalhe' => $trofeu->trophy->trophyDetail,
                'trofeu_tipo' => $trofeu->trophy->trophyType,
                'trofeu_oculto' => $trofeu->trophy->trophyHidden,
                'trofeu_taxa_ganho' => $trofeu->trophy->trophyEarnedRate,
                'trofeu_icone_url_xl' => $trofeu->trophy->trophyIconUrl,
                'trofeu_icone_url_s' => $trofeu->trophy->trophySmallIconUrl,
                'trofeu_raridade' => $trofeu->trophy->trophyRare,
                'grupo_trofeu_id' => $trophyGroupBD->id_grupo_trofeus,
                'jogos_id' => $gameBD->id_jogos
            ];

            $trofeuToSave = new Trofeu($arrayAtributesTrofeu);
            //dd($trofeuToSave);
            $trofeuToSave->save();
            try {
                return true;
            } catch (\Throwable $th) {
                //throw $th;
                return false;
            }

        }
    }

    public function getAllTrofeusByIdJogo($idJogo)
    {
        return Trofeu::where('jogos_id',$idJogo)->get();
    }

    public function getTrofeuByNomeAndIdJogo(string $nomeTrofeu, Int $jogoId)
    {
        return Trofeu::where([
            ['trofeu_nome','=', $nomeTrofeu],
            ['jogos_id','=', $jogoId]
        ])->first();
    }
}
