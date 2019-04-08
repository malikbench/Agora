<?php

namespace AGORA\Game\SplendorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SplendorGame
 *
 * @ORM\Table(name="splendor_game")
 * @ORM\Entity(repositoryClass="AGORA\Game\SplendorBundle\Repository\SplendorGameRepository")
 */
class SplendorGame
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
     * @var string
     *
     * [emeraldTokens, sapphireTokens, rubyTokens, diamondTokens, onyxTokens, JokerGoldTokens]
     *
     * @ORM\Column(name="listTokens", type="string", length=50)
     */
    private $listTokens;

    /**
     * @var string
     *
     * @ORM\Column(name="idCards", type="string", length=50)
     */
    private $idCards;

    /**
     * @var string
     *
     * @ORM\Column(name="idNobles", type="string", length=50)
     */
    private $idNobles;


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
     * Set listTokens.
     *
     * @param string $listTokens
     *
     * @return SplendorGame
     */
    public function setListTokens($listTokens)
    {
        $this->listTokens = $listTokens;

        return $this;
    }

    /**
     * Get listTokens.
     * [emeraldTokens, sapphireTokens, rubyTokens, diamondTokens, onyxTokens, JokerGoldTokens]
     *
     * @return array
     */
    public function getListTokens()
    {
        return array_map('intval', explode(',', $this->listTokens));
    }

    /**
     * Set idCards.
     *
     * @param string $idCards
     *
     * @return SplendorGame
     */
    public function setIdCards($idCards)
    {
        $this->idCards = $idCards;

        return $this;
    }

    /**
     * Get idCards.
     *
     * @return array
     */
    public function getIdCards()
    {
        return array_map('intval', explode(',', $this->idCards));

    }

    /**
     * Set idNobles.
     *
     * @param string $idNobles
     *
     * @return SplendorGame
     */
    public function setIdNobles($idNobles)
    {
        $this->idNobles = $idNobles;

        return $this;
    }

    /**
     * Get idNobles.
     *
     * @return array
     */
    public function getIdNobles()
    {
        return array_map('intval', explode(',', $this->idNobles));
    }
}
