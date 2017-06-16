<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationModelPath() . 'UserModel.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationManagerPath() . 'CategoryManager.php';
require_once Config::getApplicationModelPath() . 'CategoryModel.php';
require_once Config::getApplicationManagerPath() . 'DocumentManager.php';
require_once Config::getApplicationModelPath() . 'DocumentModel.php';
SessionManager::startSession();

$type = filter_input(INPUT_GET, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$ma = new UserManager();
$cateMan = new CategoryManager();

if ($type === 'add') {
    $catName = filter_input(INPUT_GET, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!empty($catName) && SessionManager::keyExists('authUsername')) {
        try {

            $manag = $ma->getUserByID(SessionManager::getSessionValue('authUsername'));
            $us = reset($manag);
            if ($us->getUserAUTHLEVEL() === 'ADMIN') {
                if (empty($cateMan->getCategoryByName($catName))) {
                    $cate = new CategoryModel('', $catName);
                    $bool = $cateMan->add($cate);
                    echo $bool;
                } else {
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
} else if ($type === 'remove') {
    $idCat = filter_input(INPUT_GET, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $bool = 'false';

    if (!empty($idCat) && SessionManager::keyExists('authUsername')) {
        try {
            $manag = $ma->getUserByID(SessionManager::getSessionValue('authUsername'));
            $us = reset($manag);
            if ($us->getUserAUTHLEVEL() === 'ADMIN') {
                $cateMan->deleteCategory($idCat);
                $docMa = new DocumentManager();
                $arrayDocs = $docMa->getDocumentByCategory($idCat);
                foreach ($arrayDocs as $value) {
                    $value->setDocumentCategoryId(1);
                    $docMa->updateDocument($value);
                   
                }
                 echo 'false';
            } else {
                echo $bool;
            }
        } catch (Exception $exc) {
            echo $bool;
        }
    } else {
        echo $bool;
    }
}


