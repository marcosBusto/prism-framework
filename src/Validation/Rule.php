<?php

namespace Prism\Validation;

use Prism\Validation\Rules\Email;
use Prism\Validation\Rules\LessThan;
use Prism\Validation\Rules\Number;
use Prism\Validation\Rules\Required;
use Prism\Validation\Rules\RequiredWhen;
use Prism\Validation\Rules\RequiredWith;
use Prism\Validation\Rules\ValidationRule;

class Rule
{
    public static function email(): ValidationRule
    {
        return new Email();
    }

    public static function required(): ValidationRule
    {
        return new Required();
    }

    public static function requiredWith(string $withField): ValidationRule
    {
        return new RequiredWith($withField);
    }

    public static function number(): ValidationRule
    {
        return new Number();
    }

    public static function lessThan(int|float $value): ValidationRule
    {
        return new LessThan($value);
    }

    public static function requiredWhen(
        string $otherField,
        string $operator,
        int|float $value
    ): ValidationRule {
        return new RequiredWhen($otherField, $operator, $value);
    }

    public static function from(string $str): ValidationRule
    {
    }
}
