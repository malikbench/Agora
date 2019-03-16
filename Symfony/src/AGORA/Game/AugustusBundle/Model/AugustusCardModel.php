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
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $tokens = $card->getTokens();

        $ind = array_search($token, $tokens);
        $beg = array_slice($tokens, 0, ind);
        $end = array_slice($tokens, ind + 1, count($tokens));

        $card->setTokens(array_push($beg, $end));
        $card->setCtrlTokens(array_push($card->getCtrlTokens()), $token);

        $this->$manager->flush();
    }

    //Passe le token d'id idToken de la liste des Tokens capturés a celle des Tokens.
    public function getBackToken($idCard, $token) {
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $tokens = $card->getCtrlTokens();

        $ind = array_search($token, $tokens);
        $beg = array_slice($tokens, 0, ind);
        $end = array_slice($tokens, ind + 1, count($tokens));

        $card->setTokens(array_push($beg, $end));
        $card->setCtrlTokens(array_push($card->getTokens()), $token);

        $this->$manager->flush();
    }

    //La liste des Tokens est elle vide ?
    public function isCapturable($idCard) {
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $tokens = $card->getTokens();

        return count($tokens) == 0;
    }

    //Effectue le pouvoir lié a son type de pouvoir.
    public function doPower($idCard) {
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        switch($card->getPower()) {
            case AugustusPower::ONELEGION:
                doOneLegion($idCard);
                break;
            case AugustusPower::TWOLEGION: 
                doTwoLegion($idCard);
                break;
            case AugustusPower::DOUBLESWORDISSHIELD: 
                doDoubleSwordIsShield($idCard);
                break;
            case AugustusPower::SHIELDISCHARIOT: 
                doShieldIsChariot($idCard);
                break;
            case AugustusPower::CHARIOTISCATAPULT: 
                doChariotIsCatapult($idCard);
                break;
            case AugustusPower::CATAPULTISTEACHES: 
                doCatapultIsTeaches($idCard);
                break;
            case AugustusPower::TEACHESISKNIFE: 
                doTeachesIsKnife($idCard);
                break;
        }
        $this->$manager->flush();
    }

    private function doOneLegion($idCard) {
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $player->setLegionMax($player->getLegionMax() + 1);
    }

    private function doTwoLegion($idCard) {
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $player->setLegionMax($player->getLegionMax() + 2);
    }

    private function  doDoubleSwordIsShield($idCard) {
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $bonus = $player -> getBonus();
        if($bonus[AugustusToken::SHIELD]->length == 0) {
            $bonus[AugustusToken::SHIELD] = [];
        }
        $bonus[AugustusToken::SHIELD]->array_push(AugustusToken::DOUBLESWORD);
        if($bonus[AugustusToken::DOUBLESWORD]->length == 0) {
            $bonus[AugustusToken::DOUBLESWORD] = [];
        }
        $bonus[AugustusToken::DOUBLESWORD] = array_push(AugustusToken::SHIELD);
        $player -> setBonus($bonus);
    }

    private function  doShieldIsChariot($idCard) {
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $bonus = $player -> getBonus();
        if($bonus[AugustusToken::SHIELD]->length == 0) {
            $bonus[AugustusToken::SHIELD] = [];
        }
        $bonus[AugustusToken::SHIELD]->array_push(AugustusToken::CHARIOT);
        if($bonus[AugustusToken::CHARIOT]->length == 0) {
            $bonus[AugustusToken::CHARIOT] = [];
        }
        $bonus[AugustusToken::CHARIOT]->array_push(AugustusToken::SHIELD);
        $player -> setBonus($bonus);
    }

    private function doChariotIsCatapult($idCard) {
        $cards = $manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $bonus = $player -> getBonus();
        if($bonus[AugustusToken::CHARIOT]->length == 0) {
            $bonus[AugustusToken::CHARIOT] = [];
        }
        $bonus[AugustusToken::CHARIOT]->array_push(AugustusToken::CATAPULT);
        if($bonus[AugustusToken::CATAPULT]->length == 0) {
            $bonus[AugustusToken::CATAPULT] = [];
        }
        $bonus[AugustusToken::CATAPULT]->array_push(AugustusToken::CHARIOT);
        $player -> setBonus($bonus);
    }

    private function doCatapultIsTeaches($idCard) {
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $bonus = $player -> getBonus();
        if($bonus[AugustusToken::CATAPULT]->length == 0) {
            $bonus[AugustusToken::CATAPULT] = [];
        }
        $bonus[AugustusToken::CATAPULT]->array_push(AugustusToken::TEACHES);
        if($bonus[AugustusToken::TEACHES]->length == 0) {
            $bonus[AugustusToken::TEACHES] = [];
        }
        $bonus[AugustusToken::TEACHES]->array_push(AugustusToken::CATAPULT);
        $player -> setBonus($bonus);
    }

    private function doTeachesIsKnife($idCard) {
        $cards = $this->$manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $bonus = $player -> getBonus();
        if($bonus[AugustusToken::TEACHES]->length == 0) {
            $bonus[AugustusToken::TEACHES] = [];
        }
        $bonus[AugustusToken::TEACHES]->array_push(AugustusToken::KNIFE);
        if($bonus[AugustusToken::KNIFE]->length == 0) {
            $bonus[AugustusToken::KNIFE] = [];
        }
        $bonus[AugustusToken::KNIFE]->array_push(AugustusToken::TEACHES);
        $player -> setBonus($bonus);
    }

}