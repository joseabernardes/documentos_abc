<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationModelPath() . 'UserModel.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'CategoryManager.php';
require_once Config::getApplicationModelPath() . 'CategoryModel.php';
SessionManager::startSession();

$catName = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$bool = 'false';

if (!empty($catName) && SessionManager::keyExists('authUsername')) {
    $ma = new UserManager();
    $manag = $ma->getUserByID(SessionManager::getSessionValue('authUsername'));
    $us = reset($manag);
    if ($us->getUserAUTHLEVEL() === 'ADMIN') {
        $cateMan = new CategoryManager();
        if (empty($cateMan->getCategoryByName($catName))) {
            $cate = new CategoryModel('', $catName);
            $cateMan->add($cate);
            $bool = 'true';
            echo $bool;
        } else {
            echo $bool;
        }
    } else {
        echo $bool;
    }
} else {
    echo $bool;
}