<?php

namespace AGORA\Game\AugustusBundle\Model;

use Doctrine\ORM\EntityManager;
use AGORA\Game\AugustusBundle\Entity\AugustusToken;

class AugustusBoardModel {
  
  protected $manager;
  
  //On construit notre api avec un entity manager permettant l'accès à la base de données
  public function __construct(EntityManager $em) {
    $this->manager = $em;
  }

  // fillLine : Place des cartes sur le terrain, si il en manque.
  public function fillLine($idBoard) {
    
    // Récupération du board avec son id.
    $boards = $this->manager->getRepository('AugustusBundle:AugustusBoard');
    $board = $boards->findOneById($idBoard);
    $deck = $board->getDeck()->toArray();
    $j = count($deck) - 1;
    for ($i = 0; $i < 5; $i++) {
      $j = $j - 1;
      $deck[$j]->setIsInLine(true);
    }
  }
    
  // resetBag : supprime les tokens du sac, puis ajoute tous les tokens dans le sac.
  public function resetBag($idBoard) {
    
    // Récupération du board avec son id.
    $boards = $this->manager->getRepository('AugustusBundle:AugustusBoard');
    $board = $boards->findOneById($idBoard);
    
    // On vide le sac.
    $board->clearTokenBag();
    
    // Ajout des tokens dans le sac.
    for ($i = 0; $i < 6; $i++) {
      $board->addTokenToBag(AugustusToken::DOUBLESWORD);
    }
    for ($i = 0; $i < 5; $i++) {
      $board->addTokenToBag(AugustusToken::SHIELD);
    }
    for ($i = 0; $i < 4; $i++) {
      $board->addTokenToBag(AugustusToken::CHARIOT);
    }
    for ($i = 0; $i < 3; $i++) {
      $board->addTokenToBag(AugustusToken::CATAPULT);
    }
    for ($i = 0; $i < 2; $i++) {
      $board->addTokenToBag(AugustusToken::TEACHES);
    }
    for ($i = 0; $i < 2; $i++) {
      // Le token JOKER si il est pioché entraine un resetBag.
      $board->addTokenToBag(AugustusToken::JOKER);
    }
    $board->addTokenToBag(AugustusToken::KNIFE);
    
    // Ensuite on mélnge le sac de jeton, il y a 23 jeton donc un swap de 50 paires semble correct pour un mélange.
    for ($i = 0; $i < 50; $i++) {
      $nbAlea1 = rand(0, 22);
      $nbAlea2 = rand(0, 22);
      $transiToken1 = $board->getTokenBag()->get($nbAlea1);
      $transiToken2 = $board->getTokenBag()->get($nbAlea2);
      $board->removeTokenFromBagWithIndex($nbAlea1);
      $board->removeTokenFromBagWithIndex($nbAlea1);
      $board->addTokenToBagWithIndex($nbAlea2, $transiToken1);
      $board->addTokenToBagWithIndex($nbAlea1, $transiToken2);
    }
  }
  
  // takeToken : Prend le dernier token du sac (le sac est déjà mélangé).
  // return : Le dernier token du sac.
  public function takeToken($idBoard) {
    
    // Récupération du board avec son id.
    $boards = $this->manager->getRepository('AugustusBundle:AugustusBoard');
    $board = $boards->findOneById($idBoard);
    
    $bag = $board->getTokenBag();
    $token = $bag[count($bag) - 1];
    $bag->remove(count($bag)- 1);
    $board->setTokenBag($bag);
    $this->manager->flush();
    return $token;
  }
  
  // TakeCard : prend la dernière carte du deck (le deck est déjà mélangé).
  // return : La dernière carte du deck.
  public function takeCard($idBoard) {
    
    // Récupération du board avec son id.
    $boards = $this->manager->getRepository('AugustusBundle:AugustusBoard');
    $board = $boards->findOneById($idBoard);
    $deck = $board->getDeck()->toArray();
    $j = count($deck) - 1;
    while ($deck[$j]->getIsInLine()) {
      $j = $j - 1;
    }

    $card = $deck[$j];
    $board->removeCardFromDeck($deck[$j]);
    $this->manager->flush();
    return $card;
  }

  public function takeCardFromCenter($idBoard, $idCard) {
    $boards = $this->manager->getRepository('AugustusBundle:AugustusBoard');
    $board = $boards->findOneById($idBoard);

    $cards = $this->manager->getRepository('AugustusBundle:AugustusCard');
    $card = $cards->findOneById($idCard);

    $board->removeCardFromDeck($card);
    $this->manager->flush();
    $board->fillLine($idBoard);
    $this->manager->flush();
    return $card;
  }
}
