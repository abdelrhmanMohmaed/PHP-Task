<?php

namespace PHP_Task\Classes\Validation;

class ConfirmPassword implements ValidationRule
{
    private $passwordField;

    public function __construct($passwordField)
    {
        $this->passwordField = $passwordField;
    }

    public function check(string $name, $value)
    {
        if ($value !== $this->passwordField) {
            return "$name does not match the password";
        }
        return false;
    }
}
