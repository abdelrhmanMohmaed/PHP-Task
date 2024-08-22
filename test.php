<?php
require_once('app.php');

use PHP_Task\Classes\Models\User;

$user = new User();

$re = $user->login('ahmed@hotmail.com','@123456aAqw', $session);
echo "<pre>";
print_r($_SESSION);
echo "<pre>";

// $re = $user->logOut($session);

echo "<pre>";
print_r($_SESSION);
echo "<pre>";