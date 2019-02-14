<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('augustus_homepage', new Route('/', array(
    '_controller' => 'AugustusBundle:Default:index',
)));

return $collection;
