<?php
use AGORA\Game\AugustusBundel\Entity\AugustusGame;
use AGORA\Game\GameBundle\Entity\Game;
use Doctrine\ORM\EntityManager;

class AugustusGameModel {

    protected $manager;

    public function __construct(EntityManager $em) {
        $this->manager = $em;
    }

    public function createGame($name, $nbPlayers, $isPrivate, $password, $hostId) {
        $augGame = new AugustusGame();
        /*
        TODO
        set les propriétés de l'entité Game
        */
        $this->manager->persist($augGame);
        $this->manager->flush();

        $game = new Game();
        $game->setGameId($augGame->getId());
        $gameInfoManager = $this->manager->getRepository('AGORAPlatformBundle:GameInfo');
        $gameInfo = $gameInfoManager->findOneBy(array('gameCode' => "aug"));
        $game->setGameInfoId($gameInfo);
        $game->setName($name);
        $game->setNbPlayers($nbPlayers);
        $game->setIdHost($hostId);
        $game->setPassword($password);
        $game->setPrivate($isPrivate);
        $game->setState("waiting");
        $game->setDateCrea(new \DateTime("now"));
        $this->manager->persist($game);
        $this->manager->flush();

        return $game->getId();
    }

    // donne une main de trois cartes à chaque joueur ainsi qu'un jeton sur le plateau
    public function initGame($id) {
        $games = $this->$manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $game->setToken($game->$board->takeToken());
        // verifier
        if ($game->getToken() == AugustusToken::Joker) {
            $game->$board->resetBag();
        }

        foreach ($game->getPlayers() as $player) {
            for ($i = 0; i < 3; $i++) {
             $player->addCard($game->$board->drawCard());
            }
        }
        $game->setState("legion");
        $this->manager->flush();
    }

    // pioche un token dans son sac, si ce jeton est le joker, remet tout dans le sac de token
    public function drawToken($id) {
        $games = $this->$manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $game->setToken($game->$board->takeToken());
        // verifier
        if ($game->getToken() == AugustusToken::JOKER) {
            $game->$board->resetBag();
        }
        $this->manager->flush();
    }

    // verifie que tous les joueurs ont vérouillé leur tour
    public function allOk($id) {
        $games = $this->$manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $ok = false;
        foreach ($game->getPlayers() as $player) {
            $ok = $ok && $player->getIsLock();
        }
        return $ok;
    }

    // utile?
    public function moveLegion($id,$playerId,$source,$dest) {
        $games = $this->$manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        
        $players = $this->$manager->getRepository('AugustusBundle:AugustusPlayer');
        $player = $players->findOneById($playerId);
        
        if (!$player->getHistory()) {
            // grosse modif a faire en fonction du reel mouvement
            $player->putLegionFromSourceToDest($source, $game->getToken(), $dest);
        }
        $this->manager->flush();
    }

    // penser à verif qu'un autre joueur n'a pas la recompense a faire dans le controleur
    public function claimReward($id, $playerId) {
        $games = $this->$manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $players = $this->$manager->getRepository("AugustusBundle:AugustusPlayer");
        $player = $players->findOneById($playerid);
        
        if($player->getAdvantage() == 0) {
            $player->setAdvantage(count($player->getCtrlCards()));
        }
        $this->manager->flush();
    }

    // verification que quelqu'un est arrivé à 7 carte controlé
    public function isGameOver($id){
        $games = $this->$manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        
        foreach ($game->getPlayers() as $player) {
            if (count($player->getCtrlCards()) > 7) {
                return true;
            }
        }
        return false;
    }

    // passe les parametre au jeu du prchain tour de jeu
    // public function applyStep($id) {
    //     $games = $this->$manager->getRepository("AugustusBundle:AugustusGame");
    //     $game = $games->findOneById($id);
        
    //     switch($game->getState()) {
    //         case "legion":
    //             if ($this->allOk($id)) {
    //                 $steps = $this->aveCesarSteps($id);
    //                 $states = $steps[0];
    //                 $affecteds = $steps[1];
    //                 $game->setState($steps[0]);
    //                 $game->setAffectedPlayer($affecteds[0]);
    //                 $game->setNextStates(array_slice($states, 1));
    //                 $game->setNextAffecteds(array_slice($affecteds, 1));
    //             }
    //         case "AveCesar":
    //             $this->getCapturableCardFromPlayer()
    //             // capture de la carte
    //             // recup du blé / or
    //             if ($states[0] == "AveCesar") {

    //             }
    //             if ($this->allOk($id)) {
    //                 $game->setState($game->getNextStates()[0]);
    //                 $game->setAffectedPlayer($game->getNextAffecteds()[0]);
    //                 $game->setNextStates(array_slice($game->getNextStates(), 1));
    //                 $game->setNextAffecteds(array_slice($game->getNextAffecteds(), 1));
    //             }     
    //     }

    //     $this->manager->flush();
    // }

    // calcul et renvoie un tableau avec l'ordre des joueurs pour la phase ave cesar
    public function aveCesarSteps($id) {
        $games = $this->$manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $states = array();
        $affecteds = array();
        
        $capturer = array();
        $index = array();
        foreach ($game->getPlayers() as $player) {
            foreach ($player->getCards() as $card) {    //remplacer par while
                if (count($card->getTokens()) == count($card->getCtrlTokens())) {
                    $capturer[$card->getNumber()] = $player->getId();
                    array_push($index, $card->getNumber());
                }
            }
        }
        sort($index);
        foreach ($index as $i) {
            array_push($states, "AveCesar");
            array_push($affecteds, $capturer[$i]);
            $card = $capturer->getCardByNumber($i);
            if ($card->getPower() == AugustusPower::TWOLEGIONONDOUBLESWORD ||
                $card->getPower() == AugustusPower::TWOLEGIONONTEACHES ||
                $card->getPower() == AugustusPower::TWOLEGIONONSHIELD ||
                $card->getPower() == AugustusPower::TWOLEGIONONKNIFE ||
                $card->getPower() == AugustusPower::ONECARD ||
                $card->getPower() == AugustusPower::REMOVEONELEGION ||
                $card->getPower() == AugustusPower::REMOVETWOLEGION ||
                $card->getPower() == AugustusPower::MOVELEGION ||
                $card->getPower() == AugustusPower::ONELEGIONONANYTHING ||
                $card->getPower() == AugustusPower::TWOLEGIONONCHARIOT ||
                $card->getPower() == AugustusPower::TWOLEGIONONCATAPULT ||
                $card->getPower() == AugustusPower::TWOLEGIONONANYTHING ||
                $card->getPower() == AugustusPower::REMOVEALLLEGION ||
                $card->getPower() == AugustusPower::REMOVEONECARD ||
                $card->getPower() == AugustusPower::COMPLETECARD) {
                    array_push($states, $card->getPower()->getPowerName($card->getPower()));
                    array_push($affecteds, $capturer[$i]);
            }
        }

        return array($states, $affecteds);
    }

    public function getCapturableCardFromPlayer($idPlayer) {
        $players = $this->$manager->getRepository("AugustusBundle:AugustusPlayer");
        $player = $players->findOneById($idPlayer);

        foreach ($player->getCards() as $card) {
            if (count($card->getTokens()) == count($card->getCtrlTokens())) {
                return $card;
            }
        }

        return null;
    }
}