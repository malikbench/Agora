<?php
use AGORA\Game\Socket\Game;

class AgustusGame extends Game {

    public function startGame($id) {
        $em = $this->getDoctrine()->getManager();
        $game = $em->getRepository("AugustusBundle:AugustusGame")->find($id);

        if ($game.isGameOver()) {
            return true;
        }
        //confirmation de nom
        $this->setToken($board.getBagOfToken().takeToken());

        $game.startGame($id);
    }

    public function isGameOver($id){
        foreach ($players as $player) {
            if (count($player.getDoneCards()) > 7) {
                return true;
            }
        }
        return false;
    }
}