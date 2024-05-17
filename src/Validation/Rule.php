<?php

namespace Prism\Validation;

use Prism\Validation\Rules\Email;
use Prism\Validation\Rules\Required;
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
}
