<?php

use Prism\Http\HttpNotFoundException;
use Prism\Http\Request;
use Prism\Routing\Router;
use Prism\Server\PhpNativeServer;

require_once "../vendor/autoload.php";

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