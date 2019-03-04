<?php

namespace AGORA\Game\Model\AugustusCardModel;

use Doctrine\ORM\EntityManager;

//Fonction agissant sur AugustusCard
class AugustusCardModel {

    protected $manager;
    
    //On construit notre api avec un entity manager permettant l'accès à la base de données
    public function __construct(EntityManager $em) {
        $this->manager = $em;
    }

    //Passe le token d'id idToken de la liste des Tokens a celle des Tokens capturés.
    public function captureToken($idCard, $token) {
    }

    //Passe le token d'id idToken de la liste des Tokens capturés a celle des Tokens.
    public function getBackToken($idCard, $idToken) {
    }

    //La liste des Tokens est elle vide ?
    public function isCapturable($idCard) {

    }

    //Effectue le pouvoir lié a son type de pouvoir.
    public function doPower($idCard) {

    }
}