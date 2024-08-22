<?php

require_once("../app.php");

use PHP_Task\Classes\Models\Department;

if ($request->getHas('name')) {
 
    $name = $request->get('name');

    $department = new Department;

    try {
        $results = $department->searchByName($name);
        
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