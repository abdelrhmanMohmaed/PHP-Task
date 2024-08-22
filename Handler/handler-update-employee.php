<?php

require_once("../app.php");

use PHP_Task\Classes\File;
use PHP_Task\Classes\Validation\Validator;
use PHP_Task\Classes\Models\User;
use PHP_Task\Classes\Validation\ConfirmPassword;
use PHP_Task\Classes\Validation\UniqueEmail;

if ($request->postHas('submit')) { 
    
    $id = $request->get('id');
    $first_name = $request->post('first_name');
    $last_name = $request->post('last_name');
    $email = $request->post('email');
    $phone = $request->post('phone');
    $salary = $request->post('salary');
    $password = $request->post('password');
    $confirm_password = $request->postHas('confirm_password') ? $request->post('confirm_password') : '';
    $avatar = $request->file('avatar');
    
    $user = new User; 
    $validator = new Validator;
    $fields = $user->selectId($id,'password, avatar');

    $validator->validate('First Name', $first_name, ['required', 'str', 'max']);
    $validator->validate('Last Name', $last_name, ['required', 'str', 'max']);
    $validator->validate('Email', $email, ['required', 'email', 'max', new UniqueEmail($user,$id)]);
    $validator->validate('Phone', $phone, ['required']);
    $validator->validate('Salary', $salary, ['required', 'numeric']);

    if(!empty($password))
    {
        $validator->validate('Password', $password, ['required', 'PasswordComplexity']);
        $validator->validate('Confirm Password', $confirm_password, [new ConfirmPassword($password)]);
    
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    }else{

        $hashPassword = $fields['password'];
    }

    if($avatar['error'] == 0){
        $validator->validate('Avatar', $avatar, [ 'image']);
    }

    if ($validator->hasErrors()) {
        $session->set('errors', $validator->getErrors());
        $request->redirect('update-employee.blade.php?id=' . $id);
    } else {
        $avatarName = $fields['avatar'];

        if ($avatar['error'] == 0) { 
            unlink(PATH . "assets/img/avaters/" . $avatarName);

            $file = new File($avatar);
            $avaterName = $file->rename()->upload();
        }
    
        $user->update(
            "first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', salary= '$salary', avatar= '$avaterName',`password`='$hashPassword', updated_at = NOW()",
            $id
        );

        $updatedUser = $user->selectId($id, 'id, first_name, last_name, email, phone');
        $teamMembers = $session->get('team_members');
    
        foreach ($teamMembers as &$member) {
            if ($member['id'] == $id) {
                $member['first_name'] = $updatedUser['first_name'];
                $member['last_name'] = $updatedUser['last_name'];
                $member['email'] = $updatedUser['email'];
                $member['phone'] = $updatedUser['phone'];
                break;
            }
        }
    
        $session->set('team_members', $teamMembers);
        $session->set('success', 'Employee updated successfully');
        $request->redirect('index.blade.php');
    }
    
} else {
    $request->redirect("login.blade.php");
}