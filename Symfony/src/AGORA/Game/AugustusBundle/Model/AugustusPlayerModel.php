<?php

namespace AGORA\Game\Model\AugustusPlayerModel;

use Doctrine\ORM\EntityManager;

//Fonction agissant sur AugustusPlayer
class AugustusPlayerModel {

    protected $manager;
    
    //On construit notre api avec un entity manager permettant l'accès à la base de données
    public function __construct(EntityManager $em) {
        $this->manager = $em;
    }

    //Mets une légion sur la carte et retire le jeton de la carte correspondant au jeton du tour en cours.
    public function putLegionOnCard($idPlayer, $idCard, $token) {
        $players = $this->$manager->getRepository('AugustusBundle:AugustusPlayer');
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $player = $players->findOneById($idPlayer);
        $card = $cards->findOneById($idCard);

        $cardModel = new AugustusCardModel($manager);

        $cardModel->captureToken($idCard, $token);

        $player->legion = $player->$legion - 1;

        $player->history = [$idCard, $token];
        
        $this->$manager->flush();
    }

    //Mets une legion de la carte Source à la carte dest.
    public function putLegionFromSourceToDest($idPlayer, $idCardSource, $idCardDest, $tokenSource, $tokenDest) {
        $players = $this->$manager->getRepository('AugustusBundle:AugustusPlayer');
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $player = $players->findOneById($idPlayer);

        $cardModel = new AugustusCardModel($manager);

        $cardModel->getBackToken($idCardSource, $tokenSource);
        $cardModel->captureToken($idCardDest, $tokenDest);

        $player->history = [$idCardDest, $tokenDest];
        
        $this->$manager->flush();
    }


    //La carte d'id idCard passe de currObj à ctrlObj si tout les tokens de la cartes sont contrôlés.
    public function captureCard($idPlayer, $idCard) {
        $players = $this->$manager->getRepository('AugustusBundle:AugustusPlayer');
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

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
        $this->$manager->flush();
    }

    public function deleteCtrlCard($idPlayer) {
        $players = $manager->getRepository('AugustusBundle:AugustusPlayer');

        $player = $players->findOneById($idPlayer);

        $ctrlCards = $player->getCtrlCards();
        shuffle($ctrlCards);
        array_pop($ctrlCards);
        $player->setCtrlCards($ctrlCards);

        $this->$manager->flush();
    }

    public function completeCard($idCard) {
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $ctrl = $card->getCtrlTokens();
        foreach($ctrl as &$c) {
            $c == true;
        }
        $card->setCtrlTokens($ctrl);

        $this->$manager->flush();
    }
}

