<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationManagerPath() . 'DocumentManager.php';
require_once Config::getApplicationManagerPath() . 'CommentManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
SessionManager::startSession();

$type = filter_input(INPUT_GET, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$input = filter_input(INPUT_GET, "input", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$docManager = new DocumentManager();
$userM = new UserManager();


if (!empty($type) && !empty($input)) {

    $input = trim($input);


    if ($type === 'user') {

        $user = $userM->getUserByEmail($input);
        $user = reset($user);

        if ($user) {
//            $user = new UserModel();

            $docs = $docManager->getDocumentByUserID($user->getUserID());
            if (!empty($docs)) {
                $tempArray = array();
                if (SessionManager::keyExists('authUsername')) {
                    $userID = SessionManager::getSessionValue('authUsername');
                }
                foreach ($docs as $value) {
//                    $value = new DocumentModel();


                    $visibility = $value->getDocumentVisibilityId();
                    if ($visibility == 2) {
                        if (SessionManager::keyExists('authUsername') && $userID == $value->getDocumentUserId()) {
                            $tags = $docManager->getTagsByDocumentID($value->getDocumentID());
                            $tag = array();
                            if (!empty($tags)) {
                                foreach ($tags as $ta) {
                                    $tag[] = $ta['TagName'];
                                }
                            }
                            $temp = array(
                                'DocumentID' => $value->getDocumentID(),
                                'DocumentTITLE' => $value->getDocumentTITLE(),
                                'DocumentUserID' => $value->getDocumentUserId(),
                                'DocumentUserNAME' => $user->getUserNAME(),
                                'DocumentSUMMARY' => $value->getDocumentSUMMARY(),
                                'DocumentDATE' => $value->getDocumentDATE(),
                                'DocumentTags' => $tag
                            );
                            array_push($tempArray, $temp);
                        }
                    } else if ($visibility == 3) {
                        if (SessionManager::keyExists('authUsername')) {
                            $shared = $docManager->getSharedUsersByUser_DocumentID($userID, $value->getDocumentID()); //ver se o documento foi partilhado com este utilizador
                            $shared = reset($shared);
                            if ($shared || $userID == $value->getDocumentUserId()) {
                                $tags = $docManager->getTagsByDocumentID($value->getDocumentID());
                                $tag = array();
                                if (!empty($tags)) {
                                    foreach ($tags as $ta) {
                                        $tag[] = $ta['TagName'];
                                    }
                                }
                                $temp = array(
                                    'DocumentID' => $value->getDocumentID(),
                                    'DocumentTITLE' => $value->getDocumentTITLE(),
                                    'DocumentUserID' => $value->getDocumentUserId(),
                                    'DocumentUserNAME' => $user->getUserNAME(),
                                    'DocumentSUMMARY' => $value->getDocumentSUMMARY(),
                                    'DocumentDATE' => $value->getDocumentDATE(),
                                    'DocumentTags' => $tag
                                );
                                array_push($tempArray, $temp);
                            }
                        }
                    } else if ($visibility == 1) {
                        $tags = $docManager->getTagsByDocumentID($value->getDocumentID());
                        $tag = array();
                        if (!empty($tags)) {
                            foreach ($tags as $ta) {
                                $tag[] = $ta['TagName'];
                            }
                        }
                        $temp = array(
                            'DocumentID' => $value->getDocumentID(),
                            'DocumentTITLE' => $value->getDocumentTITLE(),
                            'DocumentUserID' => $value->getDocumentUserId(),
                            'DocumentUserNAME' => $user->getUserNAME(),
                            'DocumentSUMMARY' => $value->getDocumentSUMMARY(),
                            'DocumentDATE' => $value->getDocumentDATE(),
                            'DocumentTags' => $tag
                        );
                        array_push($tempArray, $temp);
                    }
                }
                if (!empty($tempArray)) {
                    echo json_encode($tempArray, JSON_UNESCAPED_UNICODE);
                } else {
                    echo 'false';
                }
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    } else if ($type === 'title') {

        $docs = $docManager->getDocumentbyTitleStarts($input);


        if (!empty($docs)) {
            $tempArray = array();
            if (SessionManager::keyExists('authUsername')) {
                $userID = SessionManager::getSessionValue('authUsername');
            }
            foreach ($docs as $value) {
                //                    $value = new DocumentModel();
                $user = $userM->getUserByID($value->getDocumentUserId());
                $user = reset($user);
                $visibility = $value->getDocumentVisibilityId();
                if ($visibility == 2) {
                    if (SessionManager::keyExists('authUsername') && $userID == $value->getDocumentUserId()) {
                        $tags = $docManager->getTagsByDocumentID($value->getDocumentID());
                        $tag = array();
                        if (!empty($tags)) {
                            foreach ($tags as $ta) {
                                $tag[] = $ta['TagName'];
                            }
                        }
                        $temp = array(
                            'DocumentID' => $value->getDocumentID(),
                            'DocumentTITLE' => $value->getDocumentTITLE(),
                            'DocumentUserID' => $value->getDocumentUserId(),
                            'DocumentUserNAME' => $user->getUserNAME(),
                            'DocumentSUMMARY' => $value->getDocumentSUMMARY(),
                            'DocumentDATE' => $value->getDocumentDATE(),
                            'DocumentTags' => $tag
                        );
                        array_push($tempArray, $temp);
                    }
                } else if ($visibility == 3) {
                    if (SessionManager::keyExists('authUsername')) {
                        $shared = $docManager->getSharedUsersByUser_DocumentID($userID, $value->getDocumentID()); //ver se o documento foi partilhado com este utilizador
                        $shared = reset($shared);
                        if ($shared || $userID == $value->getDocumentUserId()) {
                            $tags = $docManager->getTagsByDocumentID($value->getDocumentID());
                            $tag = array();
                            if (!empty($tags)) {
                                foreach ($tags as $ta) {
                                    $tag[] = $ta['TagName'];
                                }
                            }

                            $temp = array(
                                'DocumentID' => $value->getDocumentID(),
                                'DocumentTITLE' => $value->getDocumentTITLE(),
                                'DocumentUserID' => $value->getDocumentUserId(),
                                'DocumentUserNAME' => $user->getUserNAME(),
                                'DocumentSUMMARY' => $value->getDocumentSUMMARY(),
                                'DocumentDATE' => $value->getDocumentDATE(),
                                'DocumentTags' => $tag
                            );
                            array_push($tempArray, $temp);
                        }
                    }
                } else if ($visibility == 1) {
                    $tags = $docManager->getTagsByDocumentID($value->getDocumentID());
                    $tag = array();
                    if (!empty($tags)) {
                        foreach ($tags as $ta) {
                            $tag[] = $ta['TagName'];
                        }
                    }
                    $temp = array(
                        'DocumentID' => $value->getDocumentID(),
                        'DocumentTITLE' => $value->getDocumentTITLE(),
                        'DocumentUserID' => $value->getDocumentUserId(),
                        'DocumentUserNAME' => $user->getUserNAME(),
                        'DocumentSUMMARY' => $value->getDocumentSUMMARY(),
                        'DocumentDATE' => $value->getDocumentDATE(),
                        'DocumentTags' => $tag
                    );
                    array_push($tempArray, $temp);
                }
            }
            if (!empty($tempArray)) {
                echo json_encode($tempArray, JSON_UNESCAPED_UNICODE);
            } else {

                echo 'false';
            }
        } else {

            echo 'false';
        }
    } else {
        echo 'false';
    }
} else {

    echo 'false';
}