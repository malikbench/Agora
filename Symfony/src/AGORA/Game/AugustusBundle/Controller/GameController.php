<?php


namespace AGORA\Game\AugustusBundle\Controller;

use AGORA\Game\AugustusBundle\Service\AugustusService;
use AGORA\Game\AugustusBundle\Entity\AugustusGame;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

class GameController extends Controller {

    
    //Création de la partie
    public function createRoomAction() {
        //Recupération de l'utilisateur qui a créé la partie et vérification que celui-çi est connecté
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Accès refusé, l\'utilisateur n\'est pas connecté.');
        }

        //recupere dnas la base de donnée la ou on stock les partie d'Augustus
        $service = $this->container->get('agora_game.augustus');

        $private = 0;
        $password = "";

        //si un mdp a été donné et la partie est privé initialise le mot de passe
        if (isset($_POST['private']) && isset($_POST['password']) && $_POST['password']!="" && $_POST['private'] == "on") {
            $private = 1;
            $password = $_POST['password'];

        }

        //création de la salle de jeu et récupération de l'id
        $gameId = $service->createRoom($_POST['lobbyName'], $_POST['nbPlayers'], $private, $password, $user->getId());
        return $this->redirect($this->generateUrl('agora_game_join_aug' ,array(
            "gameId" => $gameId
        )));
    }


    public function joinLobbyAction(SessionInterface $session, $gameId) {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Accès refusé, l\'utilisateur n\'est pas connecté.');
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



    public function indexAction($gameId) {
        //Récupération de l'utilisateur connecté
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Accès refusé, l\'utilisateur n\'est pas connecté.');
        }


        //Recupération dans la bdd des information du jeu
        /** @var AugustusService $service */
        $augGame = $service->getGame($gameId);

        //TODO && ask
        $player = $augGame->getPlayerFromId($user->getId());
        //récupération du nom de la partie
        $gameName = $service->getGameName($gameId);

        //Envoie Au twig tout les infomartions qu'il soit afficher
        return $this->render('AGORAGameAveCesarBundle:Default:game.html.twig',
            array(
                'user' => $user,
                'game' => $augGame,
                'me' => $player,
                'gameName' => $gameName,
            )
        );
    }


    


    
    //TODO
    //supprime une partie
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

}