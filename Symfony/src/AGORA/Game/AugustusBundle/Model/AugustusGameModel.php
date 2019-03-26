<?php

namespace AGORA\Game\AugustusBundle\Model;

use AGORA\Game\AugustusBundle\Entity\AugustusGame;
use AGORA\Game\AugustusBundle\Entity\AugustusPlayer;
use AGORA\Game\AugustusBundle\Entity\AugustusBoard;
use AGORA\Game\AugustusBundle\Entity\AugustusCard;
use AGORA\Game\AugustusBundle\Entity\AugustusToken;

use AGORA\Game\AugustusBundle\Model\AugustusBoardModel;

use AGORA\Game\GameBundle\Entity\Game;
use Doctrine\ORM\EntityManager;

class AugustusGameModel {

    protected $manager;
    public $boardModel;
    public $playerModel;

    public function __construct(EntityManager $em) {
        $this->manager = $em;

        $this->boardModel = new AugustusBoardModel($em);
        $this->playerModel = new AugustusPlayerModel($em);
    }

    public function createGame($name, $nbPlayers, $isPrivate, $password, $hostId) {
        $augGame = new AugustusGame();
        $augGame->setBoard(new AugustusBoard($augGame));
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

        return $augGame->getId();
    }

    // donne une main de trois cartes à chaque joueur ainsi qu'un jeton sur le plateau
    public function initGame($id) {
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $this->drawToken($id);

        foreach ($game->getPlayers() as $player) {
            for ($i = 0; $i < 3; $i++) {
                $player->addCard($this->boardModel->takeCard($game->getBoard()));
            }
        }
        $game->setState("legion");
        $this->manager->flush();
    }

    // pioche un token dans son sac, si ce jeton est le joker, remet tout dans le sac de token
    public function drawToken($id) {
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $game->setToken($this->boardModel->takeToken($game->getBoard()->getId()));
        if ($game->getToken() == AugustusToken::JOKER) {
            $this->boardModel->resetBag($game->getBoard());
        }
        $this->manager->flush();
    }

    // verifie que tous les joueurs ont vérouillé leur tour
    public function allOk($id) {
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $ok = false;
        foreach ($game->getPlayers() as $player) {
            $ok = $ok && $player->getIsLock();
        }
        return $ok;
    }

    // penser à verif qu'un autre joueur n'a pas la recompense a faire dans le controleur
    public function claimReward($id, $playerId) {
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        $players = $this->manager->getRepository("AugustusBundle:AugustusPlayer");
        $player = $players->findOneById($playerId);
        
        $advantage = count(($player->getCtrlCards()) - 1) * 2;
        foreach ($game->getPlayers() as $gamer) {
            if ($gamer->getAdvantage() == $advantage) {
                $advantage = 0;
            }
        }

        if ($player->getAdvantage() == 0 && $advantage != 0) {
            $player->setAdvantage($advantage);
        }
        $this->manager->flush();
    }

    // verification que quelqu'un est arrivé à 7 carte controlé
    public function isGameOver($id){
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        
        foreach ($game->getPlayers() as $player) {
            if (count($player->getCtrlCards()) > 7) {
                return true;
            }
        }
        return false;
    }

