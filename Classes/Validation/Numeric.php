<?php

namespace PHP_Task\Classes\Validation; 

class Numeric implements ValidationRule
{
    public function check(string $name, $value)
    {
        if (!is_numeric($value)) {
            return "$name must contain only numbers";
        }
        return false;
    }
}
