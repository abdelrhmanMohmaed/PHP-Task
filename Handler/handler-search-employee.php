<?php

require_once("../app.php");

use PHP_Task\Classes\Models\User;

if ($request->getHas('first_name') && $request->getHas('last_name')) {

    $firstName = $request->get('first_name');
    $lastName = $request->get('last_name');

    $user = new User;

    try {
        $results = $user->searchByName($firstName, $lastName);
        
        header('Content-Type: application/json');
        echo json_encode($results);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {

    http_response_code(400);
    echo json_encode(['error' => 'Query parameters are missing']);
}