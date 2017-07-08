<?php

require_once __DIR__ . '/Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
SessionManager::startSession();

if (array_key_exists('authUsername', $_SESSION)) {
    if (filter_input(INPUT_COOKIE, 'rememberme')) {
        $userManager = new UserManager();
        try {
            $user = $userManager->getUserById(SessionManager::getSessionValue('authUsername'));
            $userManager->deleteToken($user);
            setcookie('rememberme', "", time() - 60, "/");
        } catch (Exception $ex) { 
        }
    }
    SessionManager::destroySession('authUsername');
    header('Location: v_public/index.php');
}



