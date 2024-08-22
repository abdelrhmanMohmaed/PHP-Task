<?php
require_once("../app.php");

use PHP_Task\Classes\Models\User;


$user = new User;
$user->logOut($session);

$request->redirect('login.blade.php');