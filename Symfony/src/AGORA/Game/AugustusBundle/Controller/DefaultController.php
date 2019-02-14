<?php

namespace AGORA\Game\AugustusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AugustusBundle:Default:index.html.twig');
    }
}
