<?php

namespace PHP_Task\Classes\Validation;

class Validator
{
    private $errors = [];

    public function validate(string $name, $value, array $rules)
    {
        foreach ($rules as $rule) {
            if (is_string($rule)) {
                $className = "PHP_Task\\Classes\\Validation\\" . $rule;
                $obj = new $className;
            } else {
                $obj = $rule;
            }
            
            $error = $obj->check($name, $value);
            if ($error !== false) {
                $this->errors[] = $error;
                break;
            };
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }
}
