<?php

namespace AGORA\Game\AugustusBundle\Service;

use AGORA\Game\AugustusBundle\Model\AugustusGameModel;
use AGORA\Game\AugustusBundle\Model\AugustusPlayerModel;

use Doctrine\ORM\EntityManager;


class AugustusService {

    protected $manager;
    public $gameModel;
    public $playerModel;
    public $boardModel;

    // $em est passé en argument dans services.yml
    public function __construct(EntityManager $em) {
        $this->manager = $em;

        $this->gameModel = new AugustusGameModel($em);
        $this->playerModel = new AugustusPlayerModel($em);
    }


    public function createRoom($name, $nbPlayers, $isPrivate, $password, $hostId) {
        $this->gameModel->createGame($name, $nbPlayers, $isPrivate, $password, $hostId);
    }



    //Fonction qui récupere le jeu en bdd
    public function getGame($gameId) {
        $game = $this->manager
            ->getRepository('AugustusBundle:AugustusGame')
            ->find($gameId);
        return $game;
    }

    //Fonction qui récupere le jeu en bdd
    public function getPlayer($user, $gameId) {
        $players = $this->$manager->getRepository('AugustusBundle:AugustusPlayer');
        $player = $players->findOneBy([
            'userId' => $user->getId(),
            'game' => $gameId,
        ]);
        return $player;
    }


    public function joinPlayer($user, $gameId) {
        $player = $this->getPlayer();

        if ($player == null) {
            return $this->playerModel->createPlayer($user->getId(), $gameId);
        }

        return $player->getId();
    }
    

}