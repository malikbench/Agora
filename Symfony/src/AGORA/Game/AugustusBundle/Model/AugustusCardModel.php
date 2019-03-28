<?php

namespace AGORA\Game\AugustusBundle\Model;

use AGORA\Game\AugustusBundle\Entity\AugustusCard;
use AGORA\Game\AugustusBundle\Entity\AugustusToken;
use AGORA\Game\AugustusBundle\Entity\AugustusPower;
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
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $tokens = $card->getTokens();
        $ctrl = $card->getCtrlTokens();

        $ind = 0;
        while($ind < count($tokens)) {
            if ($tokens[$ind] == $token) {
                if ($ctrl[$ind] == false) {
                    $ctrl[$ind] = true;
                    $card->setCtrlTokens($ctrl);
                    $this->manager->flush();
                    return;
                }
            }
            $ind = $ind + 1;
        }
    }

    //Passe le token d'id idToken de la liste des Tokens capturés a celle des Tokens.
    public function getBackToken($idCard, $token) {
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $tokens = $card->getCtrlTokens();
        $ctrl = $card->getCtrlTokens();

        $ind = 0;
        while($ind < count($tokens)) {
            if ($tokens[$ind] == $token) {
                if ($ctrl[$ind] == true) {
                    $ctrl[$ind] = false;
                    $card->setCtrlTokens($ctrl);
                    $this->manager->flush();
                    return;
                }
            }
            $ind = $ind + 1;
        }
    }

    //La liste des Tokens est elle vide ?
    public function isCapturable($idCard) {
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $res = true;
        foreach($card->getCtrlTokens() as $c) {
            if ($c == false) {
                $res = false;
                break;
            }
        }

        return $res;
    }

    //Effectue le pouvoir lié a son type de pouvoir.
    public function doPower($idCard) {
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

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
        $this->manager->flush();
    }

    private function doOneLegion($idCard) {
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $player->setLegionMax($player->getLegionMax() + 1);
    }

    private function doTwoLegion($idCard) {
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $player->setLegionMax($player->getLegionMax() + 2);
    }

    private function  doDoubleSwordIsShield($idCard) {
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $equivalences = $player -> getEquivalences();
        if($equivalences[AugustusToken::SHIELD]->length == 0) {
            $equivalences[AugustusToken::SHIELD] = [];
        }
        $equivalences[AugustusToken::SHIELD]->array_push(AugustusToken::DOUBLESWORD);
        if($equivalences[AugustusToken::DOUBLESWORD]->length == 0) {
            $equivalences[AugustusToken::DOUBLESWORD] = [];
        }
        $equivalences[AugustusToken::DOUBLESWORD] = array_push(AugustusToken::SHIELD);
        $player -> setEquivalences($equivalences);
    }

    private function  doShieldIsChariot($idCard) {
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $equivalences = $player -> getEquivalences();
        if($equivalences[AugustusToken::SHIELD]->length == 0) {
            $equivalences[AugustusToken::SHIELD] = [];
        }
        $equivalences[AugustusToken::SHIELD]->array_push(AugustusToken::CHARIOT);
        if($equivalences[AugustusToken::CHARIOT]->length == 0) {
            $equivalences[AugustusToken::CHARIOT] = [];
        }
        $equivalences[AugustusToken::CHARIOT]->array_push(AugustusToken::SHIELD);
        $player -> setEquivalences($equivalences);
    }

    private function doChariotIsCatapult($idCard) {
        $cards = $manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $equivalences = $player -> getEquivalences();
        if($equivalences[AugustusToken::CHARIOT]->length == 0) {
            $equivalences[AugustusToken::CHARIOT] = [];
        }
        $equivalences[AugustusToken::CHARIOT]->array_push(AugustusToken::CATAPULT);
        if($equivalences[AugustusToken::CATAPULT]->length == 0) {
            $equivalences[AugustusToken::CATAPULT] = [];
        }
        $equivalences[AugustusToken::CATAPULT]->array_push(AugustusToken::CHARIOT);
        $player -> setEquivalences($equivalences);
    }

    private function doCatapultIsTeaches($idCard) {
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $equivalences = $player -> getEquivalences();
        if($equivalences[AugustusToken::CATAPULT]->length == 0) {
            $equivalences[AugustusToken::CATAPULT] = [];
        }
        $equivalences[AugustusToken::CATAPULT]->array_push(AugustusToken::TEACHES);
        if($equivalences[AugustusToken::TEACHES]->length == 0) {
            $equivalences[AugustusToken::TEACHES] = [];
        }
        $equivalences[AugustusToken::TEACHES]->array_push(AugustusToken::CATAPULT);
        $player -> setEquivalences($equivalences);
    }

    private function doTeachesIsKnife($idCard) {
        $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');

        $card = $cards->findOneById($idCard);

        $player = $card->getPlayer();
        $equivalences = $player -> getEquivalences();
        if($equivalences[AugustusToken::TEACHES]->length == 0) {
            $equivalences[AugustusToken::TEACHES] = [];
        }
        $equivalences[AugustusToken::TEACHES]->array_push(AugustusToken::KNIFE);
        if($equivalences[AugustusToken::KNIFE]->length == 0) {
            $equivalences[AugustusToken::KNIFE] = [];
        }
        $equivalences[AugustusToken::KNIFE]->array_push(AugustusToken::TEACHES);
        $player -> setEquivalences($equivalences);
    }

}