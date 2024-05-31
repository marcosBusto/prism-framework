<?php

namespace Prism\Providers;

use Prism\Server\PhpNativeServer;
use Prism\Server\Server;

class ServerServiceProvider implements ServiceProvider
{
    public function registerServices()
    {
        singleton(Server::class, PhpNativeServer::class);
    }
}
