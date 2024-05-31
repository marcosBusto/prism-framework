<?php

namespace Prism\Cli;

use Dotenv\Dotenv;
use Prism\App;
use Prism\Cli\Commands\MakeMigration;
use Prism\Cli\Commands\Migrate;
use Prism\Cli\Commands\MigrateRollback;
use Prism\Config\Config;
use Prism\Database\Drivers\DatabaseDriver;
use Prism\Database\Migrations\Migrator;
use Symfony\Component\Console\Application;

class Cli
{
    public static function bootstrap(string $root): self
    {
        App::$root = $root;
        Dotenv::createImmutable($root)->load();
        Config::load($root . "/config");

        foreach (config("providers.cli") as $provider) {
            (new $provider())->registerServices();
        }

        app(DatabaseDriver::class)->connect(
            config("database.connection"),
            config("database.host"),
            config("database.port"),
            config("database.database"),
            config("database.username"),
            config("database.password"),
        );

        singleton(
            Migrator::class,
            fn () => new Migrator(
                "$root/database/migrations",
                resourcesDirectory() . "/templates",
                app(DatabaseDriver::class)
            )
        );

        return new self();
    }

    public function run()
    {
        $cli = new Application("Prism");

        $cli->addCommands([
            new MakeMigration(),
            new Migrate(),
            new MigrateRollback()
        ]);

        $cli->run();
    }
}
