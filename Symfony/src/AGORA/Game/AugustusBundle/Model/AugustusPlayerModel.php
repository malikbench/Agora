<?php

namespace AGORA\Game\AugustusBundle\Model;

use AGORA\Game\AugustusBundle\Entity\AugustusGame;
use AGORA\Game\AugustusBundle\Entity\AugustusPlayer;
use AGORA\Game\AugustusBundle\Entity\AugustusCard;
use AGORA\Game\AugustusBundle\Entity\AugustusToken;

use AGORA\Game\GameBundle\Entity\Game;
use Doctrine\ORM\EntityManager;

//Fonction agissant sur AugustusPlayer
class AugustusPlayerModel {

    protected $manager;
    
    //On construit notre api avec un entity manager permettant l'accès à la base de données
    public function __construct(EntityManager $em) {
        $this->manager = $em;
    }

    public function createPlayer($userId, $gameId) {
        $augGame = $this->manager->getRepository('AGORAGameAugustusBundle:AugustusGame')->find($gameId);
        if ($augGame == null) {
            throw new \Exception();
        }

        $game = $this->manager->getRepository('AGORAGameGameBundle:Game')
            ->findOneBy(array('gameId' => $gameId));

        $players = $this->manager->getRepository('AGORAGameAugustusBundle:AugustusPlayer')
            ->findBy(array('game' => $gameId));

        $nbPlayer = count($players);
        if ($nbPlayer >= $game->getNbPlayers()) {
            return -1;
        }

        $player = new AveCesarPlayer();
        $player->setGameId($gameId);

        $user = $this->manager->getRepository('AGORAUserBundle:User')
            ->findOneBy(array('userId' => $userId));
        
        $player->setUserId($user->getId());
        $player->setUserName($user->getUserName());

        $this->manager->persist($player);
        $this->manager->flush();

        if ($nbPlayer + 1 == $game->getNbPlayers()) {
            $this->initPlayers($gameId);
            /*
            TODO implémenter initPlayers :
            appelée une fois que la salle est pleine
            initialise les joueurs pour la partie (cartes à contrôler etc)
            */
            //Peut etre a faire dans game 
        }
        $this->manager->flush();
        return $player->getId();
    }

    //Mets une légion sur la carte et retire le jeton de la carte correspondant au jeton du tour en cours.
    public function putLegionOnCard($idPlayer, $idCard, $token) {
        $players = $this->manager->getRepository('AugustusBundle:AugustusPlayer');
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $player = $players->findOneById($idPlayer);
        $card = $cards->findOneById($idCard);

        $cardModel = new AugustusCardModel($manager);

        $cardModel->captureToken($idCard, $token);

        $player->legion = $player->legion - 1;

        $player->history = [$idCard, $token];
        
        $this->manager->flush();
    }

    //Mets une legion de la carte Source à la carte dest.
    public function putLegionFromSourceToDest($idPlayer, $idCardSource, $idCardDest, $tokenSource, $tokenDest) {
        $players = $this->manager->getRepository('AugustusBundle:AugustusPlayer');
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $player = $players->findOneById($idPlayer);

        $cardModel = new AugustusCardModel($manager);

        $cardModel->getBackToken($idCardSource, $tokenSource);
        $cardModel->captureToken($idCardDest, $tokenDest);

        $player->history = [$idCardDest, $tokenDest];
        
        $this->manager->flush();
    }


    //La carte d'id idCard passe de currObj à ctrlObj si tout les tokens de la cartes sont contrôlés.
    public function captureCard($idPlayer, $idCard) {
        $players = $this->manager->getRepository('AugustusBundle:AugustusPlayer');
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $player = $players->findOneById($idPlayer);
        $card = $cards->findOneById($idCard);

        switch($card->getResource()) {
            case "wheat": 
                $player->setWheat($player->getWheat() + 1);
                break;
            case "gold": 
                $player->setGold($player->getGold() + 1);
                break;
            case "both": 
                $player->setWheat($player->getWheat() + 1);
                $player->setGold($player->getGold() + 1);
                break;
        }
        $player->ctrlCards[] = $card;
        $player->cards->removeElement($card);
        $this->manager->flush();
    }

    public function deleteCtrlCard($idPlayer) {
        $players = $manager->getRepository('AugustusBundle:AugustusPlayer');

        $player = $players->findOneById($idPlayer);

        $ctrlCards = $player->getCtrlCards();
        shuffle($ctrlCards);
        array_pop($ctrlCards);
        $player->setCtrlCards($ctrlCards);

        $this->manager->flush();
    }

    public function completeCard($idCard) {
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $ctrl = $card->getCtrlTokens();
        foreach($ctrl as &$c) {
            $c == true;
        }
        $card->setCtrlTokens($ctrl);

        $this->manager->flush();
    }

    public function getCardByNumber($idPlayer, $number) {
        $players = $manager->getRepository('AugustusBundle:AugustusPlayer');

        $player = $players->findOneById($idPlayer);

        $cards = $player->getCards();

        foreach($cards as $c) {
            if ($c->getNumber() == $number) {
                return $c;
            }
        }

        return null;
    }

    public function getNbOfCardColor($idPlayer, $color) {
        $players = $manager->getRepository('AugustusBundle:AugustusPlayer');

        $player = $players->findOneById($idPlayer);

        $ctrlCards = $player->getCtrlCards();

        $res = 0;

        foreach($ctrlCards as $c) {
            if ($c -> getColor() == $color) {
                $res = $res + 1;
            }
        }

        return $res;
    }

    public function getNbOfToken($idPlayer, $token) {
        $players = $manager->getRepository('AugustusBundle:AugustusPlayer');

        $player = $players->findOneById($idPlayer);

        $ctrlCards = $player->getCtrlCards();

        $res = 0;

        foreach($ctrlCards as $c) {
            $tokens = $c->getTokens();
            foreach($tokens as $t) {
                if ($t == $token) {
                    $res = $res + 1;
                }
            }
        }
        return $res;
    }

    public function haveOneCardOfEach($idPlayer) {
        $players = $manager->getRepository('AugustusBundle:AugustusPlayer');

        $player = $players->findOneById($idPlayer);

        $ctrlCards = $player->getCtrlCards();

        $pink = false;
        $green = false;
        $senator = false;
        $orange = false;

        foreach($ctrlCards as $c) {
            switch($c -> getColor()) {
                case AugustusColor::PINK : {
                    $pink = true;
                    break;
                }
                case AugustusColor::GREEN : {
                    $green = true;
                    break;
                }
                case AugustusColor::ORANGE : {
                    $orange = true;
                    break;
                }
                case AugustusColor::SENATOR : {
                    $senator = true;
                    break;
                }
            }
        }
        return $pink && $green && $senator && $orange;
    }

    public function getNbOfRedPower($idPlayer) {
        $players = $manager->getRepository('AugustusBundle:AugustusPlayer');

        $player = $players->findOneById($idPlayer);

        $ctrlCards = $player->getCtrlCards();

        $res = 0;

        foreach($ctrlCards as $c) {
            switch($c -> getPower()) {
                case AugustusPower::REMOVEONELEGION : {
                    $res = $res + 1;
                    break;
                }
                case AugustusPower::REMOVETWOLEGION : {
                    $res = $res + 1;                    
                    break;
                }
                case AugustusPower::REMOVEALLLEGION : {
                    $res = $res + 1;                    
                    break;
                }
                case AugustusPower::REMOVEONECARD : {
                    $res = $res + 1;
                    break;
                }
            }
        }
        return $pink && $green && $senator && $orange;
    }
}

