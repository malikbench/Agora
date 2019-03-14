<?php

namespace AGORA\Game\AugustusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AugustusCard
 *
 * @ORM\Table(name="augustus_card")
 * @ORM\Entity(repositoryClass="AGORA\Game\AugustusBundle\Repository\AugustusCardRepository")
 */
class AugustusCard
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
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @ORM\ManyToOne(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusBoard", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
    */
    private $board;

    /**
     * @var array
     *
     * @ORM\Column(name="tokens", type="array")
     */
    private $tokens;

    /**
     * @var array
     *
     * @ORM\Column(name="power", type="AugustusPower")
     */
    private $power;

    /**
     * @var array
     *
     * @ORM\Column(name="ctrlTokens", type="array")
     */
    private $ctrlTokens;

    /**
     * @ORM\ManyToOne(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusCard", mappedBy="ctrlCards", cascade={"persist"})
     */
    private $player;

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
     * Set number.
     *
     * @param int $number
     *
     * @return AugustusCard
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number.
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set points.
     *
     * @param int $points
     *
     * @return AugustusCard
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points.
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }


    /**
     * Set tokens.
     *
     * @param array $tokens
     *
     * @return AugustusCard
     */
    public function setTokens($tokens)
    {
        $this->tokens = $tokens;

        return $this;
    }

    /**
     * Get tokens.
     *
     * @return array
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * Set ctrlTokens.
     *
     * @param array $ctrlTokens
     *
     * @return AugustusCard
     */
    public function setCtrlTokens($ctrlTokens)
    {
        $this->ctrlTokens = $ctrlTokens;

        return $this;
    }

    /**
     * Get ctrlTokens.
     *
     * @return array
     */
    public function getCtrlTokens()
    {
        return $this->ctrlTokens;
    }

    /**
     * Set board.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\AugustusBoard $board
     *
     * @return AugustusCard
     */
    public function setBoard(\AGORA\Game\AugustusBundle\Entity\AugustusBoard $board)
    {
        $this->board = $board;

        return $this;
    }

    /**
     * Get board.
     *
     * @return \AGORA\Game\AugustusBundle\Entity\AugustusBoard
     */
    public function getBoard()
    {
        return $this->board;
    }
}
