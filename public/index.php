<?php

use Prism\Http\HttpNotFoundException;
use Prism\Http\Request;
use Prism\Http\Response;
use Prism\Routing\Router;
use Prism\Server\PhpNativeServer;

require_once "../vendor/autoload.php";

$router = new Router();

$router->get('/test', function (Request $request) {
    return Response::text("GET OK");
});

$router->post('/test', function (Request $request) {
    return Response::text("POST OK");
});

$router->get('/redirect', function (Request $request) {
    return Response::redirect("/test");
});

try {
    $request = new Request($server);
    $route = $router->resolve($request);
    $action = $route->action();
    $response = $action($request);
    $server->sendResponse($response);
} catch (HttpNotFoundException $e) {
    $response = Response::text("Not found")->setStatus(404);
    $server->sendResponse($response);
}