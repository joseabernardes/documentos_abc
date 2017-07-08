<?php

/**
 * Description of Permissions
 *
 * @author José Bernardes
 */
class Permissions {

    public static function checkViewPermitions(DocumentModel $doc, $userID) {
        $permitions = false;
        if ($doc->getDocumentVisibilityId() == 1) {
            $permitions = 1;
        } else if ($userID) { // tem login
            if ($doc->getDocumentVisibilityId() == 2 && $userID == $doc->getDocumentUserId()) { // é privado e é o owner
                $permitions = 2;
            } else if ($doc->getDocumentVisibilityId() == 3) {
                $docManager = new DocumentManager();
                $shared = $docManager->getSharedUsersByUser_DocumentID($userID, $doc->getDocumentID());
                if (!empty($shared) || $userID == $doc->getDocumentUserId()) {
                    $permitions = 3;
                }
            }
        }
        return $permitions;
    }

    public static function checkCommentPermitions(DocumentModel $doc, $userID) {
        $permitions = false;
        if ($doc->getDocumentVisibilityId() == 1 && $doc->getDocumentCOMMENTS()) { //se for publico e permitir comentários
            $permitions = true;
        } else if ($doc->getDocumentVisibilityId() == 3 && $userID) { // se for partilhado e tiver login   
            $docManager = new DocumentManager();
            $shared = $docManager->getSharedUsersByUser_DocumentID($userID, $doc->getDocumentID());
            $shared = reset($shared);
            if (($shared && $shared['DocumentUserCOMMENTS']) || $userID == $doc->getDocumentUserId()) { // se o user puder comentar, ou for owner
                $permitions = true;
            }
        }
        return $permitions;
    }

}
