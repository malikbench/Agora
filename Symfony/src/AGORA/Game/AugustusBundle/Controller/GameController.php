<?php


namespace AGORA\Game\AugustusBundle\Controller;
use AGORA\Game\AugustusBundle\Service\AugustusService;

use AGORA\Game\AugustusBundle\Entity\AugustusGame;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

class GameController extends Controller
{

    /**
     * @Route
     */

    public function indexAction($gameId) {

        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Accès refusé, l\'utilisateur n\'est pas connecté.');
        }


        //Recupération dans la bdd des information du jeu
        /** @var AugustusService $service */

        $augGame = $service->getGame($gameId);

        $player = $augGame->getPlayerFromUserId($gameId, $user->getId());
        $players = $augGame->getAllPlayers();
        $gameName = $augGame->getGameName();
        //$nextPlayer = $augGame->getNextPlayer($gameId);
        //$service->initPlayers($gameId);

        //Envoie Au twig tout les infomartions qu'il soit afficher
        return $this->render('AGORAGameAveCesarBundle:Default:game.html.twig',
            array(
                'user' => $user,
                'game' => $augGame,
                'player' => $player,
                'players' => $players,
                'gameName' => $gameName,
            )
        );
    }


    //Création de la partie
    public function createLobbyAction() {
        //Recupération de l'utilisateur qui a crée la partie et vérification que celui ci est connecté
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Accès refusé, l\'utilisateur n\'est pas connecté.');
        }

        $service = $this->container->get('agora_game.augustus');

        $private = 0;
        $password = "";

        if (isset($_POST['private']) && isset($_POST['password']) && $_POST['password']!="" && $_POST['private'] == "on") {
            $private = 1;
            $password = $_POST['password'];

        }
        $gameId = $service->createRoom($_POST['lobbyName'], $_POST['nbPlayers'], $private, $password, $user->getId());
        return $this->redirect($this->generateUrl('agora_game_join_aug' ,array(
            "gameId" => $gameId
        )));
    }

}