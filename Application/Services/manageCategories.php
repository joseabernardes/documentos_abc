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

$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$ma = new UserManager();
$cateMan = new CategoryManager();
if ($type === 'add') {
    $catName = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $catName = trim($catName);

    if (!empty($catName) && SessionManager::keyExists('authUsername')) {
        try {
            $manag = $ma->getUserByID(SessionManager::getSessionValue('authUsername'));
            $us = reset($manag);
            if ($us->getUserAUTHLEVEL() === 'ADMIN') {
                if (empty($cateMan->getCategoryByName($catName))) {
                    $cate = new CategoryModel('', $catName);
                    echo $cateMan->add($cate);
                } else {
                    echo 'false';
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
} else if ($type === 'remove') {
    $idCat = filter_input(INPUT_POST, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!empty($idCat) && SessionManager::keyExists('authUsername')) {
        try {
            $manag = $ma->getUserByID(SessionManager::getSessionValue('authUsername'));
            $us = reset($manag);
            if ($us->getUserAUTHLEVEL() === 'ADMIN') {
                if ($idCat != 1) {
                    $docMa = new DocumentManager();
                    $arrayDocs = $docMa->getDocumentByCategory($idCat);
                    foreach ($arrayDocs as $value) {
                        $value->setDocumentCategoryId(1);
                        $docMa->updateDocument($value);
                    }
                    $cateMan->deleteCategory($idCat);
                    echo 'true';
                } else {
                    echo 'false';
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
}


