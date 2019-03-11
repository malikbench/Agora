<?php

namespace AGORA\Game\Model\AugustusCardModel;

use Doctrine\ORM\EntityManager;

class AgustusBoardModel {
  
  protected $manager;
    
  //On construit notre api avec un entity manager permettant l'accès à la base de données
  public function __construct(EntityManager $em) {
    $this->manager = $em;
    
    // Il y a 88 objectifs (cartes) dans le deck au debut d'une partie.
    $this->deck = new \Doctrine\Common\Collections\ArrayCollection();
    
    // La liste toCapture est la liste utilisée pour savoir quels sont les token nécéssaire à la capture de la carte.
    $toCapture = new \Doctrine\Common\Collections\ArrayCollection();
    
    // Ajout des cartes dans le deck.
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(1, AugustusColor::SENATOR, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(2, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(3, AugustusColor::ROSE, NULL, 6, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(4, AugustusColor::SENATOR, NULL, 6, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(5, AugustusColor::VERT, AugustusResource::WHEAT, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(6, AugustusColor::SENATOR, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(7, AugustusColor::VERT, AugustusResource::WHEAT, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(8, AugustusColor::SENATOR, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(9, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(10, AugustusColor::ROSE, AugustusResource::WHEAT, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(11, AugustusColor::SENATOR, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(12, AugustusColor::VERT, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(13, AugustusColor::SENATOR, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(14, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(15, AugustusColor::SENATOR, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(16, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(17, AugustusColor::ROSE, NULL, 8, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(18, AugustusColor::SENATOR, NULL, 8, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(19, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(20, AugustusColor::SENATOR, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(21, AugustusColor::ROSE, NULL, 9, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(22, AugustusColor::SENATOR, NULL, 9, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(23, AugustusColor::VERT, NULL, 10, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(24, AugustusColor::ORANGE, AugustusResource::GOLD, 10, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(25, AugustusColor::SENATOR, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(26, AugustusColor::VERT, AugustusResource::GOLD, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(27, AugustusColor::SENATOR, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(28, AugustusColor::ROSE, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(29, AugustusColor::SENATOR, NULL, 4, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(30, AugustusColor::VERT, NULL, 4, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(31, AugustusColor::ROSE, NULL, 4, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(32, AugustusColor::SENATOR, NULL, 4, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(33, AugustusColor::VERT, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(34, AugustusColor::SENATOR, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(35, AugustusColor::ROSE, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(36, AugustusColor::SENATOR, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(37, AugustusColor::VERT, NULL, 6, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(38, AugustusColor::ORANGE, NULL, 6, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(39, AugustusColor::SENATOR, NULL, 11, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(40, AugustusColor::VERT, AugustusResource::WHEAT, 11, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(41, AugustusColor::SENATOR, NULL, 2, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(42, AugustusColor::VERT, NULL, 2, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(43, AugustusColor::SENATOR, NULL, 2, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(44, AugustusColor::ROSE, NULL, 2, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(45, AugustusColor::ROSE, AugustusResource::GOLD, 6, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(46, AugustusColor::SENATOR, NULL, 6, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(47, AugustusColor::VERT, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(48, AugustusColor::SENATOR, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(49, AugustusColor::ROSE, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(50, AugustusColor::SENATOR, NULL, 12, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(51, AugustusColor::VERT, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(52, AugustusColor::ORANGE, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(53, AugustusColor::SENATOR, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(54, AugustusColor::VERT, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(55, AugustusColor::SENATOR, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::CATAPULT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(56, AugustusColor::ROSE, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(57, AugustusColor::SENATOR, NULL, 13, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(58, AugustusColor::VERT, NULL, 13, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(59, AugustusColor::ROSE, NULL, 7, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::CHARIOT);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(60, AugustusColor::SENATOR, NULL, 7, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(61, AugustusColor::VERT, NULL, 14, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(62, AugustusColor::ORANGE, NULL, 14, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(63, AugustusColor::VERT, AugustusResource::GOLD, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(64, AugustusColor::SENATOR, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT;
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(65, AugustusColor::VERT, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT;
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(66, AugustusColor::ROSE, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(67, AugustusColor::SENATOR, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugustusToken::SHIELD);
    // Il faut noter ici la présence de deux ressources, probablement faire une liste.
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(68, AugustusColor::VERT, AugustusResource::WHEAT+GOLD, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(69, AugustusColor::ORANGE, AugustusResource::GOLD, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(70, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(71, AugustusColor::SENATOR, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(72, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(73, AugustusColor::ROSE, NULL, 7, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(74, AugustusColor::SENATOR, NULL, 7, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(75, AugustusColor::VERT, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(76, AugustusColor::ORANGE, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(77, AugustusColor::ROSE, NULL, 15, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(78, AugustusColor::SENATOR, NULL, 15, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(79, AugustusColor::VERT, NULL, 16, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(80, AugustusColor::ROSE, NULL, 16, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(81, AugustusColor::SENATOR, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(82, AugustusColor::ROSE, NULL, 5, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(83, AugustusColor::ORANGE, NULL, ?, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugustusToken::SHIELD);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(84, AugustusColor::VERT, NULL, 12, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(85, AugustusColor::SENATOR, NULL, 10, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(86, AugustusColor::ROSE, AugustusResource::WHEAT, 10, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    // Il faut noter ici la présence de deux ressources, probablement faire une liste.
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(87, AugustusColor::ORANGE, AugustusResource::WHEAT+GOLD, 4, AugustusPower::???, $toCapture);
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    addCardToDeck(new \AGORA\Game\AugustusBundle\Entity\Card(88, AugustusColor::SENATOR, NULL, 6, AugustusPower::???, $toCapture);
    
    // Ensuite on mélange le deck, il y a 88 cartes donc un swap de 150 paires semble correcte pour un mélange.
    for ($i = 0; $i < 150; $i++) {
      $nbAlea1 = rand(0, 87);
      $nbAlea2 = rand(0, 87);
      $transiCard1 = $this->deck->get($nbAlea1);
      $transiCard2 = $this->deck->get($nbAlea2);
      $this->deck->remove($nbAlea1);
      $this->deck->remove($nbAlea1);
      $this->deck->set($nbAlea2, $transiCard1);
      $this->deck->set($nbAlea1, $transiCard2);
    }
    
    // Il y a 23 jetons (tokens) dans le sac de token au début d'une partie.
    $this->tokenBag = new \Doctrine\Common\Collections\ArrayCollection();
    
    // Ajout des tokens dans le sac.
    for ($i = 0; $i < 6; $i++) {
      addTokenToBag(AugustusToken::DOUBLESWORD);
    }
    for ($i = 0; $i < 5; $i++) {
      addTokenToBag(AugustusToken::SHIELD);
    }
    for ($i = 0; $i < 4; $i++) {
      addTokenToBag(AugustusToken::CHARIOT);
    }
    for ($i = 0; $i < 3; $i++) {
      addTokenToBag(AugustusToken::CATAPULT);
    }
    for ($i = 0; $i < 2; $i++) {
      addTokenToBag(AugustusToken::TEACHES);
    }
    for ($i = 0; $i < 2; $i++) {
      addTokenToBag(AugustusToken::JOKER);
    }
    addTokenToBag(AugustusToken::KNIFE);
    
    // Ensuite on mélnge le sac de jeton, il y a 23 jeton donc un swap de 50 paires semble correct pour un mélange.
    for ($i = 0; $i < 50; $i++) {
      $nbAlea1 = rand(0, 22);
      $nbAlea2 = rand(0, 22);
      $transiToken1 = $this->tokenBag->get($nbAlea1);
      $transiToken2 = $this->tokenBag->get($nbAlea2);
      $this->tokenBag->remove($nbAlea1);
      $this->tokenBag->remove($nbAlea1);
      $this->tokenBag->set($nbAlea2, $transiToken1);
      $this->tokenBag->set($nbAlea1, $transiToken2);
    }
    
    // Il y a 5 objectifs sur le terrain en début d'une partie.
    $this->objLine = new \Doctrine\Common\Collections\ArrayCollection();
    
    // Le deck est déjà mélangé donc il suffit de tirer les 5 cartes du dessus.
    for ($i = 0; $i < 5; $i++) {
      addObjToLine($this->deck->last());
      removeCardFromDeck($this->deck->last());
    }
  }

  // fillLine : Place des cartes sur le terrain, doublons avec le constructeur qui prépare déjà tout ?
  public function fillLine() {

  }
  
  // resetDeck : supprime toutes les cartes du deck, puis ajoute des cartes.
  public function resetDeck() {
    $this->deck->clear();
  }
  
  // resetBag : supprime les tokens du sac, puis ajoute des tokens.
  public function resetBag() {
    $this->tokenBag->clear();
  }
  
  // takeToken : Prend le dernier token du sac (le sac est déjà mélangé).
  // return : Le dernier token du sac.
  public function takeToken() {
    $token = $this->tokenBag->last();
    removeTokenFromBag($this->tokenBag->last());
    return $token;
  }
}
