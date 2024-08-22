<?php

use PHP_Task\Classes\Models\User;

require_once("../app.php");


if ($request->getHas('id')) { 
    $id = $request->get('id');

    $user = new User; 
    $avatarName = $user->selectId($id,"avatar")["avatar"];
    unlink(PATH."assets/img/avaters/".$avatarName);

    $user->delete($id);
    
    $teamMembers = $session->get('team_members');

    if (is_array($teamMembers)) {
        
        $teamMembers = array_filter($teamMembers, function($member) use ($id) {
            return $member['id'] !== $id;
        });

        $session->set('team_members', $teamMembers);
    }
    

    $session->set('success', 'Employee Deleted successfully');
    $request->redirect('index.blade.php');
}