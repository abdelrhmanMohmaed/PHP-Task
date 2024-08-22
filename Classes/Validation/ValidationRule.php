<?php

namespace PHP_Task\Classes\Validation;


interface ValidationRule
{
    public function check(string $name, $value);
}
