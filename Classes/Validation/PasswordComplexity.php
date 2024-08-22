<?php

namespace PHP_Task\Classes\Validation;

class PasswordComplexity implements ValidationRule
{
    public function check(string $name, $value)
    {
        if (!preg_match('/[A-Z]/', $value)) {
            return "$name must contain at least one uppercase letter";
        }

        if (!preg_match('/[a-z]/', $value)) {
            return "$name must contain at least one lowercase letter";
        }

        if (!preg_match('/\d/', $value)) {
            return "$name must contain at least one number";
        }

        if (!preg_match('/[\W_]/', $value)) {
            return "$name must contain at least one special character";
        }

        return false;
    }
}
