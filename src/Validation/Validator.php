<?php

namespace Prism\Validation;

use Prism\Validation\Exceptions\ValidationException;

class Validator
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validate(array $validationRules, array $messages = []): array
    {
        $validated = [];
        $errors = [];

        foreach ($validationRules as $field => $rules) {
            if (!is_array($rules)) {
                $rules = [$rules];
            }

            $fieldUnderValidationErrors = [];

            foreach ($rules as $rule) {
                if (!$rule->isValid($field, $this->data)) {
                    $message = $messages[$field][$rule::class] ?? $rule->message();
                    $fieldUnderValidationErrors[$rule::class] = $message;
                }
            }

            if (count($fieldUnderValidationErrors) > 0) {
                $errors[$field] = $fieldUnderValidationErrors;
            } else {
                $validated[$field] = $this->data[$field];
            }
        }

        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }

        return $validated;
    }
}
