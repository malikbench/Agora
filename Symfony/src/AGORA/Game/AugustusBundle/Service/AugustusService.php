<?php

namespace AGORA\Game\AugustusBundle\Service;

use AGORA\Game\AugustusBundle\Model\AugustusGameModel;
use AGORA\Game\AugustusBundle\Model\AugustusPlayerModel;

use Doctrine\ORM\EntityManager;


class AugustusService {

    protected $manager;
    public $gameModel;
    public $playerModel;

    // $em est passé en argument dans services.yml
    public function __construct(EntityManager $em) {
        $this->manager = $em;

        $this->gameModel = new AugustusGameModel($em);
        $this->playerModel = new AugustusPlayerModel($em);
    }


    public function createRoom($name, $nbPlayers, $isPrivate, $password, $hostId) {
        return $this->gameModel->createGame($name, $nbPlayers, $isPrivate, $password, $hostId);
    }



    //Fonction qui récupere le jeu en bdd
    public function getGame($gameId) {
        $game = $this->manager
            ->getRepository('AugustusBundle:AugustusGame')
            ->find($gameId);
        return $game;
    }

    //Fonction qui récupere le jeu en bdd
    public function getPlayerFromUser($user, $gameId) {
        $players = $this->manager->getRepository('AugustusBundle:AugustusPlayer');
        $player = $players->findOneBy([
            'userId' => $user->getId(),
            'game' => $this->getGame($gameId),
        ]);
        return $player;
    }

    public function getPlayerFromId($playerId, $gameId) {
        $players = $this->manager->getRepository('AugustusBundle:AugustusPlayer');
        $player = $players->findOneBy([
            'id' => $playerId
        ]);
        return $player;
    }

    public function getPlayers($gameId) {
        return $this->getGame($gameId)->getPlayers();
    }

    public function areAllPlayersReady($gameId) {
        return $this->gameModel->allOk($gameId);
    }


    public function joinPlayer($user, $gameId) {
        $player = $this->getPlayerFromUser($user, $gameId);

        if ($player == null) {
            return $this->playerModel->createPlayer($user->getId(), $gameId);
        }

        return $player->getId();
    }
    

}