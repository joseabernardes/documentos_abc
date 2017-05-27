<?php
$inputType = INPUT_POST;
$email = $pass = '';
if (filter_has_var($inputType, 'login') && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    session_start();
    $email = filter_input($inputType, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input($inputType, 'Pass', FILTER_SANITIZE_SPECIAL_CHARS);

    require_once __DIR__ . '/Application/Manager/UserManager.php';
    require_once __DIR__ . '/Application/Manager/SessionManager.php';
    
    $users = new UserManager();
    $usersDump = $users->getUserByEmail($email);
    $user;
    $errors = array();
    
    try {
        SessionManager::addSessionValue('authUsername', $usersDump->getUserID());

        if (password_verify($pass, $user->getUserPASS())) {
            $_SESSION['authUsername'] = $user->getUserID();
            header("Location: .../v_public/index.php");
        } else {
            $errors['password'] = 'Password nao existe';
        }
    } catch (Exception $ex) {
        
    }
}

