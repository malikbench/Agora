<?php


namespace AGORA\Game\SplendorBundle\Service;


use AGORA\Game\GameBundle\Entity\Game;
use AGORA\Game\SplendorBundle\Entity\SplendorCard;
use AGORA\Game\SplendorBundle\Entity\SplendorGame;
use AGORA\Game\SplendorBundle\Entity\SplendorPlayer;
use Doctrine\ORM\EntityManager;

class SplendorService
{

    protected $manager;

    private $cardsValues = [[0, 1, 1, 1, 1], [0, 1, 1, 1, 2], [0, 1, 2, 0, 2], [1, 3, 0, 1, 0], [0, 1, 0, 2, 0],
        [0, 2, 2, 0, 0], [0, 0, 3, 0, 0], [0, 0, 0, 0, 4],/**/ [1, 0, 1, 1, 1], [1, 0, 2, 1, 1], [2, 0, 2, 1, 0],
        [3, 1, 1, 0, 0], [0, 0, 0, 1, 2], [2, 0, 0, 0, 2], [0, 0, 0, 0, 3], [0, 0, 4, 0, 0],/**/ [1, 1, 0, 1, 1],
        [1, 1, 0, 2, 1], [1, 0, 0, 2, 2], [0, 0, 1, 1, 3], [1, 2, 0, 0, 0], [0, 0, 2, 2, 1], [0, 0, 0, 3, 0],
        [0, 0, 0, 4, 0],/**/ [1, 1, 1, 0, 1], [2, 1, 1, 0, 1], [2, 2, 0, 0, 1], [0, 1, 0, 3, 1], [0, 0, 2, 0, 1],
        [0, 2, 0, 0, 2], [0, 3, 0, 0, 0], [4, 0, 0, 0, 0],/**/ [1, 1, 1, 1, 0], [1, 2, 1, 1, 0], [0, 2, 1, 2, 0],
        [1, 0, 3, 0, 1], [2, 0, 1, 0, 0], [2, 0, 0, 2, 0], [3, 0, 0, 0, 0], [0, 4, 0, 0, 0],/**/ [2, 0, 3, 3, 0],
        [0, 3, 0, 2, 2], [0, 2, 0, 4, 1], [3, 5, 0, 0, 0], [5, 0, 0, 0, 0], [6, 0, 0, 0, 0],/**/ [2, 2, 3, 0, 0],
        [3, 2, 0, 0, 3], [0, 3, 0, 5, 0], [0, 0, 1, 2, 4], [0, 5, 0, 0, 0], [0, 6, 0, 0, 0],/**/ [0, 0, 2, 2, 3],
        [0, 3, 2, 0, 3], [2, 4, 0, 1, 0], [0, 0, 0, 3, 5], [0, 0, 0, 0, 5], [0, 0, 6, 0, 0],/**/ [3, 0, 2, 0, 2],
        [0, 3, 3, 2, 0], [1, 0, 4, 0, 2], [0, 0, 5, 0, 3], [0, 0, 5, 0, 0], [0, 0, 0, 6, 0],/**/ [2, 2, 0, 3, 1],
        [3, 0, 0, 3, 2], [4, 1, 2, 0, 0], [5, 0, 3, 0, 0], [0, 0, 0, 5, 0], [0, 0, 0, 0, 6],/**/ [0, 3, 3, 5, 3],
        [0, 7, 0, 0, 0], [3, 6, 0, 3, 0], [3, 7, 0, 0, 0],/**/ [3, 0, 3, 3, 5], [0, 0, 0, 7, 0], [0, 3, 0, 6, 3],
        [0, 3, 0, 7, 0],/**/ [3, 5, 0, 3, 3], [7, 0, 0, 0, 0], [6, 3, 3, 0, 0], [7, 0, 3, 0, 0],/**/ [3, 3, 5, 0, 3],
        [0, 0, 0, 0, 7], [0, 0, 3, 3, 6], [0, 0, 0, 3, 7],/**/ [5, 3, 3, 3, 0], [0, 0, 7, 0, 0], [3, 0, 6, 0, 3],
        [0, 0, 7, 0, 3],/**/ [4, 0, 4, 0, 0], [0, 0, 3, 3, 3], [0, 4, 0, 4, 0], [0, 0, 0, 4, 4], [4, 4, 0, 0, 0],
        [3, 3, 3, 0, 0], [3, 3, 0, 3, 0], [0, 0, 4, 0, 4], [0, 3, 0, 3, 3], [3, 0, 3, 0, 3]];

    private $cardBonus = ["Green", "Blue", "Red", "White", "Black", "Noble"];

    public function __construct(EntityManager $em)
    {
        $this->manager = $em;
    }


