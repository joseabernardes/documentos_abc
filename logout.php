<?php
require_once __DIR__ . '/Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
SessionManager::startSession();

if (array_key_exists('authUsername', $_SESSION)) {
    if (filter_input(INPUT_COOKIE, 'rememberme')) {
        $users = new UserManager();
        $userDump = $users->getUserById($_SESSION['authUsername']);
        $user = reset($userDump);
        if ($user) {
            $users->deleteToken($user);
            setcookie('rememberme', "", time() - 60, "/");
        }
    }
    SessionManager::destroySession('authUsername');
    header('Location:v_public/index.php');
}



