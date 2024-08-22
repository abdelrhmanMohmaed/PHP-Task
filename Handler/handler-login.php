<?php

use PHP_Task\Classes\Validation\Validator;
use PHP_Task\Classes\Models\User;

require_once("../app.php");


if ($request->postHas('submit')) {
    $authenticator = $request->post('authenticator');
    $password = $request->post('password');

    $validator = new Validator;

    $validator->validate('authenticator', $authenticator, ['required', 'max']);
    $validator->validate('password', $password, ['required', 'str', 'max']);


    if ($validator->hasErrors()) {
        
        $session->set('errors', $validator->getErrors());
        $request->redirect('login.blade.php');
    } else {
        $user = new User;
        $isLogin = $user->login($authenticator, $password, $session);

        if ($isLogin) {
            $request->redirect('index.blade.php');
        } else {
            $session->set('errors', ['credentials are not correct']);
            $request->redirect('login.blade.php');
        }
    }
} else {
    $request->redirect('login.blade.php');
}