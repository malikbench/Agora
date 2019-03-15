<?php
use AGORA\Game\Socket\Game;

class AgustusGame extends Game {

    public function __construct(EntityManager $em) {
        $this->manager = $em;
    }

    // donne une main de trois cartes à chaque joueur ainsi qu'un jeton sur le plateau
    public function initGame($id) {
        $games = $manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $game->setToken($game->$board->takeToken());
        // verifier
        if ($game->getToken() == "joker") {
            $game->$board->resetBag();
        }

        foreach ($game->getPlayers() as $player) {
            for ($i = 0; i < 3; $i++) {
             $player->addCard($game->$board->drawCard());
            }
        }

    }

    // pioche un token dans son sac, si ce jeton est le joker, remet tout dans le sac de token
    public function drawToken($id) {
        $games = $this->$manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $game->setToken($game->$board->takeToken());
        // verifier
        if ($game->getToken() == "joker") {
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

    // surement à deplacer dans le controleur
    // public function aveCesar($id, $player) {
    //     $games = $manager->getRepository("AugustusBundle:AugustusGame");
    //     $game = $games->findOneById($id)
        
    //     $cards = array();
    //     foreach ($player->objectif() as $card) {
    //         if ($card->toCapture() == 0) {
    //             array_push($cards, $card);
    //         }
    //     }
    //     foreach ($cards as $card) {
    //         $player->increaseLegion($card->captured);
    //         $card->doPower();
    //         $player->captureObj($card);
    //         $this->claimReward($player); //controlleur?
    //         //recuperation de l'objectif (controlleur)
    //         //pioche du nouvel objectif (controlleur)
    //     }
    // }

    // penser à verif qu'un autre joueur n'a pas la recompense a faire dans le controleur
    public function claimReward($id, $player) {
        $games = $this->$manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        
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
}