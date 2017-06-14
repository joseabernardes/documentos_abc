<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
SessionManager::startSession();

$input = filter_input(INPUT_POST, "input", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!empty($input) && SessionManager::keyExists('authUsername')) {

    $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    require_once Config::getApplicationManagerPath() . 'UserManager.php';
    $userM = new UserManager();


    //PARTILHAR COMIGO PROPRIO!!

    if ($type == 'search') {

        $ret = $userM->getUsersEmailStarts($input);

        if (count($ret) > 0) {

            $tempArray = array();

            foreach ($ret as $value) {
                if ($value->getUserID() != SessionManager::getSessionValue('authUsername')) {
                    array_push($tempArray, $value->getUserEMAIL());
                }
            }
            echo json_encode($tempArray, JSON_UNESCAPED_UNICODE);
        } else {
            echo 'false';
        }
    } else if ($type == 'add') {
        $ret = $userM->getUserByEmail($input);
        $ret = reset($ret);

        if ($ret && $ret->getUserID() != SessionManager::getSessionValue('authUsername')) {
            $temp = array(
                'userID' => $ret->getUserID(),
                'userEMAIL' => $ret->getUserEMAIL()
            );
            echo json_encode($temp, JSON_UNESCAPED_UNICODE);
        } else {
            echo 'false';
        }
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}