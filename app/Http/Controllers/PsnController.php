<?php

namespace App\Http\Controllers;

require_once '../vendor/autoload.php';

use App\Users;
use Illuminate\Http\Request;
use PlayStation\Client;
use App\Repository\JogosRepository;
use App\Repository\GrupoTrofeusRepository;
use App\Repository\TrofeusRepository;
use App\Repository\UsuarioTrofeuRepository;
use App\Usuario_trofeu;

//require_once '../app/Repository/trofeusRepository.php';

class PsnController extends Controller
{


    public function init(){
        $client = new Client();
        //                          v ticket_uuid                 v 2FA code
        //$client->login('fe0ce419-5c82-4215-90d0-47fca2df7081', '368689');
        //0dd6a99f-44a4-4ba1-9f0a-05abf69a84a4

        //dantu.ph
        //3dfe5e92-f1c5-40b6-8dd5-3f1ce762eb3d
        $user = Users::find(1);

        $client->login($user->uuid);
        $refreshToken = $client->refreshToken();

        $user->uuid = $refreshToken;
        $user->save();

        $games = $client->user()->games();
        //Quando pesquisa proprio objeto nao vem atributo comparedUser

        //$this::salvaJogosETrofeus($games);


        //$this::vinculaUsuarioComJogos($games);
        $usuarioTrofeuRepository = new UsuarioTrofeuRepository;
        $this::vinculaUsuarioComTrofeus($games,$usuarioTrofeuRepository);


        // Your games
        /* $games = $client->user()->games();
        foreach ($games as $game){
            $trophyGroups = $game->trophyGroups();
            $t = $trophyGroups[0]->trophies();
            //dd($t[15]->earnedDate());
            $i=0;
            foreach($t as $trophy){
                $trophies[$i] = $trophy;
                $i++;
            }
            dd($trophies);
            break;
            /* foreach ($trophyGroup->trophies() as $trophy) {
            foreach ($trophyGroups as $trophyGroup) {
                    $trophy->name();
                } */
                //}
            //}
        //dd($games);
    }

    private function salvaJogosETrofeus($games)
    {
        $jogosRepository = new JogosRepository;
        $trofeusRepository = new TrofeusRepository;
        $grupoJogoRepository = new GrupoTrofeusRepository;
        foreach ($games as $game) {
            if ($game->hasTrophies()) {

                if(!$this->enviaSalvaJogo($game,$jogosRepository)) //Se vier false, é pq falhou a persistencia
                {
                    //Fazer Log de jogo Salvo e if retorno for true, entao salvou, se false. ja existe
                }
                $trophyGroups = $game->trophyGroups();

                foreach ($trophyGroups as $trophyGroup) {
                    if(!$this->enviaSalvaGrupoJogo($trophyGroup,$game->titleId(),$grupoJogoRepository))//Se vier false, é pq falhou a persistencia
                    {
                        //Fazer Log de jogo Salvo e if retorno for true, entao salvou, se false. ja existe
                    }
                    $trofeusRepository->salvarTrofeus($trophyGroup->trophies(),$game->titleId(),$trophyGroup->group->trophyGroupId);
                }
            }
        }
    }
    public function vinculaUsuarioComTrofeus($games,$repository)
    {
        $idUser = 1;
        $trophyRepository = new TrofeusRepository;
        $gamesRepository = new JogosRepository;
        foreach ($games as $game) {
            if ($game->hasTrophies()) {
                $trophyGroups = $game->trophyGroups();
                $jogoBD = $gamesRepository->getJogoByIdPsn($game->titleId());

                foreach ($trophyGroups as $trophyGroup) {
                    $trophies = $trophyGroup->trophies();
                    foreach($trophies as $trophy)
                    {
                        dd($trophy);

                        if($trophy->trophy->comparedUser->earned){
                            $repository->vinculaUsuarioComTrofeu($trophyRepository->getTrofeuByNomeAndIdJogo($trophy->name(),$jogoBD->id_jogos),
                                                                $idUser,
                                                                $jogoBD);
                        }
                    }
                }
            }
        }
    }

    public function vinculaUsuarioComJogos($games,$repository)
    {
        $idUser = 1;
        foreach ($games as $game) {
            if ($game->hasTrophies()) {


                $trophyGroups = $game->trophyGroups();

                foreach ($trophyGroups as $trophyGroup) {
                    $repository->vinculaUsuarioComJogos($idUser, $game);
                }
            }
        }
    }

    /**
     * Envia o Jogo para persistir no BD.
     *
     * @param $jogo Game
     * @param $repositorio JogoRepository
     *
     * @return true se executar a persistencia sem erros
     * @return false se ocorrer algum erro na persistencia
     */
    public function enviaSalvaJogo($jogo,$repository): bool
    {
        $arrayJogo = [
            'jogo_id_psn' => $jogo->titleId(),
            'jogo_nome' => $jogo->name(),
            'jogo_detalhe' => $jogo->name(),
            'jogo_url_imagem' => $jogo->imageUrl(),
            'jogo_total_trofeus' => 0
        ];
        return $repository->salvarJogo($arrayJogo);
    }

    /**
     * Envia o GrupoTrofeu para persistir no BD.
     *
     * @param $grupoJogo TrophyGroup
     * @param $jogoPsnId Game->titleId()
     * @param #repository GrupoTrofeuRepository
     *
     * @return true se executar a persistencia sem erros
     * @return false se ocorrer algum erro na persistencia
     */
    public function enviaSalvaGrupoJogo($grupoJogo,$jogoPsnId,$repository): bool
    {
        return $repository->salvarTrofeuGrupo($grupoJogo,$jogoPsnId);
    }

}
