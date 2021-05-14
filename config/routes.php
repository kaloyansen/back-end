<?php

use \Symfony\Component\Routing\Route;
use \Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection;

$routes->add('mainController', new Route('/'));
$routes->add('ticketController', new Route('/tickets/{id}', ["id" => null]));

return $routes;