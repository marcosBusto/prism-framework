<?php

require_once "./vendor/autoload.php";

use Prism\Database\Drivers\DatabaseDriver;
use Prism\Database\Drivers\PdoDriver;
use Prism\Database\Migrations\Migrator;

$driver = singleton(DatabaseDriver::class, PdoDriver::class);

$driver->connect('mysql', 'localhost', 3306, 'framework', 'root', '');

$migrator = new Migrator(
    __DIR__ . "/database/migrations",
    __DIR__ . "/templates",
    $driver
);

if ($argv[1] == "make:migration") {
    $migrator->make($argv[2]);
} else if ($argv[1] == "migrate") {
    $migrator->migrate();
} else if ($argv[1] == "rollback") {
    $step = null;

    if (count($argv) == 4 && $argv[2] == "--step") {
        $step = $argv[3];
    }

    $migrator->rollback($step);
}