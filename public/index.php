<?php

use Prism\App;
use Prism\Http\Request;
use Prism\Http\Response;

require_once "../vendor/autoload.php";

$app = App::bootstrap();

$app->router->get('/test/{param}', function (Request $request) {
    return Response::json($request->routeParameters());
});

$app->router->post('/test', function (Request $request) {
    return Response::json($request->data());
});

$app->router->get('/redirect', function (Request $request) {
    return Response::redirect("/test");
});

$app->run();