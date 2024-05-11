<?php

use Prism\Http\HttpNotFoundException;
use Prism\Http\Request;
use Prism\Http\Response;
use Prism\Routing\Router;
use Prism\Server\PhpNativeServer;

require_once "../vendor/autoload.php";

$router = new Router();

$router->get('/test', function (Request $request) {
    $response = new Response();

    $response->setHeader("Content-Type", "application/json");
    $response->setContent(json_encode(["message" => "GET OK"]));
});

$router->post('/test', function (Request $request) {
    return "POST OK";
});

try {
    $request = new Request($server);
    $route = $router->resolve($request);
    $action = $route->action();
    $response = $action($request);
    $server->sendResponse($response);
} catch (HttpNotFoundException $e) {
    $response = new Response();
    $response->setStatus(404);
    $server->sendResponse($response);
}