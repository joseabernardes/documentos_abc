<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationManagerPath() . 'DocumentManager.php';
require_once Config::getApplicationManagerPath() . 'CommentManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
SessionManager::startSession();

$CommentCONTENT = filter_input(INPUT_POST, "CommentCONTENT", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$CommentDocumentID = filter_input(INPUT_POST, "CommentDocumentID", FILTER_SANITIZE_NUMBER_INT);
$CommentNAME = filter_input(INPUT_POST, "CommentNAME", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$CommentEMAIL = filter_input(INPUT_POST, "CommentEMAIL", FILTER_SANITIZE_EMAIL);

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
            if (($shared && $shared['DocumentUserCOMMENTS']) ||  $userID == $doc->getDocumentUserId()) {
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