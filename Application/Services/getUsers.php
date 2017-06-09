<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
SessionManager::startSession();
if (SessionManager::keyExists('authUsername')) {
    require_once Config::getApplicationManagerPath() . 'UserManager.php';


    $userM = new UserManager();

    $ret = $userM->getUsers();

    $tempArray = array();


    foreach ($ret as $value) {
        $temp = array(
            'userID' => $value->getUserID(),
            'userNAME' => $value->getUserNAME()
        );
        array_push($tempArray, $temp);
    }
    
    echo json_encode($tempArray,JSON_UNESCAPED_UNICODE);
} else {
    
    
      echo json_encode(array());
}