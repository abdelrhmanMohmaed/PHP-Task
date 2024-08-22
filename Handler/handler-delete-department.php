<?php

use PHP_Task\Classes\Models\Department;
use PHP_Task\Classes\Models\User;

require_once("../app.php");

if ($request->getHas('id')) { 
    $id = $request->get('id');

    $department = new Department;
    $user = new User;

    $count = $user->getCountWithCondation("department_id = $id");

    if($count > 0) {
        
        $session->set('errors', "It is not possible to delete this department as it has associated employees.");
    } else { 
        if ($department->delete($id)) {
            
            $session->set('success', 'Department deleted successfully');
        } else {

            $session->set('errors', 'Failed to delete the department. Please try again.');
        }
    }

    $request->redirect('department.blade.php');
}
