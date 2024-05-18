<?php

namespace Prism\Validation\Exceptions;

use Prism\Exceptions\PrismException;

class ValidationException extends PrismException
{
    public function __construct(protected array $errors)
    {
        $this->errors = $errors;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
