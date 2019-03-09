<?php

namespace AGORA\Game\AugustusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AugustusPlayer
 *
 * @ORM\Table(name="augustus_player")
 * @ORM\Entity(repositoryClass="AGORA\Game\AugustusBundle\Repository\AugustusPlayerRepository")
 */
class AugustusPlayer
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
     * @var int
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

    /**
     * @var int
     *
     * @ORM\Column(name="legion", type="integer")
     */
    private $legion;

    /**
     * @var int
     *
     * @ORM\Column(name="legionMax", type="integer")
     */
    private $legionMax;

    /**
     * @var int
     *
     * @ORM\Column(name="wheat", type="integer")
     */
    private $wheat;

    /**
     * @var int
     *
     * @ORM\Column(name="gold", type="integer")
     */
    private $gold;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isLock", type="boolean")
     */
    private $isLock;

    /**
     * @var array
     *
     * @ORM\Column(name="history", type="array")
     */
    private $history;

    /**
     * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusCard", mappedBy="player", cascade={"persist"})
     */
    private $cards;

    /**
     * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusCard", mappedBy="player", cascade={"persist"})
     */
    private $ctrlCards;

    /**
     * @ORM\ManyToOne(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusGame", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
    */
    private $game;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cards = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ctrlCards = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gold = 0;
        $this->wheat = 0;
        $this->legion = 7;
        $this->legionMax = 7;
        $this->score = 0;
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
     * Set score.
     *
     * @param int $score
     *
     * @return AugustusPlayer
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score.
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set legion.
     *
     * @param int $legion
     *
     * @return AugustusPlayer
     */
    public function setLegion($legion)
    {
        $this->legion = $legion;

        return $this;
    }

    /**
     * Get legion.
     *
     * @return int
     */
    public function getLegion()
    {
        return $this->legion;
    }

    /**
     * Set legionMax.
     *
     * @param int $legionMax
     *
     * @return AugustusPlayer
     */
    public function setLegionMax($legionMax)
    {
        $this->legionMax = $legionMax;

        return $this;
    }

    /**
     * Get legionMax.
     *
     * @return int
     */
    public function getLegionMax()
    {
        return $this->legionMax;
    }

    /**
     * Set wheat.
     *
     * @param int $wheat
     *
     * @return AugustusPlayer
     */
    public function setWheat($wheat)
    {
        $this->wheat = $wheat;

        return $this;
    }

    /**
     * Get wheat.
     *
     * @return int
     */
    public function getWheat()
    {
        return $this->wheat;
    }

    /**
     * Set gold.
     *
     * @param int $gold
     *
     * @return AugustusPlayer
     */
    public function setGold($gold)
    {
        $this->gold = $gold;

        return $this;
    }

    /**
     * Get gold.
     *
     * @return int
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Add card.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\Card $card
     *
     * @return AugustusPlayer
     */
    public function addCard(\AGORA\Game\AugustusBundle\Entity\Card $card)
    {
        $this->cards[] = $card;

        // Attention on ajoute ici le joueur à la carte il faut donc absolument pas ajouter
        // la carte au joueur dans la fonction setPlayer de Card.
        $cards->setPlayer($this);

        return $this;
    }

    /**
     * Remove card.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\Card $card
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCard(\AGORA\Game\AugustusBundle\Entity\Card $card)
    {
        return $this->cards->removeElement($card);
    }

    /**
     * Get cards.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCards()
    {
        return $this->cards;
    }


    /**
     * Set game.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusGame $game
     *
     * @return AugustusPlayer
     */
    public function setGame(\AGORA\Game\AugustusBundle\Entity\AugustusGame $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game.
     *
     * @return \AGORA\Game\AugustusBundle\Entity\AugustusGame
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set isLock.
     *
     * @param bool $isLock
     *
     * @return AugustusPlayer
     */
    public function setIsLock($isLock)
    {
        $this->isLock = $isLock;
        $this->$history = null;
        return $this;
    }

    /**
     * Get isLock.
     *
     * @return bool
     */
    public function getIsLock()
    {
        return $this->isLock;
    }

    /**
     * Set history.
     *
     * @param array $history
     *
     * @return AugustusPlayer
     */
    public function setHistory($history)
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get history.
     *
     * @return array
     */
    public function getHistory()
    {
        return $this->history;
    }
}
