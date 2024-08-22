<?php

namespace PHP_Task\Classes\Validation;

class Enum implements ValidationRule
{
    public function check(string $name, $value)
    {
        $options = ['Pending', 'In Progress', 'Complete'];

        if (!in_array($value, $options)) {
            return "$value is not allowed. Allowed values are: Pending, In Progress, Complete.";
        }
        return false;
    }
}