    // passe les parametre au jeu du prchain tour de jeu
    public function applyStep($id) {
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        
        switch($game->getState()) {
            case "legion":
                if ($this->allOk($id)) {
                    $steps = $this->aveCesarSteps($id);
                    $states = $steps[0];
                    $affecteds = $steps[1];
                    $game->setState($steps[0]);
                    $game->setAffectedPlayer($affecteds[0]);
                    $game->setNextStates(array_slice($states, 1));
                    $game->setNextAffecteds(array_slice($affecteds, 1));
                }
                break;
            case "AveCesar":
                $card = $this->getCapturableCardFromPlayer($game->getAffectedPlayer());
                $players = $this->manager->getRepository("AugustusBundle:AugustusPlayer");
                $players->captureCard($game->getAffectedPlayer(), $card->getId());
                $this->changeGoldOwner($id, $game->getAffectedPlayer());
                $this->changeWheatOwner($id, $game->getAffectedPlayer());
                if ($game->getState()[0] == "AveCesar") {
                    $card->doPower();
                }
                if ($players->getNbOfCardColor($card->getPlayer(), $card->getColor()) == 3) {
                    $this->fillColorLoot($id, $card->getPlayer(), $card->getColor());
                }
                if ($player->haveOneCardOfEach($card->getPlayer())) {
                    $this->fillColorLoot($id, $card->getPlayer(), "all");
                }
                $game->setState($game->getNextStates()[0]);
                $game->setAffectedPlayer($game->getNextAffecteds()[0]);
                $game->setNextStates(array_slice($game->getNextStates(), 1));
                $game->setNextAffecteds(array_slice($game->getNextAffecteds(), 1));
                break;
            case "waiting":
                $this->initGame($id);
                break;
            default:
                $this->nextStep($id);
                break;
        }

        $this->manager->flush();
    }

    // Utiliser pendant une phase ave cesar (applyStep)
    // Si le joueur actuel vient de récupérer une carte grace à un pouvoir
    // dans ce cas on met le pouvoir de celle-ci dans state
    // Sinon on passe au state suivant
    private function nextStep($id) {
        if ($this->allOk($id)) {
            $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
            $game = $games->findOneById($id);

            $card = getCapturableCardFromPlayer($game->getAffectedPlayer());
            if ($card) {                
                $players = $this->manager->getRepository("AugustusBundle:AugustusPlayer");
                $players->captureCard($game->getAffectedPlayer(), $card->getId());
                $this->changeGoldOwner($id, $game->getAffectedPlayer());
                $this->changeWheatOwner($id, $game->getAffectedPlayer());
                if ($players->getNbOfCardColor($card->getPlayer(), $card->getColor()) == 3) {
                    $this->fillColorLoot($id, $card->getPlayer(), $card->getColor());
                }
                if ($player->haveOneCardOfEach($card->getPlayer())) {
                    $this->fillColorLoot($id, $card->getPlayer(), "all");
                }
                if ($this->isPowerWithAction($card->getId())) {
                    $game->setState($card->getPower());
                } else {
                    $card->doPower();
                }
            } else {
                $game->setState($game->getNextStates()[0]);
                $game->setAffectedPlayer($game->getNextAffecteds()[0]);
                $game->setNextStates(array_slice($game->getNextStates(), 1));
                $game->setNextAffecteds(array_slice($game->getNextAffecteds(), 1));
            }
        }
        $this->manager->flush();
    }

    // calcul et renvoie un tableau à deux dimensions avec:
    // tableau[0] = la suite d'états à prendre pour la phase AveCesar
    // tableau[1] = la suite de joueurs qui "activerons" ces états
    private function aveCesarSteps($id) {
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);

        $states = array();
        $affecteds = array();
        
        $capturer = array();
        $index = array();
        foreach ($game->getPlayers() as $player) {
            foreach ($player->getCards() as $card) {
                if (count($card->getTokens()) == count($card->getCtrlTokens())) {
                    $capturer[$card->getNumber()] = $player->getId();
                    array_push($index, $card->getNumber());
                }
            }
        }
        sort($index);
        foreach ($index as $i) {
            array_push($states, "aveCesar");
            array_push($affecteds, $capturer[$i]);
            $card = $capturer->getCardByNumber($capturer[$i], $i);
            if ($this->isPowerWithAction($card->getId())) {
                    array_push($states, $card->getPower());
                    array_push($affecteds, $capturer[$i]);
            }
        }
        array_push($states, "legion");
        array_push($affecteds, -1);

