<?php
use AGORA\Game\Socket\Game;

class AgustusGame extends Game {

    public function startGame($id) {
        $em = $this->getDoctrine()->getManager();
        $game = $em->getRepository("AugustusBundle:AugustusGame")->find($id);

        if ($game->isGameOver()) {
            return true;
        }
        //confirmation de nom
        $this->setToken($board->getBagOfToken()->takeToken());

        $game->startGame($id);
    }

    public function drawToken() {
        $this->board->getBagOfToken()->takeToken();
    }

    public function allOk() {
        $ok = false;
        foreach ($this->players as $player) {
            $ok = $ok && $player->isLocked();
        }
        return $ok;
    }

    public function moveLegion($player,$source,$dest) {
        if (!$player->historique) {
            $player->putLegionFromSourceToDest($source, $this->token, $dest);
        }
    }

    public function aveCesar($player) {
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

    public function claimReward($player) {
        if(!$player->objAdvantage == 0) {
            $player->objAdvantage = count($player->ctrlObj());
        }
    }

    public function isGameOver($id){
        foreach ($this->players as $player) {
            if (count($player.getDoneCards()) > 7) {
                return true;
            }
        }
        return false;
    }
}