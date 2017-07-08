<?php
require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
SessionManager::startSession();
$inputType = INPUT_POST;
$id = filter_input($inputType, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$return = false;
if (SessionManager::keyExists('authUsername') && !empty($id)) {
    try {
        $userManager = new UserManager();
        $user = $userManager->getUserByID(SessionManager::getSessionValue('authUsername'));
        if ($user->getUserAUTHLEVEL() === 'ADMIN') {
            $type = filter_input($inputType, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $us = $userManager->getUserByID($id);
            if ($type == 'true') {
                $us->setUserAUTHLEVEL('USERINACTIVE');
                $userManager->updateUser($us);
            } else if ($type == 'false') {
                $us->setUserAUTHLEVEL('USER');
                $userManager->updateUser($us);
                $return = true;
            }
        }
    } catch (Exception $exc) {
        //false
    }
}

echo json_encode($return, JSON_UNESCAPED_UNICODE);
