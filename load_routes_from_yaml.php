<?php

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use \Symfony\Component\HttpFoundation\Response;

require  __DIR__.'/vendor/autoload.php';

$routes = require __DIR__.'/config/routes.php';

$_route = '';
$response = new Response();

// Init RequestContext object
$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());

// Init UrlMatcher object
$matcher = new UrlMatcher($routes, $context);

try
{
    // Find the current route
    extract($matcher->match($context->getPathInfo()));
    include __DIR__.'/src/Controllers/'. $_route. '.php';
}
catch (ResourceNotFoundException $e)
{
    $response = new Response("la page demandée n'existe pas", 404);
}
catch (Exception $e) {
    $response = new Response("une erreur est survenue", 500);
}

$response->send();