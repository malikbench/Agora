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
     * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusPlayer", mappedBy="game")
     */
    private $players;

    /**
     * @ORM\OneToOne(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusBoard", mappedBy="game")
     */
    private $board;

    /**
     * @ORM\OneToOne(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusToken", mappedBy="game")
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
    * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusPlayer", mappedBy="game")
    */
   private $colorLoot;

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
        $board = new Board();
        $colorLoot = array("senator" => null, "green" => null, "pink" => null, "orange" => null, "all" => null);
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
}
