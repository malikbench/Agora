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
        $players = $manager->getRepository('AugustusBundle:AugustusPlayer');
        $cards = $manager->getRepository('AugustusBundle:AugustusCard');

        $player = $players->findOneById($idPlayer);
        $card = $cards->findOneById($idCard);

        $cardModel = new AugustusCardModel($manager);

        $cardModel->captureToken($idCard, $token);

        $player->$legion = $player->$legion - 1;

        $player->$history = [$idCard, $token];
        
        $manager.flush();
    }

    //Mets une legion de la carte Source à la carte dest.
    public function putLegionFromSourceToDest($idPlayer, $idCardSource, $idCardDest) {

    }

    //??
    public function takeLoot($idPlayer, $idLoot) {

    }

    //Prend une nouvelle carte présente sur le plateau si la longueur de currObj est inférieure à 3.
    public function getNewCard($idPlayer, $idCard) {

    }

    //La carte d'id idCard passe de currObj à ctrlObj si tout les tokens de la cartes sont contrôlés.
    public function captureCard($idPlayer, $idCard) {

    }
}

