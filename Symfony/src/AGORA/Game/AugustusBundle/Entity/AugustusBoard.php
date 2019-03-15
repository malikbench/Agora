<?php

namespace AGORA\Game\AugustusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AugustusBoard
 *
 * @ORM\Table(name="augustus_board")
 * @ORM\Entity(repositoryClass="AGORA\Game\AugustusBundle\Repository\AugustusBoardRepository")
 */
class AugustusBoard
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusCard", mappedBy="board")
     */
    private $deck;

    /**
     * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusCard", mappedBy="board")
     */
    private $objLine;
    
    /**
     * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusToken", mappedBy="board")
     */
    private $tokenBag;
    
    // Le constructeur.
    public function __construct() {
    
    // Il y a 88 objectifs (cartes) dans le deck au debut d'une partie.
    $this->deck = new \Doctrine\Common\Collections\ArrayCollection();
    
    // La liste toCapture est la liste utilisée pour savoir quels sont les token nécéssaire à la capture de la carte.
    $toCapture = new \Doctrine\Common\Collections\ArrayCollection();
    
    // Ajout des cartes dans le deck.
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(1, AugustusColor::SENATOR, NULL, 3, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(2, AugustusColor::VERT, NULL, 3, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(3, AugustusColor::ROSE, NULL, 6, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(4, AugustusColor::SENATOR, NULL, 6, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(5, AugustusColor::VERT, AugustusResource::WHEAT, 3, AugustusPower::ONELEGION, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(6, AugustusColor::SENATOR, NULL, 3, AugustusPower::ONELEGION, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(7, AugustusColor::VERT, AugustusResource::WHEAT, 0, AugustusPower::ONEPOINTBYDOUBLESWORD, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(8, AugustusColor::SENATOR, NULL, 0, AugustusPower::ONEPOINTBYDOUBLESWORD, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(9, AugustusColor::VERT, NULL, 3, AugustusPower::DOUBLESWORDISSHIELD, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(10, AugustusColor::ROSE, AugustusResource::WHEAT, 3, AugustusPower::DOUBLESWORDISSHIELD, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(11, AugustusColor::SENATOR, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(12, AugustusColor::VERT, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(13, AugustusColor::SENATOR, NULL, 3, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(14, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(15, AugustusColor::SENATOR, NULL, 3, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(16, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(17, AugustusColor::ROSE, NULL, 8, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(18, AugustusColor::SENATOR, NULL, 8, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(19, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(20, AugustusColor::SENATOR, NULL, 3, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(21, AugustusColor::ROSE, NULL, 9, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(22, AugustusColor::SENATOR, NULL, 9, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(23, AugustusColor::VERT, NULL, 10, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(24, AugustusColor::ORANGE, AugustusResource::GOLD, 10, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(25, AugustusColor::SENATOR, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(26, AugustusColor::VERT, AugustusResource::GOLD, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(27, AugustusColor::SENATOR, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(28, AugustusColor::ROSE, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(29, AugustusColor::SENATOR, NULL, 4, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(30, AugustusColor::VERT, NULL, 4, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(31, AugustusColor::ROSE, NULL, 4, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(32, AugustusColor::SENATOR, NULL, 4, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(33, AugustusColor::VERT, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(34, AugustusColor::SENATOR, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(35, AugustusColor::ROSE, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(36, AugustusColor::SENATOR, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(37, AugustusColor::VERT, NULL, 6, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(38, AugustusColor::ORANGE, NULL, 6, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(39, AugustusColor::SENATOR, NULL, 11, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(40, AugustusColor::VERT, AugustusResource::WHEAT, 11, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(41, AugustusColor::SENATOR, NULL, 2, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(42, AugustusColor::VERT, NULL, 2, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(43, AugustusColor::SENATOR, NULL, 2, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(44, AugustusColor::ROSE, NULL, 2, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(45, AugustusColor::ROSE, AugustusResource::GOLD, 6, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(46, AugustusColor::SENATOR, NULL, 6, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(47, AugustusColor::VERT, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(48, AugustusColor::SENATOR, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(49, AugustusColor::ROSE, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(50, AugustusColor::SENATOR, NULL, 12, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(51, AugustusColor::VERT, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(52, AugustusColor::ORANGE, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(53, AugustusColor::SENATOR, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(54, AugustusColor::VERT, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(55, AugustusColor::SENATOR, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(56, AugustusColor::ROSE, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(57, AugustusColor::SENATOR, NULL, 13, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(58, AugustusColor::VERT, NULL, 13, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(59, AugustusColor::ROSE, NULL, 7, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(60, AugustusColor::SENATOR, NULL, 7, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(61, AugustusColor::VERT, NULL, 14, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(62, AugustusColor::ORANGE, NULL, 14, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(63, AugustusColor::VERT, AugustusResource::GOLD, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(64, AugustusColor::SENATOR, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT;
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(65, AugustusColor::VERT, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT;
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(66, AugustusColor::ROSE, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(67, AugustusColor::SENATOR, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(68, AugustusColor::VERT, AugustusResource::BOTH, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(69, AugustusColor::ORANGE, AugustusResource::GOLD, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(70, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(71, AugustusColor::SENATOR, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(72, AugustusColor::VERT, NULL, 3, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(73, AugustusColor::ROSE, NULL, 7, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(74, AugustusColor::SENATOR, NULL, 7, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(75, AugustusColor::VERT, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(76, AugustusColor::ORANGE, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(77, AugustusColor::ROSE, NULL, 15, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(78, AugustusColor::SENATOR, NULL, 15, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(79, AugustusColor::VERT, NULL, 16, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(80, AugustusColor::ROSE, NULL, 16, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(81, AugustusColor::SENATOR, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(82, AugustusColor::ROSE, NULL, 5, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(83, AugustusColor::ORANGE, NULL, 0, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(84, AugustusColor::VERT, NULL, 12, NULL, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(85, AugustusColor::SENATOR, NULL, 10, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(86, AugustusColor::ROSE, AugustusResource::WHEAT, 10, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(87, AugustusColor::ORANGE, AugustusResource::BOTH, 4, AugustusPower::???, $toCapture));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card(88, AugustusColor::SENATOR, NULL, 6, AugustusPower::???, $toCapture));
    
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
      $this->tokenBag->add(AugustusToken::DOUBLESWORD);
    }
    for ($i = 0; $i < 5; $i++) {
      $this->tokenBag->add(AugustusToken::SHIELD);
    }
    for ($i = 0; $i < 4; $i++) {
      $this->tokenBag->add(AugustusToken::CHARIOT);
    }
    for ($i = 0; $i < 3; $i++) {
      $this->tokenBag->add(AugustusToken::CATAPULT);
    }
    for ($i = 0; $i < 2; $i++) {
      $this->tokenBag->add(AugustusToken::TEACHES);
    }
    for ($i = 0; $i < 2; $i++) {
      $this->tokenBag->add(AugustusToken::JOKER);
    }
    $this->tokenBag->add(AugustusToken::KNIFE);
    
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
      $this->objLine->add($this->deck->last());
      $this->deck->removeElement($this->deck->last());
    }
  }
  
  /**
   * Get id.
   *
   * @return int
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Add card to deck.
   *
   * @param \AGORA\Game\AugustusBundle\Entity\Card $card
   *
   * @return boolean TRUE if this element is added, FALSE otherwise.
   */
  public function addCardToDeck(\AGORA\Game\AugustusBundle\Entity\Card $card)
  {
      return $this->deck->add($card);
  }

  /**
   * Remove card from deck.
   *
   * @param \AGORA\Game\AugustusBundle\Entity\Card $card
   *
   * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
   */
  public function removeCardFromDeck(\AGORA\Game\AugustusBundle\Entity\Card $card)
  {
      return $this->deck->removeElement($card);
  }

  /**
   * Get deck.
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getDeck()
  {
      return $this->deck;
  }

  /**
   * Add obj to line.
   *
   * @param \AGORA\Game\AugustusBundle\Entity\Card $card
   *
   * @return boolean TRUE if this element is added, FALSE otherwise.
   */
  public function addObjToLine(\AGORA\Game\AugustusBundle\Entity\Card $card)
  {
      return $this->objLine->add($card);
  }

  /**
   * Remove obj from line.
   *
   * @param \AGORA\Game\AugustusBundle\Entity\Card $card
   *
   * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
   */
  public function removeObjFromLine(\AGORA\Game\AugustusBundle\Entity\Card $card)
  {
      return $this->objLine->removeElement($card);
  }

  /**
   * Get obj line.
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getObjLine()
  {
      return $this->objLine;
  }
  
  /**
   * Add token to bag.
   *
   * @param \AGORA\Game\AugustusBundle\Entity\Token $token
   *
   * @return boolean TRUE if this element is added, FALSE otherwise.
   */
  public function addTokenToBag(\AGORA\Game\AugustusBundle\Entity\Token $token)
  {
      return $this->tokenBag->add($token);
  }
  
  /**
   * Add token to bag with index.
   *
   * @params int $index, \AGORA\Game\AugustusBundle\Entity\Token $token
   *
   * @return boolean TRUE if this element is added, FALSE otherwise.
   */
  public function addTokenToBagWithIndex(int $index, \AGORA\Game\AugustusBundle\Entity\Token $token)
  {
      return $this->tokenBag->set($index, $token);
  }

  /**
   * Remove token from bag.
   *
   * @param \AGORA\Game\AugustusBundle\Entity\Token $token
   *
   * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
   */
  public function removeTokenFromBag(\AGORA\Game\AugustusBundle\Entity\Token $token)
  {
      return $this->tokenBag->removeElement($token);
  }

  /**
   * Remove token from bag with index.
   *
   * @param int $index
   * 
   * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
   */
  public function removeTokenFromBagWithIndex(int $index)
  {
      return $this->tokenBag->remove($index);
  }
  
  /**
   * Get token bag.
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getTokenBag()
  {
      return $this->tokenBag;
  }
  
  /**
   * Clear token bag.
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function clearTokenBag()
  {
      return $this->tokenBag->clear();
  }
}
