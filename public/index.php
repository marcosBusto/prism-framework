<?php

use Prism\App;
use Prism\Http\Middleware;
use Prism\Http\Request;
use Prism\Http\Response;
use Prism\Routing\Route;
use Prism\Validation\Rule;
use Prism\Validation\Rules\Required;

require_once "../vendor/autoload.php";

$app = App::bootstrap();

$app->router->get('/test/{param}', function (Request $request) {
    return json($request->routeParameters());
});

$app->router->post('/test', function (Request $request) {
    return json($request->data());
});

$app->router->get('/redirect', function (Request $request) {
    return redirect("/test");
});

class AuthMiddleware implements Middleware {
    public function handle(Request $request, Closure $next): Response {
        if ($request->headers('Authorization') != 'test') {
            return json(["message" => "Not authenticated"])->setStatus(401);
        }

        $response = $next($request);

        $response->setHeader('X-Test-Custom-Header', 'Hola');

        return $response;
    }
}

Route::get('/middlewares', fn (Request $request) => json(["message" => "ok"]))
    ->setMiddlewares([AuthMiddleware::class]);

Route::get('/html', fn (Request $request) => view('home', ['user' => 'Manolo']));

Route::post('/validate', fn (Request $request) => json($request->validate([
    'test' => Rule::required(),
    'num' => Rule::number(),
    'email' => [Rule::required(), Rule::email()],
], [
    'email' => [
        Required::class => 'DAME EL CAMPO'
    ]
])));

$app->run();