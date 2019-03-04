<?php

namespace AGORA\Game\AugustusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AugustusBoard
 *
 * @ORM\Table(name="augustus_board")
 * @ORM\Entity(repositoryClass="AGORA\Game\AugustusBundle\Repository\AugustusBoardRepository")
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
    
    /**
     * @ORM\OneToMany(targetEntity="AGORA\Game\AugustusBundle\Entity\AugustusLoot", mappedBy="board")
     */
    private $lootPack;
    
    /**
     * Constructor
     * Il y a 88 objectifs (cartes) dans le deck au début d'une partie.
     * Il y a 5 objectifs sur le terrain en début d'une partie.
     * Il y a 23 jetons (tokens) dans le sac de token au début d'une partie.
     * Il y a 12 récompenses sur le terrain (loot) au début d'une partie.
     */
    public function __construct()
    {
        $this->deck = new \Doctrine\Common\Collections\ArrayCollection();
        $this->objLine = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tokenBag = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lootPack = new \Doctrine\Common\Collections\ArrayCollection();
        
        // Ici remplir les collections
        /**
         * Utiliser un while(fetch) pour récupérer toutes les cartes de la bdd et remplir le deck ?
         * 
         */
         while(1) {
           
         }
         
        // On remplit objLine avec 5 cartes que l'on prend du deck.
        for ($i = 0; $i < 5; $i++) {
          // Pour éviter les doublons décaler les indices ?
          $nbAlea = rand(1, 88-$i);
          addObjToLine($this->deck->get($nbAlea));
          removeCardFromDeck($this->deck->get($nbAlea));
        }
        
        // On remplit tokenBag avec les 23 tokens, on les place dans l'ordre car le tirage lui sera aléatoire.
        for ($i = 0; $i < 23; $i++) {
          // Ici vérifier l'ajout des token le for n'est pas bon.
          addTokenToBag(token::bouclier);
        }
        
        // On remplit le lootPack.
        // Les loots sont pas encore créés donc arbitrairement pour l'instant j'ai mis des int pour les différents types de loot.
        for ($i = 0; $i < 5; $i++) {
          addLootToPack(new Loot(0));
        }
        for ($i = 0; $i < 5; $i++) {
          addLootToPack(new Loot(1));
        }
        addLootToPack(new Loot(2));
        addLootToPack(new Loot(3));
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
     * Get token bag.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTokenBag()
    {
        return $this->tokenBag;
    }
    
    /**
     * Add loot to pack.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\Loot $loot
     *
     * @return boolean TRUE if this element is added, FALSE otherwise.
     */
    public function addLootToPack(\AGORA\Game\AugustusBundle\Entity\Loot $loot)
    {
        return $this->lootPack->add($loot);
    }

    /**
     * Remove loot from pack.
     *
     * @param \AGORA\Game\AugustusBundle\Entity\Loot $loot
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeLootFromPack(\AGORA\Game\AugustusBundle\Entity\Loot $loot)
    {
        return $this->lootPack->removeElement($loot);
    }

    /**
     * Get loot pack.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLootPack()
    {
        return $this->lootPack;
    }
}
