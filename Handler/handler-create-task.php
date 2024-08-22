<?php

require_once("../app.php");

use PHP_Task\Classes\Validation\Validator;
use PHP_Task\Classes\Models\Task;

if ($request->postHas('submit')) { 
    $title = $request->post('title'); 
    $description = $request->post('description'); 
    $user = $request->post('user');
    
    $created_by = $session->get('id');

    $validator = new Validator;
    $validator->validate('Title', $title, ['required', 'str', 'max']);
    $validator->validate('Description', $title, ['required', 'str', 'max']);
    $validator->validate('User', $title, ['required']);

    if ($validator->hasErrors()) {
        $session->set('errors', $validator->getErrors());
        $request->redirect('task.blade.php');
    } else { 

        $task = new Task;

        $task->insert('created_by, user_id, title, description, status', 
        "'$created_by', '$user','$title', '$description', 'Pending'");

        $session->set('success', 'New Task created successfully');
        $request->redirect('task.blade.php');
    }

} else {

    $request->redirect("login.blade.php");
}