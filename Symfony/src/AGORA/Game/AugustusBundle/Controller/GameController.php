<?php


namespace AGORA\Game\AugustusBundle\Controller;

use AGORA\Game\AugustusBundle\Service\AugustusService;
use AGORA\Game\AugustusBundle\Entity\AugustusGame;

use AGORA\Game\Socket\ConnectionStorage;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use FOS\UserBundle\Model\UserInterface;


class GameController extends Controller {

    /**
     * @var $connectionStorage Les connexions liées a un jeu.
     */
    protected $connectionStorage;

    function __construct() {
        $this->connectionStorage = new ConnectionStorage();
    }

    
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
            'gameId' => $gameId
        )));
    }


    public function joinRoomAction(SessionInterface $session, $gameId) {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Accès refusé, l\'utilisateur n\'est pas connecté.');
        }


        $service = $this->container->get('agora_game.augustus');

        $playerId = $service->joinPlayer($user, $gameId);

        // if the game is full
        if ($playerId == -1) {
            $this->redirect($this->generateUrl('agora_platform_joingame'));
        }

        return $this->redirect($this->generateUrl('agora_game_index_aug' ,array(
            "gameId" => $gameId
        )));
    }



    public function indexAction($gameId) {
        //Récupération de l'utilisateur connecté
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Accès refusé, l\'utilisateur n\'est pas connecté.');
        }

        $service = $this->container->get('agora_game.augustus');
        $playerId = $service->getPlayerFromUser($user, $gameId)->getId();

        return $this->renderIndex($gameId, $playerId);
    }


    private function renderIndex($gameId, $playerId) {
        $service = $this->container->get('agora_game.augustus');

        $game = $service->getGame($gameId);
        $player = $service->getPlayerFromId($playerId, $gameId);

        //Envoie Au twig tout les infomartions qu'il doit afficher
        return $this->render('AugustusBundle:Default:game.html.twig',
            array(
                'game'  => $game,
                'board' => $game->getBoard(),
                'me'    => $player
            )
        );
    }




    public function bodyAction($gameId, $playerId) {
        $service = $this->container->get('agora_game.augustus');

        $game = $service->getGame($gameId);
        $player = $service->getPlayerFromId($playerId, $gameId);

        //Envoie Au twig tout les infomartions qu'il doit afficher
        return $this->render('AugustusBundle:Default:gameBody.html.twig',
            array(
                'game'  => $game,
                'board' => $game->getBoard(),
                'me'    => $player,
            )
        );
    }
    
    public function handleAction($conn, $gameId, $playerId, $action) {
        $service = $this->container->get('agora_game.augustus');

        if ($action->type == "connect") {
            $this->connectionStorage->addConnection($gameId, $playerId, $conn);

            foreach ($this->connectionStorage->getAllConnections($gameId) as $c) {
                echo "Did something\n";
                //$c->send($this->bodyAction($gameId, $player->getId()));
                $c->send("refresh");
            }

            return;
        }

        $player = $service->getPlayerFromId($playerId, $gameId);

        switch ($action->type) {
            case "legion":
                if(isset($action->removeToken)) {
                    for ($i = 0; $i < count($action->removeToken->token); $i++) {
                        $card = $player->getCards()[$action->removeToken->card[$i]];

                        $card->getCtrlTokens()[$action->removeToken->token[$i]];
                        $service->playerModel->removeLegionFromCard($player->getId(), $card->getId(), $action->addToken->token[$i]);
                    }
                }
                if(isset($action->addToken)) {
                    for ($i = 0; $i < count($action->addToken->token); $i++) {
                        $card = $player->getCards()[$action->addToken->card[$i]];

                        $card->getCtrlTokens()[$action->addToken->token[$i]];
                        $service->playerModel->putLegionOnCard($player->getId(), $card->getId(), $action->addToken->token[$i]);
                    }
                }

                $service->manager->flush();
                break;
            case "aveCesar":
                if ($action->aveCesar->takeLoot) {
                    $service->gameModel->claimReward($gameId, $playerId);
                }

                $game = $service->getGame($gameId);
                $board = $game->getBoard();
                $card = $board->getObjLine()[$action->aveCesar->card];
                $player->addCard($service->gameModel->boardModel->takeCardFromCenter($board->getId(), $card->getId()));

                $this->manager->flush();
                break;
            case "removeAllLegions":
                $cards = $player->getCards();
                $card = $cards[$action->removeAllLegion];
                $tokens = $card->getTokens();
                foreach($tokens as $t) {
                    $service->cardModel->getBackToken($card->getId(), $t);
                }
                $this->manager->flush();
                break;
            case "completeCard":
                $cards = $player->getCards();
                $card = $cards[$action->removeAllLegion];
                $service->playerModel->completeCard($card->getId());
                $this->manager->flush();
                break;
            default:
        }
        $conn->send("refresh");


        $service->getPlayerFromId($playerId,$gameId)->setIsLock(true);
        if ($service->areAllPlayersReady($gameId)) {
            $players = $service->getPlayers($gameId);

            //applyStep

            foreach ($service->getPlayers($gameId) as $player) {
                $c = $this->connectionStorage->getConnection($gameId, $player->getId());

                $c->send($this->bodyAction($gameId, $player->getId()));
            }
            //return
        }

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