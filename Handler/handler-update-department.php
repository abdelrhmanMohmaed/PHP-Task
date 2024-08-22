<?php

require_once("../app.php");

use PHP_Task\Classes\Models\Department;
use PHP_Task\Classes\Validation\Validator;

if ($request->postHas('id') && $request->postHas('name')) {
    $id = $request->post('id');
    $name = $request->post('name');

    $validator = new Validator;
    $validator->validate('Department Name', $name, ['required', 'str', 'max']);

    if ($validator->hasErrors()) { 

        $session->set('errors', $validator->getErrors());
    } else {
        $department = new Department;
        $department->update("name = '$name', updated_at = NOW()", $id);

        $session->set('success', 'Department updated successfully');
    }

    $request->redirect('department.blade.php');
} else {
    
    $session->set('errors', 'Invalid request');
    $request->redirect('login.blade.php');
}
