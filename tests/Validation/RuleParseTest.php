<?php

namespace Prism\Tests\Validation;

use Prism\Validation\Exceptions\RuleParseException;
use Prism\Validation\Exceptions\UnknownRuleException;
use Prism\Validation\Rule;
use Prism\Validation\Rules\Email;
use Prism\Validation\Rules\LessThan;
use Prism\Validation\Rules\Number;
use Prism\Validation\Rules\Required;
use Prism\Validation\Rules\RequiredWhen;
use Prism\Validation\Rules\RequiredWith;
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

    public function test_parsing_unknown_rules_throws_unknown_rule_exception()
    {
        $this->expectException(UnknownRuleException::class);

        Rule::from("unknown");
    }

    public static function rulesWithParameters()
    {
        return [
            [new LessThan(5), "less_than:5"],
            [new requiredWith("other"), "required_with:other"],
            [new requiredWhen("other", "=", "test"), "required_when:other,=,test"],
        ];
    }

    /**
     * @dataProvider rulesWithParameters
     */
    public function test_parse_rules_with_parameters($expected, $rule)
    {
        $this->assertEquals($expected, Rule::from($rule));
    }

    public static function rulesWithParametersWithError()
    {
        return [
            ["less_than"],
            ["less_than:"],
            ["required_with:"],
            ["required_when"],
            ["required_when:"],
            ["required_when:other"],
            ["required_when:other,"],
            ["required_when:other,="],
            ["required_when:other,=,"],
        ];
    }

    /**
     * @dataProvider rulesWithParametersWithError
     */
    public function test_parsing_rule_with_parameters_without_passing_correct_parameters_throws_rule_parse_exception($rule)
    {
        $this->expectException(RuleParseException::class);
        Rule::from($rule);
    }
}
