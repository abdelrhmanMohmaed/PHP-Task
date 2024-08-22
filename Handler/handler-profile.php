<?php

require_once("../app.php");

use PHP_Task\Classes\Validation\Validator;
use PHP_Task\Classes\Models\User;
use PHP_Task\Classes\File;
use PHP_Task\Classes\Validation\ConfirmPassword;
use PHP_Task\Classes\Validation\UniqueEmail;

if ($request->postHas('submit')) {
    
    $avatar = $request->file('avatar');
    $first_name = $request->post('first_name');
    $last_name = $request->post('last_name');
    $email = $request->post('email');
    $phone = $request->post('phone');
    $password = $request->post('password');
    $confirm_password = $request->post('confirm_password');


    $validator = new Validator;
    $user = new User;
    $fields = $user->selectId($session->get('id'), 'password, avatar');

    $validator->validate('First Name', $first_name, ['required', 'str', 'max']);
    $validator->validate('Last Name', $last_name, ['required', 'str', 'max']);
    $validator->validate('Email', $email, ['required', 'email', 'max', new UniqueEmail($user,$session->get('id'))]);
    $validator->validate('Phone', $phone, ['required', 'str', 'max']);

    if ($avatar && $avatar['error'] == 0) {
        $validator->validate('Avatar', $avatar, ['image']);
    }

    if ($validator->hasErrors()) {
        $session->set('errors', $validator->getErrors());
        $request->redirect('update-profile.blade.php');
        exit();
    }

    $avatarName = $fields['avatar'];
    if ($avatar && $avatar['error'] == 0) {
        $avatarPath = PATH . "assets/img/avatars/" . $avatarName;
        
        if (file_exists($avatarPath)) {
            unlink($avatarPath);
        }

        $file = new File($avatar);
        $avatarName = $file->rename()->upload();
    }

    if (!empty($password)) {
    
        $validator->validate('Password', $password, ['required', 'PasswordComplexity']);
        $validator->validate('Confirm Password', $confirm_password, [new ConfirmPassword($password)]);
        
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            
        $user->update(
        "first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', password='$hashPassword', avatar='$avatarName', updated_at=NOW()",
        $session->get('id')
        );
    }else{ 

        $user->update(
            "first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', avatar='$avatarName', updated_at=NOW()",
            $session->get('id')
        );
    }

    $session->set('success', 'Profile edited successfully');
    $session->destroy();
    $request->redirect('login.blade.php');
} else {
    
    $request->redirect('login.blade.php');
}