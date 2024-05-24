<?php

namespace Prism\Tests\Database;

use Prism\Database\Drivers\PdoDriver;
use Prism\Database\Model;
use PDOException;

trait RefreshDatabase
{
    protected function setUp(): void
    {
        if (is_null($this->driver)) {
            $this->driver = new PdoDriver();

            Model::setDatabaseDriver($this->driver);

            try {
                $this->driver->connect('mysql', 'localhost', 3306, 'framework-tests', 'root', '');
            } catch (PDOException $e) {
                $this->markTestSkipped("Can't connect to test database: {$e->getMessage()}");
            }
        }
    }

    protected function tearDown(): void
    {
        $this->driver->statement("CREATE DATABASE framework_tests");
    }
}
