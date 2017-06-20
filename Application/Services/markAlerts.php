<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationManagerPath() . 'AlertManager.php';
SessionManager::startSession();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!empty($id) && SessionManager::keyExists('authUsername')) {
    try {
        $alertsManager = new AlertManager();
        $arrayAlertsActual = $alertsManager->getAlertsByAlertID($id);
        $alert1 = reset($arrayAlertsActual);
        if (SessionManager::getSessionValue('authUsername') == $alert1->getAlertUserID()) {
            $alertsManager->deleteAlert($alert1);
            echo 'true';
        } else {
            echo 'false';
        }
    } catch (Exception $exc) {
        echo 'false';
    }
} else {
    echo 'false';
}