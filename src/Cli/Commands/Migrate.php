<?php

namespace Prism\Cli\Commands;

use Prism\Database\Migrations\Migrator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Migrate extends Command
{
    protected static $defaultName = "migrate";

    protected static $defaultDescription = "Run migrations";

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            app(Migrator::class)->migrate();

            return Command::SUCCESS;
        } catch (\PDOException $e) {
            $output->writeln("<error>Could not run migrations: {$e->getMessage()}</error>");
            $output->writeln($e->getTraceAsString());

            return Command::FAILURE;
        }
    }
}
