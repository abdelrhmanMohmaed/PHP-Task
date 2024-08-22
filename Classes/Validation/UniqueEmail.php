<?php

namespace PHP_Task\Classes\Validation;

class UniqueEmail implements ValidationRule
{
    private $userModel;
    private $currentUserId;

    public function __construct($userModel, $currentUserId = null)
    {
        $this->userModel = $userModel;
        $this->currentUserId = $currentUserId;
    }

    public function check(string $name, $value)
    {
        $isUnique = $this->userModel->isUniqueEmail($value, $this->currentUserId);

        if (!$isUnique) {
            return "$name is already taken.";
        }

        return false;
    }
}
