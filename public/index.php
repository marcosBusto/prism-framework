<?php

use Prism\App;
use Prism\Http\Middleware;
use Prism\Http\Request;
use Prism\Http\Response;
use Prism\Routing\Route;

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

class AuthMiddleware implements Middleware {
    public function handle(Request $request, Closure $next): Response {
        if ($request->headers('Authorization') != 'test') {
            return Response::json(["message" => "Not authenticated"])->setStatus(401);
        }

        return $next();
    }
}

Route::get('/middlewares', fn (Request $request) => Response::json(["message" => "ok"]))
    ->setMiddlewares([AuthMiddleware::class]);

$app->run();