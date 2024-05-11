<?php

require_once "../vendor/autoload.php";

use Prism\HttpNotFoundException;
use Prism\PhpNativeServer;
use Prism\Request;
use Prism\Router;
use Prism\Server;

$router = new Router();

$router->get('/test', function () {
    return "GET OK";
});

$router->post('/test', function () {
    return "POST OK";
});

try {
    $route = $router->resolve(new Request(new PhpNativeServer()));
    $action = $route->action();
} catch (HttpNotFoundException $e) {
    print("Not found");
    http_response_code(404);
}