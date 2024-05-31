<?php

namespace Prism\Providers;

use Prism\Database\Drivers\DatabaseDriver;
use Prism\Database\Drivers\PdoDriver;

class DatabaseDriverServiceProvider implements ServiceProvider
{
    public function registerServices()
    {
        match (config("database.connection", "mysql")) {
            "mysql", "pgsql" => singleton(DatabaseDriver::class, PdoDriver::class),
        };
    }
}
