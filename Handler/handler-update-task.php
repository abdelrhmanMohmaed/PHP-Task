<?php

require_once("../app.php");

use PHP_Task\Classes\Models\Task;
use PHP_Task\Classes\Validation\Validator;

if ($request->postHas('id') && $request->postHas('status')) {
    $id = $request->post('id');
    $status = $request->post('status');

    $validator = new Validator;
    $validator->validate('Status', $status, ['required', 'enum']); 

    if ($validator->hasErrors()) { 

        $session->set('errors', $validator->getErrors());
    } else {

        $task = new Task;
        $task->update("status = '$status', updated_at = NOW()", $id);

        $session->set('success', 'Task updated successfully');
    }

    $request->redirect('task.blade.php');
} else {
    
    $session->set('errors', 'Invalid request');
    $request->redirect('login.blade.php');
}
