<?php

require_once("../app.php");

use PHP_Task\Classes\File;
use PHP_Task\Classes\Validation\Validator;
use PHP_Task\Classes\Models\User;
use PHP_Task\Classes\Validation\ConfirmPassword;
use PHP_Task\Classes\Validation\UniqueEmail;

if ($request->postHas('submit')) { 
    $first_name = $request->post('first_name');
    $last_name = $request->post('last_name');
    $email = $request->post('email');
    $phone = $request->post('phone');
    $salary = $request->post('salary');
    $password = $request->post('password');
    $confirm_password = $request->post('confirm_password');
    $avatar = $request->file('avatar'); 
    $department_id =  $session->get('department_id');
    $managerid = $session->get('id');

    $user = new User; 
    $validator = new Validator;
    $validator->validate('First Name', $first_name, ['required', 'str', 'max']);
    $validator->validate('Last Name', $last_name, ['required', 'str', 'max']);
    $validator->validate('Email', $email, ['required', 'email', 'max', new UniqueEmail($user)]);
    $validator->validate('Phone', $phone, ['required']);
    $validator->validate('Salary', $salary, ['required', 'numeric']);
    $validator->validate('Avatar', $avatar, ['requiredfile', 'image']);
    $validator->validate('Password', $password, ['required', 'PasswordComplexity']); 
    $validator->validate('Confirm Password', $confirm_password, [new ConfirmPassword($password)]);



    if ($validator->hasErrors()) {
        $session->set('errors', $validator->getErrors());
        $request->redirect('index.blade.php');

    } else {
        $file = new File($avatar);
        $avaterName = $file->rename()->upload();

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $user->insert(
                "manager_id, department_id, first_name, last_name, email, phone, `password`, avatar, salary",
                "$managerid, $department_id, '$first_name', '$last_name', '$email', '$phone', '$hashPassword', '$avaterName', '$salary'"
            );
            
        $newEmployee = $user->selectWhere("email = '$email'");


        if (!empty($newEmployee)) {
            
            $employee = $newEmployee[0];

            if ($employee) {
                $teamMembers = $session->get('team_members'); 
        
                $teamMembers[] = [
                    'id' => $employee['id'] ?? null,
                    'first_name' => $employee['first_name'] ?? '---',
                    'last_name' => $employee['last_name'] ?? '---',
                    'email' => $employee['email'] ?? '---',
                    'phone' => $employee['phone'] ?? '---',
                ];
                
                $session->set('team_members', $teamMembers);
            }
        }
        

        $session->set('success', 'New Employee created successfully');
        $request->redirect('index.blade.php');
    }
} else {
    $request->redirect("login.blade.php");
}