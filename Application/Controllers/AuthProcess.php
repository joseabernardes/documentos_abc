<?php
$inputType = INPUT_POST;
$email = $pass = '';
$remember = 'on';
$loginErrors = array();
if (filter_has_var($inputType, 'login') && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input($inputType, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input($inputType, 'Pass', FILTER_SANITIZE_SPECIAL_CHARS);
    $remember = filter_input($inputType, 'remember', FILTER_SANITIZE_SPECIAL_CHARS);

    require_once __DIR__ . '/../../Config.php';
    require_once Config::getApplicationManagerPath() . 'SessionManager.php';
    require_once Config::getApplicationManagerPath() . 'UserManager.php';

    $users = new UserManager();
    $usersDump = $users->getUserByEmail($email);
    $user = reset($usersDump);

    if ($user) {
        //echo "tentando fazer login";
        try {
            if (password_verify($pass, $user->getUserPASS())) {
                SessionManager::addSessionValue('authUsername', $user->getUserID());
                //echo "FEITO";
                if ($remember === 'on') {
                    $tokenID = bin2hex(openssl_random_pseudo_bytes(32)); //rond
                    $tokenVALUE = bin2hex(openssl_random_pseudo_bytes(32)); //rond
                    $users->updateTokenForUser($user, $tokenID, password_hash($tokenVALUE, PASSWORD_DEFAULT));
                    setcookie('rememberme', "{$tokenID}___{$tokenVALUE}", time() + 3600 * 24, "/");
                }
                header("Location: ../v_public/index.php");
            } else {
                $loginErrors['password'] = 'Password Errada';
            }
        } catch (Exception $ex) {
            
        }
    } else {
        $loginErrors['email'] = 'Email nao existe';
        // echo "user não existe";
    }

    // print_r($errors);
}