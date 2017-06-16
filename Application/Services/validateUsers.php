<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationModelPath() . 'UserModel.php';
SessionManager::startSession();

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$bool = 'false';
if (!empty($id) && SessionManager::keyExists('authUsername')) {
    try {
        $um = new UserManager();
        $mu = $um->getUserByID(SessionManager::getSessionValue('authUsername'));
        $u = reset($mu);
        if ($u->getUserAUTHLEVEL() === 'ADMIN') {
            $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $ar = $um->getUserByID($id);
            $us = reset($ar);
            if ($type == TRUE) {
                $us->setUserAUTHLEVEL('USER');
                $um->updateUser($us);
                $bool = 'true';
                echo $bool;
            } else if (type == FALSE) {
                $us->setUserAUTHLEVEL('USERINACTIVE');
                $um->updateUser($us);
                $bool = 'false';
                echo $bool;
            }
        } else {
            echo $bool;
        }
    } catch (Exception $exc) {
        echo $bool;
    }
} else {
    echo $bool;
}
