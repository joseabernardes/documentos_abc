<?php

function createCommentLoggedUser($CommentCONTENT, $CommentDocumentID, $userID) {
    $return = false;
    if (!empty($CommentCONTENT)) {
        try {
            $userManager = new UserManager();
            $commentManager = new CommentManager();
            $user = $userManager->getUserByID($userID);
            $comment = new CommentModel('', $CommentCONTENT, date("Y-m-d H:i:s"), $CommentDocumentID, null, null, $userID);
            $comment->setCommentNAME($user->getUserNAME());
            $comment->setCommentID($commentManager->add($comment));
            $return = $comment->convertObjectToArray();
        } catch (Exception $ex) {
            //false
        }
    }
    return $return;
}

function createCommentPublic($CommentCONTENT, $CommentDocumentID, $CommentNAME, $CommentEMAIL) {
    $return = false;
    if (!empty($CommentCONTENT) && !empty($CommentNAME) && !empty($CommentEMAIL)) {
        try {
            $commentManager = new CommentManager();
            $comment = new CommentModel('', $CommentCONTENT, date("Y-m-d H:i:s"), $CommentDocumentID, $CommentNAME, $CommentEMAIL);
            $comment->setCommentID($commentManager->add($comment));
            $return = $comment->convertObjectToArray();
        } catch (Exception $ex) {
            //false
        }
    }
    return $return;
}

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationManagerPath() . 'SessionManager.php';
require_once Config::getApplicationManagerPath() . 'DocumentManager.php';
require_once Config::getApplicationManagerPath() . 'CommentManager.php';
require_once Config::getApplicationManagerPath() . 'UserManager.php';
require_once Config::getApplicationUtilsPath() . 'Permissions.php';
SessionManager::startSession();

$inputType = INPUT_POST;
$CommentCONTENT = filter_input($inputType, "CommentCONTENT", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$CommentDocumentID = filter_input($inputType, "CommentDocumentID", FILTER_SANITIZE_NUMBER_INT);
$CommentNAME = filter_input($inputType, "CommentNAME", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$CommentEMAIL = filter_input($inputType, "CommentEMAIL", FILTER_SANITIZE_EMAIL);

$docManager = new DocumentManager();
$userManager = new UserManager();
$return = false;
try {
    $doc = $docManager->getDocumentByID($CommentDocumentID);
    if (SessionManager::keyExists('authUsername')) {
        $userID = SessionManager::getSessionValue('authUsername');
        $permitions = Permissions::checkCommentPermitions($doc, $userID);
        if ($permitions != false) {
            $return = createCommentLoggedUser(trim($CommentCONTENT), $CommentDocumentID, $userID);
        }
    } else {
        $permitions = Permissions::checkCommentPermitions($doc, null);
        if ($permitions != false) {
            $return = createCommentPublic(trim($CommentCONTENT), $CommentDocumentID, trim($CommentNAME), trim($CommentEMAIL));
        }
    }
} catch (DocumentException $ex) {
    //false
}
echo json_encode($return, JSON_UNESCAPED_UNICODE);
