<?php

namespace PHP_Task\Classes\Validation;


class Image implements ValidationRule
{
    public function check(string $name, $value)
    {
        $allowedExt = ['png', 'jpg','avif','jfif'];

        $ext = pathinfo($value['name'], PATHINFO_EXTENSION);

        if (!in_array($ext, $allowedExt)) {
            return "$name extension is not allowed, please upload png, jpg, avif, jfif";
        }
        return false;
    }
}
