<?php

require_once("../app.php");

use PHP_Task\Classes\Validation\Validator;
use PHP_Task\Classes\Models\Department;

if ($request->postHas('submit')) { 
    $departmentName = $request->post('department'); 

    $validator = new Validator;
    $validator->validate('Department', $departmentName, ['required', 'str', 'max']);

    
    if ($validator->hasErrors()) {
        $session->set('errors', $validator->getErrors());
        $request->redirect('department.blade.php');
    } else { 

        $department = new Department;

        $department->insert('name', "'$departmentName'");

        $session->set('success', 'New Department created successfully');
        $request->redirect('department.blade.php');
    }
} else {
    $request->redirect("login.blade.php");
}