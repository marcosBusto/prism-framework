<?php

namespace Prism;

use Prism\Http\HttpNotFoundException;
use Prism\Http\Request;
use Prism\Http\Response;
use Prism\Routing\Router;
use Prism\Server\PhpNativeServer;
use Prism\Server\Server;
use Prism\Validation\Exceptions\ValidationException;
use Prism\Validation\Rule;
use Prism\View\PrismEngine;
use Prism\View\View;
use Throwable;

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

        Rule::loadDefaultRules();

        return $app;
    }

    public function run()
    {
        try {
            $response = $this->router->resolve($this->request);

            $this->server->sendResponse($response);
        } catch (HttpNotFoundException $e) {
            $this->abort(Response::text("Not found")->setStatus(404));
        } catch (ValidationException $e) {
            $this->abort(json($e->errors())->setStatus(422));
        } catch (Throwable $e) {
            $response = json([
                "error" => $e::class,
                "message" => $e->getMessage(),
                "trace" => $e->getTrace()
            ]);

            $this->abort($response->setStatus(500));
        }
    }

    public function abort(Response $response)
    {
        $this->server->sendResponse($response);
    }
}
