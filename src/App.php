<?php

namespace Prism;

use Dotenv\Dotenv;
use Prism\Config\Config;
use Prism\Database\Drivers\DatabaseDriver;
use Prism\Database\Drivers\PdoDriver;
use Prism\Database\Model;
use Prism\Http\HttpMethod;
use Prism\Http\HttpNotFoundException;
use Prism\Http\Request;
use Prism\Http\Response;
use Prism\Routing\Router;
use Prism\Server\PhpNativeServer;
use Prism\Server\Server;
use Prism\Session\PhpNativeSessionStorage;
use Prism\Session\Session;
use Prism\Validation\Exceptions\ValidationException;
use Prism\Validation\Rule;
use Prism\View\PrismEngine;
use Prism\View\View;
use Throwable;

class App
{
    public static string $root;
    public Router $router;
    public Request $request;
    public Server $server;
    public View $view;
    public Session $session;
    public DatabaseDriver $database;

    public static function bootstrap(string $root)
    {
        self::$root = $root;

        Dotenv::createImmutable($root);
        Config::load("$root/config");

        $app = singleton(self::class);
        $app->router = new Router();
        $app->server = new PhpNativeServer();
        $app->request = $app->server->getRequest();
        $app->view = new PrismEngine(__DIR__ . "/../views");
        $app->session = new Session(new PhpNativeSessionStorage());
        $app->database = singleton(DatabaseDriver::class, PdoDriver::class);

        $app->database->connect('mysql', 'localhost', 3306, 'framework', 'root', '');

        Model::setDatabaseDriver($app->database);
        Rule::loadDefaultRules();

        return $app;
    }

    public function prepareNextRequest()
    {
        if ($this->request->method() == HttpMethod::GET) {
            $this->session->set('_previous', $this->request->uri());
        }
    }

    public function terminate(Response $response)
    {
        $this->prepareNextRequest();
        $this->server->sendResponse($response);
        $this->database->close();

        exit();
    }

    public function run()
    {
        try {
            $this->terminate($this->router->resolve($this->request));
        } catch (HttpNotFoundException $e) {
            $this->abort(Response::text("Not found")->setStatus(404));
        } catch (ValidationException $e) {
            $this->abort(back()->withErrors($e->errors(), 422));
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
        $this->terminate($response);
    }
}
