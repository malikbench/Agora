<?php

namespace AGORA\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Leaderboard
 *
 * @ORM\Table(name="leaderboard")
 * @ORM\Entity(repositoryClass="AGORA\PlatformBundle\Repository\LeaderboardRepository")
 */
class Leaderboard
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
     * 
     * @ORM\ManyToOne(targetEntity="AGORA\UserBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPlayer;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AGORA\PlatformBundle\Entity\GameInfo", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idGame;

    /**
     * @var int
     *
     * @ORM\Column(name="elo", type="integer")
     */
    private $elo;

    /**
     * @var int
     *
     * @ORM\Column(name="nbVic", type="integer")
     */
    private $nbVic;

    /**
     * @var int
     *
     * @ORM\Column(name="nbDef", type="integer")
     */
    private $nbDef;

     /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Leaderboard
     */
    public function setId($id)
    {
        return $this;
    }

    /**
     * Get nbDef
     *
     * @return int
     */
    public function getNbDef()
    {
        return $this->nbDef;
    }

     /**
     * Set nbDef
     *
     * @param integer $nbDef
     *
     * @return Leaderboard
     */
    public function setNbDef($nbDef)
    {
        $this->nbDef = $nbDef;

        return $this;
    }

     /**
     * Get nbVic
     *
     * @return int
     */

     public function getNbVic()
    {
        return $this->nbVic;
    }

    /**
     * Set nbVic
     *
     * @param integer $nbVic
     *
     * @return Leaderboard
     */
    public function setNbVic($nbVic)
    {
        $this->nbVic = $nbVic;

        return $this;
    }

    /**
     * Get idPlayer
     *
     * @return int
     */
    public function getIdPlayer()
    {
        return $this->idPlayer;
    }

    /**
     * Set idPlayer
     *
     * @param integer $idPlayer
     *
     * @return Leaderboard
     */
    public function setIdPlayer($idPlayer)
    {
        $this->idPlayer = $idPlayer;

        return $this;
    }

    /**
     * Set idGame
     *
     * @param integer $idGame
     *
     * @return Leaderboard
     */
    public function setIdGame($idGame)
    {
        $this->idGame = $idGame;

        return $this;
    }

    /**
     * Get idGame
     *
     * @return int
     */
    public function getIdGame()
    {
        return $this->idGame;
    }

    /**
     * Set elo
     *
     * @param integer $elo
     *
     * @return Leaderboard
     */
    public function setElo($elo)
    {
        $this->elo = $elo;

        return $this;
    }

    /**
     * Get elo
     *
     * @return int
     */
    public function getElo()
    {
        return $this->elo;
    }
}
