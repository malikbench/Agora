<?php

namespace AGORA\Game\AugustusBundle\Service;

use AGORA\Game\AugustusBundle\Model\AugustusGameModel

class AugustusService
{

    protected $manager;
    public $gameModel;
    public $playerModel;
    public $boardModel;

    // $em est passé en argument dans services.yml
    public function __construct(EntityManager $em) {
        $this->manager = $em;

        $this->gameModel = new AugustusGameModel($em);
        $this->playerModel = new AugustusPlayerModel($em);
        $this->boardModel = new AugustusGameModel($em);
    }


    public function createRoom($name, $nbPlayers, $isPrivate, $password) {
        $this->gameModel->createGame($name, $nbPlayers, $isPrivate, $password);
    }



    //Fonction qui récupere le jeu en bdd
    public function getGame($gameId) {
        $game = $this->manager
            ->getRepository('AugustusBundle:AugustusGame')
            ->find($gameId);
        return $game;
    }

    
    public function createPlayer($user, $gameId) {
        $this->playerModel->createPlayer($user, $gameId);
    }
    

}