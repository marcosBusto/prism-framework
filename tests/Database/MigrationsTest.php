<?php

namespace Prism\Tests\Database;

use Prism\Database\Drivers\DatabaseDriver;
use Prism\Database\Drivers\PdoDriver;
use Prism\Database\Migrations\Migrator;
use PDOException;
use PHPUnit\Framework\TestCase;

class MigrationsTest extends TestCase
{
    use RefreshDatabase {
        setUp as protected dbSetUp;
        tearDown as protected dbTearDown;
    }

    protected ?DatabaseDriver $driver = null;
    protected $templatesDirectory = __DIR__ . "/templates";
    protected $migrationsDirectory = __DIR__ . "/migrations";
    protected $expectedMigrations = __DIR__ . "/expected";
    protected Migrator $migrator;

    protected function setUp(): void
    {
        if (!file_exists($this->migrationsDirectory)) {
            mkdir($this->migrationsDirectory);
        }

        $this->dbSetUp();

        $this->migrator = new Migrator(
            $this->migrationsDirectory,
            $this->templatesDirectory,
            $this->driver,
            false,
        );
    }

    protected function tearDown(): void
    {
        shell_exec("rm -r $this->migrationsDirectory");

        $this->dbTearDown();
    }

    public function migrationNames()
    {
        return [
            [
                "create_products_table",
                "$this->expectedMigrations/create_products_table.php",
            ],
            [
                "add_category_to_products_table",
                "$this->expectedMigrations/add_category_to_products_table.php",
            ],
            [
                "remove_name_from_products_table",
                "$this->expectedMigrations/remove_name_from_products_table.php",
            ],
        ];
    }

    /**
     * @dataProvider migrationNames
     */
    public function test_creates_migration_files($name, $expectedMigrationFile)
    {
        $expectedName = sprintf("%s_%06d_%s.php", date('Y_m_d'), 0, $name);

        $this->migrator->make($name);

        $file = "$this->migrationsDirectory/$expectedName";

        $this->assertFileExists($file);
        $this->assertFileEquals($expectedMigrationFile, $file);
    }

    /**
     * @depends test_creates_migration_files
     */
    public function test_migrate_files()
    {
        $tables = ["users", "products", "sellers"];
        $migrated = [];

        foreach ($tables as $table) {
            $migrated[] = $this->migrator->make("create_{$table}_table");
        }

        $this->migrator->migrate();

        $rows = $this->driver->statement("SELECT * FROM migrations");

        $this->assertEquals(3, count($rows));
        $this->assertEquals($migrated, array_column($rows, "name"));

        foreach ($tables as $table) {
            try {
                $this->driver->statement("SELECT * FROM $table");
            } catch (PDOException $e) {
                $this->fail("Failed accessing migrated table $table: {$e->getMessage()}");
            }
        }
    }
}
