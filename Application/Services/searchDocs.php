<?php
function createSearchResult(DocumentModel $doc, $userName) {
    $docManager = new DocumentManager();
    $tags = $docManager->getTagsByDocumentID($doc->getDocumentID());
    return array(
        'DocumentID' => $doc->getDocumentID(),
        'DocumentTITLE' => $doc->getDocumentTITLE(),
        'DocumentUserID' => $doc->getDocumentUserId(),
        'DocumentUserNAME' => $userName,
        'DocumentSUMMARY' => $doc->getDocumentSUMMARY(),
        'DocumentDATE' => $doc->getDocumentDATE(),
        'DocumentTags' => DocumentModel::convertTagsToArray($tags)
    );
}
function searchDocuments($docs, $user) {
    $userManager = new UserManager();
    $return = array();
    if (!empty($docs)) {
        $userID = (SessionManager::keyExists('authUsername')) ? SessionManager::getSessionValue('authUsername') : null;
        foreach ($docs as $value) {
            if (Permissions::checkViewPermitions($value, $userID)) {
                if (!$user) {
                    try {
                        $user = $userManager->getUserByID($value->getDocumentUserId());
                    } catch (UserException $ex) {

                        $user = new UserModel('', '', '', '#### ####', '', '', '', '', '');
                    }
                }
                $return[] = createSearchResult($value, $user->getUserNAME());
            }
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

$inputType = INPUT_GET;
$type = filter_input($inputType, "type", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$input = filter_input($inputType, "input", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$docManager = new DocumentManager();
$userManager = new UserManager();

$tempArray = array();
if (!empty($type) && !empty($input)) {
    $input = trim($input);
    if ($type === 'user') {
        $user = $userManager->getUserByEmail($input);
        if ($user != false) {
            $tempArray = searchDocuments($docManager->getDocumentByUserID($user->getUserID()), $user);
        }
    } else if ($type === 'title') {
        $tempArray = searchDocuments($docManager->getDocumentbyTitleStarts($input), null);
    }
}
echo json_encode($tempArray, JSON_UNESCAPED_UNICODE);
