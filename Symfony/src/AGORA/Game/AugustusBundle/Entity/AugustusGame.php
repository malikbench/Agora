<?php

namespace AGORA\Game\AugustusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AugustusGame
 *
 * @ORM\Table(name="augustus_game")
 * @ORM\Entity(repositoryClass="AGORA\Game\AugustusBundle\Repository\AugustusGameRepository")
 */
class AugustusGame
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
     * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusPlayer", mappedBy="game", cascade={"persist"})
     */
    private $players;

    /**
     * @ORM\OneToOne(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusBoard", mappedBy="game")
     */
    private $board;

    /**
     * @var enum
     *
     * @ORM\Column(name="token", type="string")
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string")
     */
    private $state;

    /**
     * @var int
     *
     * @ORM\Column(name="affectedPlayer", type="integer")
     */
    private $affectedPlayer;

    /**
     * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusPlayer", mappedBy="game", cascade={"persist"})
     */
    private $colorLoot;

    /**
     * @var array
     *
     * @ORM\Column(name="nextStates", type="array")
     */
    private $nextStates;

    /**
     * @var array
     *
     * @ORM\Column(name="nextAffecteds", type="array")
    */
   private $nextAffecteds;

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
     * Add player.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\Player $player
     *
     * @return AugustusPlayer
     */
    public function addPlayer(\AGORA\Game\AugustusBundle\Entity\Player $player)
    {
        $this->players[] = $player;
        return $this;
    }

    /**
     * Remove player.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\Player $player
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePlayer(\AGORA\Game\AugustusBundle\Entity\Player $player)
    {
        return $this->players->removeElement($player);
    }

    /**
     * Get players.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set board.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusBoard|null $board
     *
     * @return AugustusGame
     */
    public function setBoard(\AGORA\Game\AugustusBundle\Entity\AugustusBoard $board = null)
    {
        $this->board = $board;

        return $this;
    }

    /**
     * Get board.
     *
     * @return \AGORA\Game\AugustusBundle\Entity\AugustusBoard|null
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * Set token.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusToken|null $token
     *
     * @return AugustusGame
     */
    public function setToken(\AGORA\Game\AugustusBundle\Entity\AugustusToken $token = null)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token.
     *
     * @return \AGORA\Game\AugustusBundle\Entity\AugustusToken|null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set state.
     *
     * @param string $state
     *
     * @return AugustusGame
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set affectedPlayer.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusPlayer|null $affectedPlayer
     *
     * @return AugustusGame
     */
    public function setAffectedPlayer(\AGORA\Game\AugustusBundle\Entity\AugustusPlayer $affectedPlayer = null)
    {
        $this->affectedPlayer = $affectedPlayer;

        return $this;
    }

    /**
     * Get affectedPlayer.
     *
     * @return \AGORA\Game\AugustusBundle\Entity\AugustusPlayer|null
     */
    public function getAffectedPlayer()
    {
        return $this->affectedPlayer;
    }

    /**
     * Add colorLoot.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusPlayer $colorLoot
     *
     * @return AugustusGame
     */
    public function addColorLoot(\AGORA\Game\AugustusBundle\Entity\AugustusPlayer $colorLoot)
    {
        $this->colorLoot[] = $colorLoot;

        return $this;
    }

    /**
     * set colorLoot.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusPlayer $colorLoot
     *
     * @return AugustusGame
     */
    public function setColorLoot(\AGORA\Game\AugustusBundle\Entity\AugustusPlayer $colorLoot)
    {
        $this->colorLoot = $colorLoot;

        return $this;
    }

    /**
     * Remove colorLoot.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusPlayer $colorLoot
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeColorLoot(\AGORA\Game\AugustusBundle\Entity\AugustusPlayer $colorLoot)
    {
        return $this->colorLoot->removeElement($colorLoot);
    }

    /**
     * Get colorLoot.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getColorLoot()
    {
        return $this->colorLoot;
    }

    /**
     * Add nextState.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\integer $nextState
     *
     * @return AugustusGame
     */
    public function addNextState(\AGORA\Game\AugustusBundle\Entity\integer $nextState)
    {
        $this->nextStates[] = $nextState;

        return $this;
    }

    /**
     * Remove nextState.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\integer $nextState
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeNextState(\AGORA\Game\AugustusBundle\Entity\integer $nextState)
    {
        return $this->nextStates->removeElement($nextState);
    }

    /**
     * Get nextStates.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNextStates()
    {
        return $this->nextStates;
    }

    /**
     * Add nextAffected.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\integer $nextAffected
     *
     * @return AugustusGame
     */
    public function addNextAffected(\AGORA\Game\AugustusBundle\Entity\integer $nextAffected)
    {
        $this->nextAffecteds[] = $nextAffected;

        return $this;
    }

    /**
     * Remove nextAffected.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\integer $nextAffected
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeNextAffected(\AGORA\Game\AugustusBundle\Entity\integer $nextAffected)
    {
        return $this->nextAffecteds->removeElement($nextAffected);
    }

    /**
     * Get nextAffecteds.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNextAffecteds()
    {
        return $this->nextAffecteds;
    }

    /**
     * Set nextStates.
     *
     * @param array $nextStates
     *
     * @return AugustusGame
     */
    public function setNextStates($nextStates)
    {
        $this->nextStates = $nextStates;

        return $this;
    }

    /**
     * Set nextAffecteds.
     *
     * @param array $nextAffecteds
     *
     * @return AugustusGame
     */
    public function setNextAffecteds($nextAffecteds)
    {
        $this->nextAffecteds = $nextAffecteds;

        return $this;
    }
}