    public function createCards($idGame)
    {
        $level = 1;
        $i = 0;
        $j = 0;
        for ($k = 0; $k < 100; $k++) {
            $cards = new SplendorCard();
            $prestige = 0;
            if ($k >= 40) {
                $prestige = 1;
            }
            if ($k >= 70) {
                $prestige = 3;
            }
            if ($k == 40) {
                $level = 2;
                $j = -1;
            }
            if ($k == 70) {
                $level = 3;
                $j = -1;
            }
            if ($k == 90) {
                $level = 0;
                $j = 5;
            }
            if (($level == 1 && $i >= 8) || ($level == 2 && $i >= 6) || ($level == 3 && $i >= 4)) {
                $i = 0;
                $j++;
            }
            if ($level == 1 && $i == 7) {
                $prestige = 1;
            }
            if ($level == 2 && $i >= 2) {
                $prestige = 2;
            }
            if ($level == 2 && $i == 5) {
                $prestige = 3;
            }
            if ($level == 3 && $i >= 1) {
                $prestige = 4;
            }
            if ($level == 3 && $i == 3) {
                $prestige = 5;
            }
            if ($j < 0) {
                $j = 0;
            }
            $cards->setGameId($idGame);
            $cards->setLevel($level);
            $cards->setBonus($this->cardBonus[$j]);
            $cards->setPrestige($prestige);
            $cards->setEmeraldTokens($this->cardsValues[$k][0]);
            $cards->setSapphireTokens($this->cardsValues[$k][1]);
            $cards->setRubyTokens($this->cardsValues[$k][2]);
            $cards->setDiamondTokens($this->cardsValues[$k][3]);
            $cards->setOnyxTokens($this->cardsValues[$k][4]);
            $this->manager->persist($cards);
            $this->manager->flush();

            $i++;
        }


    }

    public function getRandomCard($gameId) {
        $id = rand(0, 89);
        if ($gameId >= 0 && $gameId != null) {
            $game = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorGame');
            $boardCards = $game->find($gameId)->getIdCards();
            $allPlayers = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorPlayer');
            $players = $allPlayers->findBy(array('gameId' => $gameId));
            $playersCards = [];
            foreach ($players as $p) {
                $playersCards = array_merge($playersCards, $p->getBuyedCards(), $p->getReservedCards());
            }
            $cards = array_merge($playersCards, $boardCards);
            while (in_array($id, $cards)) {
                $id = rand(0, 89);
            }
        }
        return $id;

    }

    public function getTwelveRandomCards() {
        $cards = [];
        for ($k = 0; $k < 12; $k++) {
            do {
                $id = rand(1, 90);
            } while (in_array($id, $cards));
            array_push($cards, $id);
        }
        return $cards;
    }

    public function getRandomNobles($nb) {
        $ids = [];
        for ($k = 0; $k < $nb; $k++) {
            do {
                $id = rand(91, 100);
            } while (in_array($id, $ids));
            array_push($ids, $id);
        }
        return $ids;
    }

    public function createGame($name, $playersNb, $private, $password = "", $userId) {
        $spldrGame = new SplendorGame();
        $cardsId = $this->getTwelveRandomCards();
        $spldrGame->setIdCards(implode(",", $cardsId));
        $nobles = $this->getRandomNobles($playersNb + 1);
        $spldrGame->setIdNobles(implode(",", $nobles));

        switch ($playersNb) {
            case 4: $spldrGame->setListTokens("7,7,7,7,7,5");
            break;
            case 3: $spldrGame->setListTokens("5,5,5,5,5,5");
            break;
            case 2: $spldrGame->setListTokens("4,4,4,4,4,5");
            break;
        }
        $this->manager->persist($spldrGame);
        $this->manager->flush();

        $game = new Game();
        $game->setGameId($spldrGame->getId());
        $gameInfoManager = $this->manager->getRepository('AGORAPlatformBundle:GameInfo');
        $gameInfo = $gameInfoManager->findOneBy(array('gameCode' => "spldr"));
        $game->setGameInfoId($gameInfo);
        $game->setName($name);
        $game->setNbPlayers($playersNb);
        $game->setIdHost($userId);
        // TODO hachage password
        $game->setPassword($password);
        $game->setPrivate($private);
        $game->setState("waiting");
        $game->setDateCrea(new \DateTime("now"));
        $this->manager->persist($game);
        $this->manager->flush();

        return $game->getGameId();

    }

    public function createPlayer($gameId, $userId) {
        $player = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorPlayer')
            ->findOneBy(array('gameId' => $gameId, 'idUser' => $userId));

        if ($player == null) {
            $spldrPlayer = new SplendorPlayer();
            $spldrPlayer->setGameId($gameId);
            $spldrPlayer->setIdUser($userId);
            $spldrPlayer->setPrestige(0);
            $spldrPlayer->setListTokens("0,0,0,0,0,0");
            $spldrPlayer->setBuyedCards("");
            $spldrPlayer->setReservedCards("");
            $this->manager->persist($spldrPlayer);
            $this->manager->flush();
        }
    }

    public function getAllPlayers($gameId) {
        $this->manager->flush();
        $players = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorPlayer')
            ->findBy(array('gameId' => $gameId));
        return $players;

    }

    public function getGame($gameId) {
        $this->manager->flush();
        $game = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorGame')->find($gameId);
        return $game;
    }


}