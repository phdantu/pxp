<?php

namespace PlayStation\Api;

use PlayStation\Client;

use PlayStation\Api\User;
use PlayStation\Api\Trophy;

class Game extends AbstractApi
{

    const GAME_ENDPOINT = 'https://gamelist.api.playstation.com/v1/';

    private $titleId;
    private $npCommunicationId;
    public $game;
    private $user;

    /**
     * New instance of Api\Game.
     *
     * @param Client $client
     * @param string $titleId
     * @param User $user
     */
    public function __construct(Client $client, string $titleId, User $user = null)
    {
        parent::__construct($client);

        $this->titleId = $titleId;
        $this->user = $user;
    }

    /**
     * Gets the title ID for the Game.
     *
     * @return string
     */
    public function titleId() : string
    {
        return $this->titleId;
    }

    /**
     * Gets the name of the Game's trophy set.
     *
     * @return string
     */
    public function name() : string
    {
        return $this->trophyInfo()->trophyTitleName ?? '';
    }

    /**
     * Gets the Game's image URL.
     *
     * @return string
     */
    public function imageUrl() : string
    {
        return $this->trophyInfo()->trophyTitleIconUrl ?? '';
    }

    /**
     * Gets the Game's NP communication ID.
     *
     * @return string
     */
    public function communicationId() : string
    {
        return $this->trophyInfo()->npCommunicationId ?? '';
    }

    /**
     * Checks if the Game has trophies.
     *
     * @return boolean
     */
    public function hasTrophies() : bool
    {
        return ($this->trophyInfo() !== null);
    }

    /**
     * Checks if the User has earned the platinum trophy.
     *
     * @return boolean
     */
    public function earnedPlatinum() : bool
    {
        if (
            $this->trophyInfo() === null ||
            !isset($this->trophyInfo()->definedTrophies->platinum) ||
            !$this->trophyInfo()->definedTrophies->platinum
        ) {
            return false;
        }

        $user = $this->userTrophyInfo();

        return ($user === false) ? false : boolval($user->earnedTrophies->platinum);
    }

    /**
     * Gets the trophy information for the Game.
     *
     * @return object|null
     */
    public function trophyInfo() : ?object
    {
        if ($this->game === null) {
            // Kind of a hack here.
            // This endpoint doesn't give exactly the same information as the proper Game endpoint would,
            // But I wasn't able to find a way to get info from the Game endpoint with just a titleId.
            // It works, but I'd rather it be more consistent with the other endpoint.
            $game = $this->get(Trophy::TROPHY_ENDPOINT . 'apps/trophyTitles', [
                'npTitleIds' => $this->titleId,
                'fields' => '@default',
                'npLanguage' => 'en'
            ]);

            if (!count($game->apps) || !count($game->apps[0]->trophyTitles)) return null;

            $this->npCommunicationId = $game->apps[0]->trophyTitles[0]->npCommunicationId;

            $data = [
                'npLanguage' => 'en'
            ];

            if ($this->isComparing()) {
                $data['comparedUser'] = $this->user()->onlineId();
            }

            $game = $this->get(sprintf(Trophy::TROPHY_ENDPOINT . 'trophyTitles/%s', $this->npCommunicationId), $data);

            if ($game->totalResults !== 1 || !count($game->trophyTitles)) return null;

            $this->game = $game->trophyTitles[0];
        }

        return $this->game;
    }


    /**
     * Gets the Users who have played this game.
     *
     * @return array Array of Api\User.
     */
    public function players() : array
    {
        $returnPlayers = [];

        $players = $this->get(sprintf(self::GAME_ENDPOINT . 'titles/%s/players', $this->titleId));

        if ($players->size === 0) return $returnPlayers;

        foreach ($players->data as $player) {
            $returnPlayers[] = new User($this->client, $player->onlineId);
        }

        return $returnPlayers;
    }

