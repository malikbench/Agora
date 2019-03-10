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

    //Passe le token token de la liste des Tokens a celle des Tokens capturés.
    public function captureToken($idCard, $token) {
        $cards = $manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $tokens = $card->getTokens();

        $ind = array_search($token, $tokens);
        $beg = array_slice($tokens, 0, ind);
        $end = array_slice($tokens, ind + 1, count($tokens));

        $card->setTokens(array_push($beg, $end));
        $card->setCtrlTokens(array_push($card->getCtrlTokens()), $token);

        $manager->flush();
    }

    //Passe le token d'id idToken de la liste des Tokens capturés a celle des Tokens.
    public function getBackToken($idCard, $token) {
        $cards = $manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $tokens = $card->getCtrlTokens();

        $ind = array_search($token, $tokens);
        $beg = array_slice($tokens, 0, ind);
        $end = array_slice($tokens, ind + 1, count($tokens));

        $card->setTokens(array_push($beg, $end));
        $card->setCtrlTokens(array_push($card->getTokens()), $token);

        $manager->flush();
    }

    //La liste des Tokens est elle vide ?
    public function isCapturable($idCard) {
        $cards = $manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $tokens = $card->getTokens();

        return count($tokens) == 0;
    }

    //Effectue le pouvoir lié a son type de pouvoir.
    public function doPower($idCard) {

    }
}