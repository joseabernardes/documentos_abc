<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationManagerPath() . 'DocumentManager.php';
require_once Config::getApplicationManagerPath() . 'CommentManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
SessionManager::startSession();

$type = filter_input(INPUT_GET, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$input = filter_input(INPUT_GET, "input", FILTER_SANITIZE_FULL_SPECIAL_CHARS);




if (!empty($type) && !empty($input)) {

    $input = trim($input);


    if ($type === 'user') {
        $userM = new UserManager();
        $user = $userM->getUserByEmail($input);
        $user = reset($user);

        if ($user) {
            $user = new UserModel();
            $docManager = new DocumentManager();
            $docs = $docManager->getDocumentByUserID($user->getUserID());
            if (!empty($doc)) {
                $tempArray = array();
                foreach ($array as $value) {
                    $value = new DocumentModel();
                    $visibility = $value->getDocumentVisibilityId();
                    if ($visibility == 2) {
                        if (SessionManager::keyExists('authUsername') && SessionManager::getSessionValue('authUsername') == $value->getDocumentUserId()) {
                            $tempArray[] = $value;
                        } else {
                            echo 'false';
                        }
                    }
                }
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    } else if ($type === 'title') {
        
    } else {
        echo 'false';
    }
} else {

    echo 'false';
}

$docManager = new DocumentManager();

$doc = $docManager->getDocumentByID($CommentDocumentID);
if (!empty($doc)) {
    $doc = reset($doc);
    $visibility = $doc->getDocumentVisibilityId();
    if ($visibility == 2) {
        echo 'false';
    } else if ($visibility == 3) {
        if (SessionManager::keyExists('authUsername')) {
            $userID = SessionManager::getSessionValue('authUsername');
            $shared = $docManager->getSharedUsersByUser_DocumentID($userID, $CommentDocumentID);
            $shared = reset($shared);
            if ($shared && $shared['DocumentUserCOMMENTS']) {
                if (!empty($CommentCONTENT)) {
                    try {
                        $userMan = new UserManager();
                        $user = $userMan->getUserByID($userID);
                        $user = reset($user);
                        if ($user) {
                            $commentManager = new CommentManager();
                            $comment = new CommentModel('', $CommentCONTENT, date("Y-m-d H:i:s"), $CommentDocumentID, null, null, $userID);
                            $comment->setCommentNAME($user->getUserNAME());
                            $comment->setCommentID($commentManager->add($comment));

                            echo json_encode($comment->convertObjectToArray(), JSON_UNESCAPED_UNICODE);
                        } else {
                            echo 'false';
                        }
                    } catch (Exception $ex) {
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
    } else if ($visibility == 1) {
        if ($doc->getDocumentCOMMENTS()) { //se permite comentários publicos
            if (SessionManager::keyExists('authUsername')) {
                $userID = SessionManager::getSessionValue('authUsername');
                if (!empty($CommentCONTENT)) {
                    try {
                        $userMan = new UserManager();
                        $user = $userMan->getUserByID($userID);
                        $user = reset($user);
                        if ($user) {
                            $commentManager = new CommentManager();
                            $comment = new CommentModel('', $CommentCONTENT, date("Y-m-d H:i:s"), $CommentDocumentID, null, null, $userID);
                            $comment->setCommentNAME($user->getUserNAME());
                            $comment->setCommentID($commentManager->add($comment));

                            echo json_encode($comment->convertObjectToArray(), JSON_UNESCAPED_UNICODE);
                        } else {
                            echo 'false';
                        }
                    } catch (Exception $ex) {
                        echo 'false';
                    }
                } else {
                    echo 'false';
                }
            } else {
                if (!empty($CommentCONTENT) && !empty($CommentNAME) && !empty($CommentEMAIL)) {
                    try {
                        $commentManager = new CommentManager();
                        $comment = new CommentModel('', $CommentCONTENT, date("Y-m-d H:i:s"), $CommentDocumentID, $CommentNAME, $CommentEMAIL);
                        $comment->setCommentID($commentManager->add($comment));

                        echo json_encode($comment->convertObjectToArray(), JSON_UNESCAPED_UNICODE);
                    } catch (Exception $ex) {
                        echo 'false';
                    }
                } else {

                    echo 'false';
                }
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