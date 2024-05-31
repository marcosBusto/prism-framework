<?php

namespace Prism\Tests\Config;

use Prism\Config\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function test_config()
    {
        Config::load(__DIR__ . "/test-config");

        $this->assertEquals([2, 3, 4], Config::get("values"));
        $this->assertEquals("value", Config::get("test.some"));
        $this->assertEquals("value", Config::get("test.another.nested.key"));
        $this->assertEquals(["nested" => ["key" => "value"]], Config::get("test.another"));
        $this->assertNull(Config::get("null"));
        $this->assertNull(Config::get("test.unknown"));
        $this->assertNull(Config::get("test.another.unknown"));
        $this->assertNull(Config::get("test.very.unknown"));
    }
}
