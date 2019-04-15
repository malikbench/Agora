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

//    private $cardsValues = [[0, 1, 1, 1, 1], [0, 1, 1, 1, 2], [0, 1, 2, 0, 2], [1, 3, 0, 1, 0], [0, 1, 0, 2, 0],
//        [0, 2, 2, 0, 0], [0, 0, 3, 0, 0], [0, 0, 0, 0, 4],/**/ [1, 0, 1, 1, 1], [1, 0, 2, 1, 1], [2, 0, 2, 1, 0],
//        [3, 1, 1, 0, 0], [0, 0, 0, 1, 2], [2, 0, 0, 0, 2], [0, 0, 0, 0, 3], [0, 0, 4, 0, 0],/**/ [1, 1, 0, 1, 1],
//        [1, 1, 0, 2, 1], [1, 0, 0, 2, 2], [0, 0, 1, 1, 3], [1, 2, 0, 0, 0], [0, 0, 2, 2, 1], [0, 0, 0, 3, 0],
//        [0, 0, 0, 4, 0],/**/ [1, 1, 1, 0, 1], [2, 1, 1, 0, 1], [2, 2, 0, 0, 1], [0, 1, 0, 3, 1], [0, 0, 2, 0, 1],
//        [0, 2, 0, 0, 2], [0, 3, 0, 0, 0], [4, 0, 0, 0, 0],/**/ [1, 1, 1, 1, 0], [1, 2, 1, 1, 0], [0, 2, 1, 2, 0],
//        [1, 0, 3, 0, 1], [2, 0, 1, 0, 0], [2, 0, 0, 2, 0], [3, 0, 0, 0, 0], [0, 4, 0, 0, 0],/**/ [2, 0, 3, 3, 0],
//        [0, 3, 0, 2, 2], [0, 2, 0, 4, 1], [3, 5, 0, 0, 0], [5, 0, 0, 0, 0], [6, 0, 0, 0, 0],/**/ [2, 2, 3, 0, 0],
//        [3, 2, 0, 0, 3], [0, 3, 0, 5, 0], [0, 0, 1, 2, 4], [0, 5, 0, 0, 0], [0, 6, 0, 0, 0],/**/ [0, 0, 2, 2, 3],
//        [0, 3, 2, 0, 3], [2, 4, 0, 1, 0], [0, 0, 0, 3, 5], [0, 0, 0, 0, 5], [0, 0, 6, 0, 0],/**/ [3, 0, 2, 0, 2],
//        [0, 3, 3, 2, 0], [1, 0, 4, 0, 2], [0, 0, 5, 0, 3], [0, 0, 5, 0, 0], [0, 0, 0, 6, 0],/**/ [2, 2, 0, 3, 1],
//        [3, 0, 0, 3, 2], [4, 1, 2, 0, 0], [5, 0, 3, 0, 0], [0, 0, 0, 5, 0], [0, 0, 0, 0, 6],/**/ [0, 3, 3, 5, 3],
//        [0, 7, 0, 0, 0], [3, 6, 0, 3, 0], [3, 7, 0, 0, 0],/**/ [3, 0, 3, 3, 5], [0, 0, 0, 7, 0], [0, 3, 0, 6, 3],
//        [0, 3, 0, 7, 0],/**/ [3, 5, 0, 3, 3], [7, 0, 0, 0, 0], [6, 3, 3, 0, 0], [7, 0, 3, 0, 0],/**/ [3, 3, 5, 0, 3],
//        [0, 0, 0, 0, 7], [0, 0, 3, 3, 6], [0, 0, 0, 3, 7],/**/ [5, 3, 3, 3, 0], [0, 0, 7, 0, 0], [3, 0, 6, 0, 3],
//        [0, 0, 7, 0, 3],/**/ [4, 0, 4, 0, 0], [0, 0, 3, 3, 3], [0, 4, 0, 4, 0], [0, 0, 0, 4, 4], [4, 4, 0, 0, 0],
//        [3, 3, 3, 0, 0], [3, 3, 0, 3, 0], [0, 0, 4, 0, 4], [0, 3, 0, 3, 3], [3, 0, 3, 0, 3]];
//
//    private $cardBonus = ["Green", "Blue", "Red", "White", "Black", "Noble"];

    public function __construct(EntityManager $em)
    {
        $this->manager = $em;
    }


    /*public function createCards($idGame)
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

    }*/

    public function getRandomCard($gameId, $level) {
        $x = 1; $y = 40;
        switch ($level) {
            case 2: $x = 41; $y = 70;
            break;
            case 3: $x = 71; $y = 90;
            break;
            default: break;
        }
        $id = rand($x, $y);
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
                $id = rand($x, $y);
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
        $spldrGame->setIdUserTurn($userId);
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

    public function reserveCard($gameId, $userId, $cardId) {
        $game = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorGame')->find($gameId);
        if ($game->getIdUserTurn() != $userId) {
            return;
        }
        $cards = $game->getIdCards();
        $player = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorPlayer')
            ->findOneBy(array('gameId' => $gameId, 'idUser' => $userId));
        $i = array_search($cardId, $cards);
        $playerCard = $player->getReservedCards();
        //Si la carte est sur le plateau et que le joueur a moins de 3 cartes deja reservées
        if ($i != false && sizeof($playerCard) < 3) {
            //On calcul le niveau de la carte à piocher
            $level = (3 - intval($i / 4));
            //On pioche la carte qui va remplacer la carte reservée
            $newCard = $this->getRandomCard($gameId, $level);
            //On met la carte piochée à la place de celle réservée
            $cards[$i] = $newCard;
            $game->setIdCards($cards);

            $gameTokens = $game->getListTokens();
            //Si il reste des jetons or(joker) sur le plateau
            if ($gameTokens[5] > 0) {
                //Le joueur en prend un
                $tokens = $player->getListTokens();
                $tokens[5] += 1;
                $gameTokens[5] -= 1;
                $game->setListTokens(implode(",", $gameTokens));
                $player->setListTokens(implode(",", $tokens));
            }
            $this->manager->persist($game);
            $this->manager->flush();
            //On ajoute la carte réservée dans la main du joueur
            array_push($playerCard, $cardId);
            $player->setReservedCards(implode(",", $playerCard));

            $this->manager->persist($player);
            $this->manager->flush();

        }
    }

    public function buyCard($gameId, $userId, $cardId) {
        $game = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorGame')->find($gameId);
        if ($game->getIdUserTurn() != $userId) {
            return;
        }
        $player = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorPlayer')
            ->findOneBy(array('gameId' => $gameId, 'idUser' => $userId));
        $cardsGame = $game->getIdCards();
        $cardsReserved = $player->getReservedCards();
        $i = array_search($cardId, $cardsGame);
        $j = array_search($cardId, $cardsReserved);
        $playerCard = $player->getBuyedCards();
        $cardTable = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorCard')->find($cardId);
        $playerTokens = $player->getListTokens();
        $jokerNeed = 0;
        //On verifie si le joueur a les ressources necessaires
        for ($k = 0; $k < 5; $k++) {
            $tok = $cardTable->getTokens($k);
            if ($tok > $playerTokens[$k]) {
                $jokerNeed += ($tok - $playerTokens[$k]);
            } else {
                //On en profite pour mettre à jour les ressources du joueur
                $playerTokens[$k] = $playerTokens[$k] - $tok;
            }
        }
        //Si la carte est sur le plateau ou dans les carte réservé du joueur
        // et que le joueur a les ressources necessaires
        if (($i != false || $j != false) && $jokerNeed <= $playerTokens[5]) {
            //Si la carte est sur le plateau
            if ($i != false) {
                //On calcul le niveau de la carte à piocher
                $level = (3 - intval($i / 4));
                //On pioche la carte qui va remplacer la carte achetée
                $newCard = $this->getRandomCard($gameId, $level);
                //On met la carte piochée à la place de celle achetée
                $cards[$i] = $newCard;
                $game->setIdCards($cards);
                $this->manager->persist($game);
                $this->manager->flush();
            } else {
                //Si la carte est dans les cartes réservées du joueur
                //On la retire des cartes réservées
                array_splice($cardsReserved, $j, 1);
                $player->setReservedCards(implode(",", $cardsReserved));
            }

            //On ajoute la carte achetée dans la main du joueur
            array_push($playerCard, $cardId);
            $player->setBuyedCards(implode(",", $playerCard));
            //On retire les ressources joker necessaire pour l'achat
            $playerTokens[5] = $playerTokens[5] - $jokerNeed;
            $player->setListTokens(implode(",", $playerTokens));
            //On ajoute le prestige de la carte au joueur
            $player->setPrestige($player->getPrestige() + $cardTable->getPrestige());
            $this->manager->persist($player);
            $this->manager->flush();
        }
    }

    public function getTokens($gameId, $userId, $tokens) {
        $game = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorGame')->find($gameId);
        if ($game->getIdUserTurn() != $userId) {
            return;
        }
        $player = $this->manager->getRepository('AGORAGameSplendorBundle:SplendorPlayer')
            ->findOneBy(array('gameId' => $gameId, 'idUser' => $userId));
        $gameTokens = $game->getListTokens();
        $playerTokens = $player->getListTokens();
        $nbOne = 0;
        $nbTwo = 0;
        //On verifie que le joueur a le droit de prendre ces jetons
        for ($k = 0; $k < 5; $k++) {
            //Si il n'a pas le droit on return
            if ($tokens[$k] > $gameTokens[$k] || $tokens[$k] > 2 || ($tokens[$k] == 2 && $gameTokens[$k] < 4)
                || ($tokens[$k] == 2 && ($nbTwo + $nbOne) != 0) || ($tokens[$k] == 1 && ($nbTwo != 0 || $nbOne > 2))) {
                return;
            }
            if ($tokens[$k] == 1) {
                $nbOne++;
            }
            if ($tokens[$k] == 2) {
                $nbTwo++;
            }
            //Sinon on lui donne les jetons
            $playerTokens[$k] += $tokens[$k];
            //Et on les retire du plateau
            $gameTokens[$k] -= $tokens[$k];
        }

        $game->setListTokens(implode(",", $gameTokens));
        $this->manager->persist($game);
        $this->manager->flush();

        $player->setListTokens(implode(",", $playerTokens));
        $this->manager->persist($player);
        $this->manager->flush();

    }



}