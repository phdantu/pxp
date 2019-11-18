<?php

namespace App\Http\Controllers;

require_once '../vendor/autoload.php';

use App\Users;
use Auth;
use Illuminate\Http\Request;
use PlayStation\Client;
use App\Repository\JogosRepository;
use App\Repository\GrupoTrofeusRepository;
use App\Repository\TrofeusRepository;
use App\Repository\UsuarioJogoRepository;
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
        $me = $client->user()->onlineId();
        $user = $client->user();

        //Quando pesquisa proprio objeto nao vem atributo comparedUser
        ini_set('max_execution_time', 300);

        $this->salvaUserInfo($user);
        $this::salvaJogosETrofeus($games);

        $usuarioJogoRepository = new UsuarioJogoRepository;
        $this::vinculaUsuarioComJogos($games,$usuarioJogoRepository);
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

    public function primeiroAcesso()
    {
        $user = Users::find(Auth::user()->id);
        if(Auth::user()->primeiroacesso)
        {
            $client = new Client();
            $client->login(Auth::user()->uuid, Auth::user()->twosv);
            $refreshToken = $client->refreshToken();


            $user->uuid = $refreshToken;
            $user->primeiroacesso = false;
            $user->save();

            $userPSN = $client->user();
            $games = $userPSN->games();

        }else{

            $client = new Client();
            $client->login($user->uuid);
            $refreshToken = $client->refreshToken();
            $user->uuid = $refreshToken;
            $user->save();

            $userPSN = $client->user();
            $games = $userPSN->games(5);
        }
        return view('profile',['user' => $userPSN, 'games' => $games]);

    }

    private function salvaUserInfo($user)
    {
        //metodo para salvar informações da PSN referentes ao usuario
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
                    $trofeusRepository->salvarTrofeus($trophyGroup->trophies("en"),$game->titleId(),$trophyGroup->group->trophyGroupId);
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
                    $trophies = $trophyGroup->trophies("en");
                    foreach($trophies as $trophy)
                    {


                        if($trophy->earned()){
                            $trofeuRetorno = $trophyRepository->getTrofeuByNomeAndIdJogo($trophy->name(),$jogoBD->id_jogos);
                            if($trofeuRetorno == null){
                                dd($trophy);
                            }
                            $repository->vinculaUsuarioComTrofeu($trofeuRetorno,
                                                                $trophy,
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
                $repository->vinculaUsuarioComJogos($game,$idUser);
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
