<?php

namespace AGORA\Game\SplendorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AGORAGameSplendorBundle:Default:index.html.twig');
    }

    public function createAction() {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Accès refusé, l\'utilisateur n\'est pas connecté.');
        }

        return $this->redirect($this->generateUrl('agora_platform_joingame'));
    }
}
