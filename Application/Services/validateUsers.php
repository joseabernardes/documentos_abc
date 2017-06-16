<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationModelPath() . 'UserModel.php';
SessionManager::startSession();

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!empty($id) && SessionManager::keyExists('authUsername')) {
    try {
        $um = new UserManager();
        $mu = $um->getUserByID(SessionManager::getSessionValue('authUsername'));
        $u = reset($mu);
        if ($u->getUserAUTHLEVEL() === 'ADMIN') {
            $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $ar = $um->getUserByID($id);
            $us = reset($ar);
            if ($type == 'true') {
                $us->setUserAUTHLEVEL('USERINACTIVE');
                $um->updateUser($us);
                echo 'false';
            } else if ($type == 'false') {
                $us->setUserAUTHLEVEL('USER');
                $um->updateUser($us);
                echo 'true';
            }
        } else {
            echo 'false';
        }
    } catch (Exception $exc) {
        echo 'false';
    }
} else {
    echo 'false';
}
