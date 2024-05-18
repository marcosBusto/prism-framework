<?php

namespace Prism\Tests\Validation;

use Prism\Validation\Rule;
use Prism\Validation\Rules\Email;
use Prism\Validation\Rules\Number;
use Prism\Validation\Rules\Required;
use PHPUnit\Framework\TestCase;

class RuleParseTest extends TestCase
{
    protected function setUp(): void
    {
        Rule::loadDefaultRules();
    }

    public static function basicRules()
    {
        return [
            [Email::class, "email"],
            [Required::class, "required"],
            [Number::class, "number"],
        ];
    }

    /**
     * @dataProvider basicRules
     */
    public function test_parse_basic_rules($class, $name)
    {
        $this->assertInstanceOf($class, Rule::from($name));
    }
}
