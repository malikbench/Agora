<?php

namespace AGORA\Game\AugustusBundle\Service;

use AGORA\Game\AugustusBundle\Entity\AugustusGame;

class AugustusService
{

    protected $manager;

    // $em est passé en argument dans services.yml
    public function __construct(EntityManager $em) {
        $this->manager = $em;
    }

$gameId = $service->createRoom($_POST['lobbyName'], $_POST['nbPlayers'], $private, $password, $user->getId());
        return $this->redirect($this->generateUrl('agora_game_join_aug' ,array(
            "gameId" => $gameId
        )));
    public function createRoom($name, $nbPlayers, $isPrivate, $password) {
        $gameModel = new AugustusGame();
    }

    //Fonction qui récupere le jeu en bdd
    public function getGame($gameId) {
        $game = $this->manager
            ->getRepository('AugustusBundle:AugustusGame')
            ->find($gameId);
        return $game;
    }

    //TODO
    public function createRoom($name, $playersNb, $private, $password, $userId) {
        $augGame = new AugustusGameModel();
        $this->manager->persist($augGame);
        $this->manager->flush();

        $game = new Game();
        $game->setGameId($augGame->getId());
        $gameInfoManager = $this->manager->getRepository('AGORAPlatformBundle:GameInfo');
        $gameInfo = $gameInfoManager->findOneBy(array('gameCode' => "aug"));
        $game->setGameInfoId($gameInfo);
        $game->setName($name);
        $game->setNbPlayers($playersNb);
        $game->setIdHost($userId);
        $game->setPassword($password);
        $game->setPrivate($private);
        $game->setState("waiting");
        $game->setDateCrea(new \DateTime("now"));
        $this->manager->persist($game);
        $this->manager->flush();

        return $game->getId();
    }
    //TODO
    public function joinLobbyAction(SessionInterface $session, $gameId) {
        //echo "Un autre game id : ".$gameId."\n";
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Accès refusé, l\'utilisateur n\'est pas connecté.');
        }

        ///initialise le joueur dans le classement Elo si c'est ça première partie
        $em = $this->getDoctrine()->getManager();
        if ($em->getRepository('AGORAPlatformBundle:Leaderboard')->findOneBy(array('idPlayer' => $user->getId(), 'idGame' => 1)) == null) {
            $lb = new Leaderboard;

            $g = $em->getRepository('AGORAPlatformBundle:GameInfo')->find(1); //avecesar est le premier jeu de gameinfo
            $lb -> setIdGame($g);

            $lb -> setIdPlayer($user);
            $lb -> setELO(2000);
            $lb -> setNbVic(0);
            $lb -> setNbDef(0);

            $em->persist($lb);
            $em->flush();
        }

        $service = $this->container->get('agora_game.ave_cesar');

        if (!$service->playerAlreadyCreated($gameId, $user->getId())) {
            $result = $service->createPlayer($user, $gameId);
        } else {
            return $this->redirect($this->generateUrl('agora_game_ave_cesar_homepage' ,array(
                "gameId" => $gameId
            )));
        }

        // Game Full
        if ($result == -1) {
            $this->redirect($this->generateUrl('agora_platform_joingame'));
        }

        return $this->redirect($this->generateUrl('agora_game_ave_cesar_homepage' ,array(
            "gameId" => $gameId
        )));
    }

    //TODO
    public function deleteAction($idGame) {
        $em = $this->getDoctrine()->getManager();
        $game = $em->getRepository('AGORAGameAveCesarBundle:AveCesarGame')->find($idGame);
        $players = $em->getRepository('AGORAGameAveCesarBundle:AveCesarPlayer')->findBy(array('game_id' => $idGame));
        foreach ($players as $player) {
            $em->remove($player);
            $em->flush($player);
        }

        $g = $em->getRepository('AGORAGameGameBundle:Game')->findOneBy(array('gameId' => $idGame, 'gameInfoId' => 1));
        $em->remove($g);
        $em->flush($g);

        $em->remove($game);
        $em->flush($game);

        // retpurne le page
        $playersSQPRepository = $em->getRepository('AGORAGameSQPBundle:SQPPlayer');
        $gamesSQPRepository = $em->getRepository('AGORAGameSQPBundle:SQPGame');
        $gamesSQP = $gamesSQPRepository->findAll();
        $gamesRepository = $em->getRepository('AGORAGameGameBundle:Game');
        $games = $gamesRepository->findAll();
        $usersRepository = $em->getRepository('AGORAUserBundle:User');
        $users = $usersRepository->findAll();
        $playersSQP = array();
        foreach ($gamesSQP as $game) {
            $playersSQP[''.$game->getId()] = $playersSQPRepository->getAllPlayersFromLobby($game->getId());
        }
        $players = array();
        /** @var AveCesarService $service */
        $service = $this->container->get('agora_game.ave_cesar');
        foreach ($games as $game) {
            if ($game->getGameInfoId()->getGameCode() == "avc") {
                $players['avc'][''.$game->getId()] = $service->getAllPlayers($game->getId());
            }
        }

        return $this->render('AGORAPlatformBundle:Accueil:moderation.html.twig' ,array(
            "gamesSQP" => $gamesSQP,
            "users" => $users,
            "games" => $games,
            "playersSQP" => $playersSQP,
            "players" => $players
        ));

    }
    //TODO
    public function createPlayer($user, $gameId) {
        $avcgame = $this->manager->getRepository('AGORAGameAveCesarBundle:AveCesarGame')->find($gameId);
        if ($avcgame == null) {
            throw new \Exception();
        }

        $game = $this->manager->getRepository('AGORAGameGameBundle:Game')
            ->findOneBy(array('gameId' => $gameId));

        $players = $this->manager->getRepository('AGORAGameAveCesarBundle:AveCesarPlayer')
            ->findBy(array('game_id' => $gameId));

        $nbPlayer = count($players);

        if ($nbPlayer >= $game->getNbPlayers()) {
            return -1;
        }

        $player = new AveCesarPlayer();
        $player->setGameId($gameId);
        $player->setHand("");


        // Génération de la prochaine position de départ

        $player->setPosition("0". chr(ord('b') + $nbPlayer));
        $player->setLap(1);
        $player->setUserId($user);
        $player->setCesar(false);
        //$player->setDeck($this->newDeck());
        $player->setFinish(0);

        $deck = preg_split("/,/", $this->newDeck());
        $hand = array_splice($deck, -3);
        $player->setHand($this->arrayToString($hand));
        $player->setDeck($this->arrayToString($deck));

        $this->manager->persist($player);
        $this->manager->flush();
        $this->setFirstPlayer($player->getId(), $gameId);

        if (!$this->getNextPlayer($gameId)) {
            $this->setNextPlayer($gameId, $player->getId());
        }

        if ($nbPlayer + 1 == $game->getNbPlayers()) {
            $this->initPlayers($gameId);
        }
        $this->flush();
        return $player->getId();
    }

}