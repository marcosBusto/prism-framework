<?php

namespace Prism;

use Prism\Container\Container;
use Prism\Http\HttpNotFoundException;
use Prism\Http\Request;
use Prism\Http\Response;
use Prism\Routing\Router;
use Prism\Server\PhpNativeServer;
use Prism\Server\Server;

class App {
    public Router $router;

    public Request $request;

    public Server $server;

    public static function bootstrap() {
        $app = Container::singleton(self::class);

        $app->router = new Router();
        $app->server = new PhpNativeServer();
        $app->request = $app->server->getRequest();

        return $app;
    }

    public function run() {
        try {
            $route = $this->router->resolve($this->request);

            $this->request->setRoute($route);

            $action = $route->action();
            $response = $action($this->request);

            $this->server->sendResponse($response);
        } catch (HttpNotFoundException $e) {
            $response = Response::text("Not found")->setStatus(404);

            $this->server->sendResponse($response);
        }
    }
}