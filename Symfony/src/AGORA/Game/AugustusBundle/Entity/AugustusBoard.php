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
     * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusCard", mappedBy="board", cascade={"persist"})
     */
    private $deck;

    /**
     * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusCard", mappedBy="board", cascade={"persist"})
     */
    private $objLine;

    /**
     * @ORM\OneToOne(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusGame", mappedBy="board")
     */
    private $game;
    
    /**
     * @var array
     *
     * @ORM\Column(name="tokenBag", type="array")
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
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 1, AugustusColor::SENATOR, NULL, 3, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 2, AugustusColor::VERT, NULL, 3, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 3, AugustusColor::ROSE, NULL, 6, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 4, AugustusColor::SENATOR, NULL, 6, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 5, AugustusColor::VERT, AugustusResource::WHEAT, 3, AugustusPower::ONELEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 6, AugustusColor::SENATOR, NULL, 3, AugustusPower::ONELEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 7, AugustusColor::VERT, AugustusResource::WHEAT, 0, AugustusPower::ONEPOINTBYDOUBLESWORD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 8, AugustusColor::SENATOR, NULL, 0, AugustusPower::ONEPOINTBYDOUBLESWORD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 9, AugustusColor::VERT, NULL, 3, AugustusPower::DOUBLESWORDISSHIELD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 10, AugustusColor::ROSE, AugustusResource::WHEAT, 3, AugustusPower::DOUBLESWORDISSHIELD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 11, AugustusColor::SENATOR, NULL, 0, AugustusPower::ONEPOINTBYSHIELD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 12, AugustusColor::VERT, NULL, 0, AugustusPower::ONEPOINTBYSHIELD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 13, AugustusColor::SENATOR, NULL, 3, AugustusPower::TWOLEGIONONDOUBLESWORD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 14, AugustusColor::VERT, NULL, 3, AugustusPower::TWOLEGIONONDOUBLESWORD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 15, AugustusColor::SENATOR, NULL, 3, AugustusPower::TWOLEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 16, AugustusColor::VERT, NULL, 3, AugustusPower::TWOLEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 17, AugustusColor::ROSE, NULL, 8, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 18, AugustusColor::SENATOR, NULL, 8, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 19, AugustusColor::VERT, NULL, 3, AugustusPower::TWOLEGIONONTEACHES, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 20, AugustusColor::SENATOR, NULL, 3, AugustusPower::TWOLEGIONONTEACHES, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 21, AugustusColor::ROSE, NULL, 9, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 22, AugustusColor::SENATOR, NULL, 9, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 23, AugustusColor::VERT, NULL, 10, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 24, AugustusColor::ORANGE, AugustusResource::GOLD, 10, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 25, AugustusColor::SENATOR, NULL, 0, AugustusPower::TWOPOINTBYCHARIOT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 26, AugustusColor::VERT, AugustusResource::GOLD, 0, AugustusPower::TWOPOINTBYCHARIOT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 27, AugustusColor::SENATOR, NULL, 0, AugustusPower::THREEPOINTBYCATAPULT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 28, AugustusColor::ROSE, NULL, 0, AugustusPower::THREEPOINTBYCATAPULT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 29, AugustusColor::SENATOR, NULL, 4, AugustusPower::TWOLEGIONONSHIELD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 30, AugustusColor::VERT, NULL, 4, AugustusPower::TWOLEGIONONSHIELD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 31, AugustusColor::ROSE, NULL, 4, AugustusPower::SHIELDISCHARIOT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 32, AugustusColor::SENATOR, NULL, 4, AugustusPower::SHIELDISCHARIOT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 33, AugustusColor::VERT, NULL, 5, AugustusPower::TWOLEGIONONKNIFE, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 34, AugustusColor::SENATOR, NULL, 5, AugustusPower::TWOLEGIONONKNIFE, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 35, AugustusColor::ROSE, NULL, 5, AugustusPower::ONECARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 36, AugustusColor::SENATOR, NULL, 5, AugustusPower::ONECARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 37, AugustusColor::VERT, NULL, 6, AugustusPower::REMOVEONELEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 38, AugustusColor::ORANGE, NULL, 6, AugustusPower::REMOVEONELEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 39, AugustusColor::SENATOR, NULL, 11, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 40, AugustusColor::VERT, AugustusResource::WHEAT, 11, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 41, AugustusColor::SENATOR, NULL, 2, AugustusPower::REMOVETWOLEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 42, AugustusColor::VERT, NULL, 2, AugustusPower::REMOVETWOLEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 43, AugustusColor::SENATOR, NULL, 2, AugustusPower::MOVELEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 44, AugustusColor::ROSE, NULL, 2, AugustusPower::MOVELEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 45, AugustusColor::ROSE, AugustusResource::GOLD, 6, AugustusPower::ONELEGIONONANYTHING, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 46, AugustusColor::SENATOR, NULL, 6, AugustusPower::ONELEGIONONANYTHING, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 47, AugustusColor::VERT, NULL, 0, AugustusPower::TWOPOINTBYGREENCARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 48, AugustusColor::SENATOR, NULL, 0, AugustusPower::TWOPOINTBYSENATORCARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 49, AugustusColor::ROSE, NULL, 0, AugustusPower::FOURPOINTBYPINKCARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 50, AugustusColor::SENATOR, NULL, 12, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 51, AugustusColor::VERT, NULL, 5, AugustusPower::TWOLEGIONONCHARIOT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 52, AugustusColor::ORANGE, NULL, 5, AugustusPower::TWOLEGIONONCHARIOT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 53, AugustusColor::SENATOR, NULL, 0, AugustusPower::THREEPOINTBYTEACHES, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 54, AugustusColor::VERT, NULL, 0, AugustusPower::THREEPOINTBYTEACHES, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 55, AugustusColor::SENATOR, NULL, 5, AugustusPower::CHARIOTISCATAPULT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 56, AugustusColor::ROSE, NULL, 5, AugustusPower::CHARIOTISCATAPULT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 57, AugustusColor::SENATOR, NULL, 13, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 58, AugustusColor::VERT, NULL, 13, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 59, AugustusColor::ROSE, NULL, 7, AugustusPower::TWOLEGIONONCATAPULT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 60, AugustusColor::SENATOR, NULL, 7, AugustusPower::TWOLEGIONONCATAPULT, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 61, AugustusColor::VERT, NULL, 14, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::KNIFE);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 62, AugustusColor::ORANGE, NULL, 14, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 63, AugustusColor::VERT, AugustusResource::GOLD, 0, AugustusPower::FOURPOINTBYKNIFE, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 64, AugustusColor::SENATOR, NULL, 0, AugustusPower::FIVEPOINTBYREDCARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 65, AugustusColor::VERT, NULL, 0, AugustusPower::FOURPOINTBYKNIFE, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 66, AugustusColor::ROSE, NULL, 0, AugustusPower::FOURPOINTBYPINKCARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 67, AugustusColor::SENATOR, NULL, 0, AugustusPower::TWOPOINTBYSENATORCARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 68, AugustusColor::VERT, AugustusResource::BOTH, 0, AugustusPower::TWOPOINTBYGREENCARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 69, AugustusColor::ORANGE, AugustusResource::GOLD, 0, AugustusPower::SIXPOINTBYORANGECARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 70, AugustusColor::VERT, NULL, 3, AugustusPower::TWOLEGIONONANYTHING, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 71, AugustusColor::SENATOR, NULL, 0, AugustusPower::FIVEPOINTBYREDCARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 72, AugustusColor::VERT, NULL, 3, AugustusPower::TWOLEGIONONANYTHING, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 73, AugustusColor::ROSE, NULL, 7, AugustusPower::CATAPULTISTEACHES, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 74, AugustusColor::SENATOR, NULL, 7, AugustusPower::CATAPULTISTEACHES, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 75, AugustusColor::VERT, NULL, 5, AugustusPower::REMOVEALLLEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 76, AugustusColor::ORANGE, NULL, 5, AugustusPower::REMOVEALLLEGION, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 77, AugustusColor::ROSE, NULL, 15, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CHARIOT);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 78, AugustusColor::SENATOR, NULL, 15, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 79, AugustusColor::VERT, NULL, 16, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 80, AugustusColor::ROSE, NULL, 16, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 81, AugustusColor::SENATOR, NULL, 5, AugustusPower::REMOVEONECARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::DOUBLESWORD);
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugustusToken::CHARIOT);
    $toCapture->add(AugustusToken::CATAPULT);
    $toCapture->add(AugustusToken::TEACHES);
    $toCapture->add(AugustusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 82, AugustusColor::ROSE, NULL, 5, AugustusPower::REMOVEONECARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 83, AugustusColor::ORANGE, NULL, 0, AugustusPower::SIXPOINTBYORANGECARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugustusToken::SHIELD);
    $toCapture->add(AugutusToken::CATAPULT);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 84, AugustusColor::VERT, NULL, 12, NULL, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 85, AugustusColor::SENATOR, NULL, 10, AugustusPower::TEACHESISKNIFE, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 86, AugustusColor::ROSE, AugustusResource::WHEAT, 10, AugustusPower::TEACHESISKNIFE, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 87, AugustusColor::ORANGE, AugustusResource::BOTH, 4, AugustusPower::COMPLETECARD, $toCapture->toArray()));
    
    $toCapture->clear();
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::TEACHES);
    $toCapture->add(AugutusToken::KNIFE);
    $toCapture->add(AugutusToken::KNIFE);
    $this->deck->add(new \AGORA\Game\AugustusBundle\Entity\Card($this->id, 88, AugustusColor::SENATOR, NULL, 6, AugustusPower::COMPLETECARD, $toCapture->toArray()));
    
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

    /**
     * Set tokenBag.
     *
     * @param array $tokenBag
     *
     * @return AugustusBoard
     */
    public function setTokenBag($tokenBag)
    {
        $this->tokenBag = $tokenBag;

        return $this;
    }

    /**
     * Add deck.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusCard $deck
     *
     * @return AugustusBoard
     */
    public function addDeck(\AGORA\Game\AugustusBundle\Entity\AugustusCard $deck)
    {
        $this->deck[] = $deck;

        return $this;
    }

    /**
     * Remove deck.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusCard $deck
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDeck(\AGORA\Game\AugustusBundle\Entity\AugustusCard $deck)
    {
        return $this->deck->removeElement($deck);
    }

    /**
     * Add objLine.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusCard $objLine
     *
     * @return AugustusBoard
     */
    public function addObjLine(\AGORA\Game\AugustusBundle\Entity\AugustusCard $objLine)
    {
        $this->objLine[] = $objLine;

        return $this;
    }

    /**
     * Remove objLine.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusCard $objLine
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeObjLine(\AGORA\Game\AugustusBundle\Entity\AugustusCard $objLine)
    {
        return $this->objLine->removeElement($objLine);
    }

    /**
     * Set game.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusGame|null $game
     *
     * @return AugustusBoard
     */
    public function setGame(\AGORA\Game\AugustusBundle\Entity\AugustusGame $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game.
     *
     * @return \AGORA\Game\AugustusBundle\Entity\AugustusGame|null
     */
    public function getGame()
    {
        return $this->game;
    }
}
