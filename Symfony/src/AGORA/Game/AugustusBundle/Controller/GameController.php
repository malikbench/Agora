<?php


namespace AGORA\Game\AugustusBundle\Controller;

use AGORA\Game\AugustusBundle\Service\AveCesarService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use AGORA\PlatformBundle\Entity\Leaderboard;

class GameController extends Controller
{




    //Création de la partie
    public function createLobbyAction() {
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

        return $this->redirect($this->generateUrl('agora_game_join_avc' ,array(
            "gameId" => $gameId
        )));
    }

}