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

}
