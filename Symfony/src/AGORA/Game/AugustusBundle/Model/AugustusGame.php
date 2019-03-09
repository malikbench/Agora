<?php
use AGORA\Game\Socket\Game;

class AgustusGame extends Game {

    public function __construct(EntityManager $em) {
        $this->manager = $em;
    }

    // public function startGame($id) {
    //     $games = $manager->getRepository("AugustusBundle:AugustusGame");
    //     $game = $games->findOneById($id)

    //     if ($game->isGameOver()) {
    //         return true;
    //     }
    //     //confirmation de nom
    //     $this->setToken($board->getBagOfToken()->takeToken());

    //     $game->startGame($id);
    // }

    // pioche un token dans son sac, si ce jeton est le joker, remet tout dans le sac de token
    public function drawToken($id) {
        $games = $manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $game->setToken($game->$board->takeToken());
        // verif
        if ($game->getToken() == "joker") {
            $game->$board->resetBag();
        }
    }

    // verifie que tous les joueurs ont vérouillé leur tour
    public function allOk($id) {
        $games = $manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $ok = false;
        // player = objet ou id?
        foreach ($game->getPlayers() as $player) {
            $ok = $ok && $player->getIsLock();
        }
        return $ok;
    }

    public function moveLegion($id,$playerId,$source,$dest) {
        $games = $manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        
        $players = $manager->getRepository('AugustusBundle:AugustusPlayer');
        $player = $players->findOneById($playerId);
        
        if (!$player->getHistory()) {
            // grosse verif a faire en fonction du reel mouvement
            $player->putLegionFromSourceToDest($source, $game->getToken(), $dest);
        }
    }

    public function aveCesar($id, $player) {
        $games = $manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id)
        
        $cards = array();
        foreach ($player->objectif() as $card) {
            if ($card->toCapture() == 0) {
                array_push($cards, $card);
            }
        }
        foreach ($cards as $card) {
            $player->increaseLegion($card->captured);
            $card->doPower();
            $player->captureObj($card);
            $this->claimReward($player); //controlleur?
            //recuperation de l'objectif (controlleur)
            //pioche du nouvel objectif (controlleur)
        }
    }

    // verif a faire dans le controleur
    public function claimReward($id, $player) {
        $games = $manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        
        if($player->getAdvantage() == 0) {
            $player->setAdvantage(count($player->ctrlObj()));
        }
    }

    public function isGameOver($id){
        $games = $manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id)
        
        foreach ($game->players as $player) {
            if (count($player.getDoneCards()) > 7) {
                return true;
            }
        }
        return false;
    }
}