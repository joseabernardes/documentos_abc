<?php
$inputType = INPUT_POST;

if (filter_has_var($inputType, 'submit') && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
   
    session_start();
    $email = filter_input($inputType, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input($inputType, 'Pass', FILTER_SANITIZE_SPECIAL_CHARS);

    require_once __DIR__ . '/Application/Manager/UserManager.php';
    require_once __DIR__ . '/Application/Manager/SessionManager.php';
    $users = new UserManager();

    $usersDump = $users->getUserByEmail($email);
    $user;

    try {
        SessionManager::addSessionValue('authUsername', $usersDump->getUserID());

        if (password_verify($pass, $user->getUserPASS())) {

            $_SESSION['authUsername'] = $user->getUserID();
        } else {
            echo 'Password Errada';
        }
    } catch (Exception $ex) {
        
    }
}
