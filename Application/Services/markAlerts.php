<?php
require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
SessionManager::startSession();
$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$return = false;
if (SessionManager::keyExists('authUsername') && !empty($id)) {
    try {
        require_once Config::getApplicationManagerPath() . 'AlertManager.php';
        $alertManager = new AlertManager();
        $ret = $alertManager->getAlertsByAlertID($id);
        if (SessionManager::getSessionValue('authUsername') == $ret->getAlertUserID()) {
            $alertManager->deleteAlert($ret);
            $return = true;
        }
    } catch (Exception $exc) {
        //false
    }
}
echo json_encode($return);
