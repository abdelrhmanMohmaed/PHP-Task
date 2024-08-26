<?php

define("PATH", __DIR__ . "/");
define("URL", "http://localhost/PHP-Task/");

// DB Connection
define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "php_task");


require_once(PATH . "vendor/autoload.php");

use PHP_Task\Classes\Models\Department;
use PHP_Task\Classes\Request;
use PHP_Task\Classes\Session;

$request = new Request;
$session = new Session; 
$departments = new Department; 

$departments = $departments->selectAll();

$managerName = $session->has('manager_name') ? $session->get('manager_name') : '';
$teamMembers = $session->has('team_members') ? $session->get('team_members') : [];
$displayValue = !empty($managerName) ? htmlspecialchars($managerName) : 'Top Manager';