        return array($states, $affecteds);
    }

    // Retourne un bouleen disant si la carte à un pouvoir qui necéssite
    // un state particulier
    private function isPowerWithAction($idCard) {
        $cards = $this->manager->getRepository("AugustusBundle:AugustusCard");
        $card = $cards->findOneById($idCard);

        $power = $card->getPower();
        return $power == AugustusPower::TWOLEGIONONDOUBLESWORD ||
            $power == AugustusPower::TWOLEGIONONTEACHES ||
            $power == AugustusPower::TWOLEGIONONSHIELD ||
            $power == AugustusPower::TWOLEGIONONKNIFE ||
            $power == AugustusPower::ONECARD ||
            $power == AugustusPower::REMOVEONELEGION ||
            $power == AugustusPower::REMOVETWOLEGION ||
            $power == AugustusPower::MOVELEGION ||
            $power == AugustusPower::ONELEGIONONANYTHING ||
            $power == AugustusPower::TWOLEGIONONCHARIOT ||
            $power == AugustusPower::TWOLEGIONONCATAPULT ||
            $power == AugustusPower::TWOLEGIONONANYTHING ||
            $power == AugustusPower::REMOVEALLLEGION ||
            $power == AugustusPower::REMOVEONECARD ||
            $power == AugustusPower::COMPLETECARD;
    }

    // retourne la carte où un joueur à réussi à placer toutes les légions
    // ou null
    private function getCapturableCardFromPlayer($idPlayer) {
        $players = $this->manager->getRepository("AugustusBundle:AugustusPlayer");
        $player = $players->findOneById($idPlayer);

        foreach ($player->getCards() as $card) {
            if (count($card->getTokens()) == count($card->getCtrlTokens())) {
                return $card;
            }
        }

        return null;
    }

    // rempli le taleau de loot
    public function fillColorLoot($id, $idPlayer, $type) {
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        $colorLoot = $game->getColorLoot();

        if (array_key_exists($colorLoot, $type) && !$colorLoot[$type]) {
            $colorLoot[$type] = $idPlayer;
            $game->setColorLoot($colorLoot);
        }

        $this->manager->flush();
    }

    // change le propriétaire de la carte avantage gold
    private function changeGoldOwner($id, $idPlayer) {
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        $players = $this->manager->getRepository("AugustusBundle:AugustusPlayer");
        $actualPlayer = $players->findOneById($id);

        
        if ($actualPlayer->getGold() != 0) {
            if ($game->getGoldOwner() == -1) {
                $game->setGoldOwner($idPlayer);
            } else {
                $otherPlayer = $players->findOneById($game->getGoldOwner());

                if ($actualPlayer->getGold() >= $otherPlayer->getGold()) {
                    $game->setGoldOwner($idPlayer);
                }
            }
        }

        $this->manager->flush();
    }

    // change le propriétaire de la carte avantage wheat
    private function changeWheatOwner($id, $idPlayer) {
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        $players = $this->manager->getRepository("AugustusBundle:AugustusPlayer");
        $actualPlayer = $players->findOneById($id);

        
        if ($actualPlayer->getWheat() != 0) {
            if ($game->getWheatOwner() == -1) {
                $game->setWheatOwner($idPlayer);
            } else {
                $otherPlayer = $players->findOneById($game->getWheatOwner());

                if ($actualPlayer->getWheat() >= $otherPlayer->getWheat()) {
                    $game->setWheatOwner($idPlayer);
                }
            }
        }

        $this->manager->flush();
    }

    // retourne le gagnant de la partie
    public function getWinner($id) {
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        $players = $this->manager->getRepository("AugustusBundle:AugustusPlayer");
        $participants = $game->getPlayers();

        $winner = $participants[0];
        $best = $this->getScores($id, $participants[0]->getId());
        array_shift($participants);
        foreach ($participants as $player) {
            $score = $this->getScores($id, $player->getId());
            if ($score > $best ||
                $score == $best && $players->getNbOfCardColor($player->getId(), AugustusColor::SENATOR) > $players->getNbOfCardColor($winner->getId(), AugustusColor::SENATOR)) {
                $best = $score;
                $winner = $player;
            }
        }

        return $winner;
    }

    // retourne le score du joueur
    public function getScores($id, $idPlayer) {
        $games = $this->manager->getRepository("AugustusBundle:AugustusGame");
        $game = $games->findOneById($id);
        $players = $this->manager->getRepository("AugustusBundle:AugustusPlayer");
        $player = $players->findOneById($idPlayer);

        // points des recompenses
        $rewards = $player->getAdvantage();
        if ($game->getColorLoot()[AugustusColor::SENATOR] == $idPlayer) {
            $rewards += 2;
        }
        if ($game->getColorLoot()[AugustusColor::GREEN] == $idPlayer) {
            $rewards += 4;
        }
        if ($game->getColorLoot()["all"] == $idPlayer) {
            $rewards += 6;
        }
        if ($game->getColorLoot()[AugustusColor::PINK] == $idPlayer) {
            $rewards += 8;
        }
        if ($game->getColorLoot()[AugustusColor::ORANGE] == $idPlayer) {
            $rewards += 10;
        }
        if ($idPlayer == $game->getGoldOwner()) {
            $rewards += 5;
        }
        if ($idPlayer == $game->getWheatOwner()) {
            $rewards += 5;
        }

        // points direct des objectifs
        $obj = 0;
        $cardPower = array();
        foreach ($player->getCtrlCards() as $card) {
            $obj += $card->getPoints();
            if ($card->getPoints() != 0) {
                array_push($cardPower, $card);
            }
        }

        // points des pouvoirs des objectifs
        $power = 0;
        foreach ($cardPower as $card) {
            switch($card->getPower()) {
                case AugustusPower::ONEPOINTBYSHIELD:
                    $pts = $this->playerModel->getNbOfToken($idPlayer, AugustusToken::SHIELD);
                    $power += ($pts > 8 ? 8 : $pts);
                    break;
                case AugustusPower::ONEPOINTBYDOUBLESWORD:
                    $pts = $this->playerModel->getNbOfToken($idPlayer, AugustusToken::DOUBLESWORD);
                    $power += ($pts > 6 ? 6 : $pts);
                    break;
                case AugustusPower::TWOPOINTBYCHARIOT:
                    $pts = $this->playerModel->getNbOfToken($idPlayer, AugustusToken::CHARIOT) * 2;
                    $power += ($pts > 10 ? 10 : $pts);
                    break;
                case AugustusPower::THREEPOINTBYCATAPULT:
                    $pts = $this->playerModel->getNbOfToken($idPlayer, AugustusToken::CATAPULT) * 3;
                    $power += ($pts > 12 ? 12 : $pts);
                    break;
                case AugustusPower::THREEPOINTBYTEACHES:
                    $pts = $this->playerModel->getNbOfToken($idPlayer, AugustusToken::TEACHES) * 3;
                    $power += ($pts > 15 ? 15 : $pts);
                    break;
                case AugustusPower::FOURPOINTBYKNIFE:
                    $pts = $this->playerModel->getNbOfToken($idPlayer, AugustusToken::KNIFE) * 4;
                    $power += ($pts > 20 ? 20 : $pts);
                    break;
                case AugustusPower::TWOPOINTBYGREENCARD:
                    $power += $this->playerModel->getNbOfCardColor($idPlayer, AugustusColor::GREEN) * 2;
                    break;
                case AugustusPower::TWOPOINTBYSENATORCARD:
                    $power += $this->playerModel->getNbOfCardColor($idPlayer, AugustusColor::SENATOR) * 2;
                    break;
                case AugustusPower::FOURPOINTBYPINKCARD:
                    $power += $this->playerModel->getNbOfCardColor($idPlayer, AugustusColor::PINK) * 4;
                    break;
                case AugustusPower::FIVEPOINTBYREDCARD:
                    $power += $this->playerModel->getNbOfRedPower($idPlayer) * 5;
                    break;
                case AugustusPower::SIXPOINTBYORANGECARD:
                    $power += $this->playerModel->getNbOfCardColor($idPlayer, AugustusColor::ORANGE) * 6;
                    break;
            }
        }

        return $rewards + $obj + $power;    
    }
}