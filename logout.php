<?php

require_once Config::getApplicationManagerPath() . 'SessionManager.php';

if (array_key_exists('authUsername', $_SESSION)) {
    if (filter_input(INPUT_COOKIE, 'rememberme')) {
        $users = new UsersManager();
        $userDump = $users->getUserById($_SESSION['authUsername']);
        $user = reset($userDump);
        if ($user) {
            $users->deleteToken($user);
            setcookie('rememberme', "", time() - 60, "/");
        }
    }
    SessionManager::destroySession();
    header('Location:v_public/index.php');
}



