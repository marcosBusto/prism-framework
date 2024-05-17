<?php

namespace Prism;

use Prism\Http\HttpNotFoundException;
use Prism\Http\Request;
use Prism\Http\Response;
use Prism\Routing\Router;
use Prism\Server\PhpNativeServer;
use Prism\Server\Server;
use Prism\View\PrismEngine;
use Prism\View\View;

class App
{
    public Router $router;

    public Request $request;

    public Server $server;

    public View $view;

    public static function bootstrap()
    {
        $app = singleton(self::class);

        $app->router = new Router();
        $app->server = new PhpNativeServer();
        $app->request = $app->server->getRequest();
        $app->view = new PrismEngine(__DIR__ . "/../views");

        return $app;
    }

    public function run()
    {
        try {
            $response = $this->router->resolve($this->request);

            $this->server->sendResponse($response);
        } catch (HttpNotFoundException $e) {
            $response = Response::text("Not found")->setStatus(404);

            $this->server->sendResponse($response);
        }
    }
}
