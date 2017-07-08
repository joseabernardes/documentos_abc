<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
SessionManager::startSession();

$inputType = INPUT_POST;
$input = filter_input($inputType, "input", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$return = false;
if (!empty($input)) {
    $type = filter_input($inputType, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    require_once Config::getApplicationManagerPath() . 'UserManager.php';
    $userManager = new UserManager();

    if ($type == 'emailShare' || $type == 'emailSearch') {

        if ($type == 'emailShare' && SessionManager::keyExists('authUsername')) {
            $userID = SessionManager::getSessionValue('authUsername');
        } else {
            $userID = -1; // vai ser sempre diferente no if do for
        }
        $ret = $userManager->getUsersEmailStarts($input);
        if (!empty($ret)) {
            $tempArray = array();
            foreach ($ret as $value) {
                if ($value->getUserID() != $userID) {
                    $tempArray[] = $value->getUserEMAIL();
                }
            }
            $return = $tempArray;
        }
    } else if ($type == 'emailShareFull' && SessionManager::keyExists('authUsername')) {
        $ret = $userManager->getUserByEmail($input);
        if ($ret != false && $ret->getUserID() != SessionManager::getSessionValue('authUsername')) {
            $tempArray = array(
                'userID' => $ret->getUserID(),
                'userEMAIL' => $ret->getUserEMAIL()
            );
            $return = $tempArray;
        }
    }
}
echo json_encode($return, JSON_UNESCAPED_UNICODE);