    /**
     * Gets the TrophyGroups for this Game.
     *
     * @return array Array of Api\TrophyGroup
     */
    public function trophyGroups() : array
    {
        $returnGroups = [];

        $data = [
            'fields' => '@default,trophyTitleSmallIconUrl,trophyGroupSmallIconUrl',
            'iconSize' => 'm',
            'npLanguage' => 'en'
        ];

        if ($this->isComparing()) {
            $data['comparedUser'] = $this->user()->onlineId();
        }

        $groups = $this->get(sprintf(Trophy::TROPHY_ENDPOINT . 'trophyTitles/%s/trophyGroups', $this->communicationId()), $data);

        foreach ($groups->trophyGroups as $group) {
            $returnGroups[] = new TrophyGroup($this->client, $group, $this);
        }

        return $returnGroups;
    }


    /**
     * Gets all Trophies for this Game.
     *
     * @return array Array of Api\Trophy
     */
    public function trophies() : array
    {
        $returnTrophies = [];

        $data = [
            'fields' => '@default,trophyRare,trophyEarnedRate,hasTrophyGroups,trophySmallIconUrl',
            'iconSize' => 'm',
            'visibleType' => 1,
            'npLanguage' => 'en'
        ];

        if ($this->isComparing()) {
            $data['comparedUser'] = $this->user()->onlineId();
        }

        $trophies = $this->get(sprintf(Trophy::TROPHY_ENDPOINT . 'trophyTitles/%s/trophyGroups/all/trophies', $this->communicationId()), $data);

        foreach ($trophies->trophies as $trophy) {
            $returnTrophies[] = new Trophy($this->client, $trophy, $this);
        }

        return $returnTrophies;
    }


    /**
     * Gets the User who played this game.
     *
     * @return User
     */
    public function user() : ?User
    {
        return $this->user;
    }

    /**
     * Gets whether we're getting trophies for the logged in User or another User.
     *
     * @return boolean
     */
    public function isComparing() : bool
    {
        if ($this->user() === null) {
            return false;
        }

        return ($this->user()->onlineId() !== null);
    }

    /**
     * Gets whether the User has played the game or not.
     *
     * @return boolean
     */
    public function hasPlayed() : bool
    {
        return boolval($this->userTrophyInfo());
    }

    /**
     * Gets the trophy information from the user that is being compared to.
     *
     * @return object|null
     */
    private function comparedUserTrophyInfo() : ?object
    {
        return isset($this->trophyInfo()->comparedUser) ? $this->trophyInfo()->comparedUser : null;
    }

    /**
     * Gets the trophy information from the user that is logged in to the api.
     *
     * @return object|null
     */
    private function fromUserTrophyInfo() : ?object
    {
        return isset($this->trophyInfo()->fromUser) ? $this->trophyInfo()->fromUser : null;
    }

    /**
     * Gets the trophy information for the active user. When a compared user is set, the trophy information for the
     * compared user will be returned, otherwise the trophy information for the from user (user that is logged in to
     * the API) will be returned.
     *
     * @return object|null
     */
    public function userTrophyInfo() : ?object
    {
        $comparedUserTrophyInfo = $this->comparedUserTrophyInfo();
        $fromUserTrophyInfo = $this->fromUserTrophyInfo();

        if ($this->isComparing() && $comparedUserTrophyInfo) {
            return $comparedUserTrophyInfo;
        } else if ($fromUserTrophyInfo) {
            return $fromUserTrophyInfo;
        }

        return null;
    }

    public function definedTrophies(): array
    {
        $trophies = [
            'bronze' => $this->game->definedTrophies->bronze,
            'silver' => $this->game->definedTrophies->silver,
            'gold' => $this->game->definedTrophies->gold,
            'platinum' => $this->game->definedTrophies->platinum,
        ];
        return $trophies;
    }

    public function getEarnedTrophies(): int
    {
        $earnedCount = 0;
        $trophyGroups = $this->trophyGroups();
        foreach($trophyGroups as $tg){
            foreach($tg->trophies('en') as $trophy){
                if($trophy->earned()){
                    $earnedCount++;
                }
            }
        }
        return $earnedCount;
    }

    public function getPercentual(): string
    {
        $earned = $this->getEarnedTrophies();
        $totalSeparated = $this->definedTrophies();
        $total = $totalSeparated['bronze']+$totalSeparated['silver']+$totalSeparated['gold']+$totalSeparated['platinum'];
        return number_format(($earned/$total)*100,2,'.','');
    }
}
