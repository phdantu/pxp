<?php
namespace App\Repository;

use App\Jogo;

use DB;

class JogosRepository{

    public function jogoById($idJogo)
    {
        return Jogo::where('id_jogos',$idJogo);
    }

    public function salvarJogo(array $jogo) : bool
    {
        DB::enableQueryLog();
        try {
            $jogoSalvar = Jogo::firstOrCreate(['jogo_id_psn' => $jogo['jogo_id_psn']],$jogo);
            return true;
        } catch (\Throwable $th) {
            //LOGS
            return false;
        }
    }

    public function getJogoByIdPsn(string $idPsn)
    {
        return Jogo::where('jogo_id_psn',$idPsn)->first();
    }
}
