<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'DocumentModel.php';

class DocumentManager extends MyDataAccessPDO {

    const TABLE_NAME = 'document';
    const TABLE_DOCUMENT_TAG = 'document_tag';
    const TABLE_DOCUMENT_USER_SHARED = 'document_user_shared';

    public function add(DocumentModel $a) {
        $ins = array();
        $ins['DocumentID'] = $a->getDocumentID();
        $ins['DocumentTITLE'] = $a->getDocumentTITLE();
        $ins['DocumentSUMMARY'] = $a->getDocumentSUMMARY();
        $ins['DocumentUserID'] = $a->getDocumentUserId();
        $ins['DocumentCategoryID'] = $a->getDocumentCategoryId();
        $ins['DocumentDATE'] = $a->getDocumentDATE();
        $ins['DocumentCONTENT'] = $a->getDocumentCONTENT();
        $ins['DocumentPATH'] = $a->getDocumentPATH();
        $ins['DocumentVisibilityID'] = $a->getDocumentVisibilityId();
        $ins['DocumentCOMMENTS'] = $a->getDocumentCOMMENTS();
        try {
            $docid = $this->insert(self::TABLE_NAME, $ins);
        } catch (Exception $ex) {
            $docid = -1;
        }

        return $docid;
    }

    public function updateDocument(DocumentModel $obj) {
        try {
            $this->update(self::TABLE_NAME, $obj->convertObjectToArray(), array('DocumentID' => $obj->getDocumentID()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getDocumentByID($DocumentID) {
        $where = array('DocumentID' => $DocumentID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['DocumentID']] = DocumentModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getDocumentByUserID($DocumentUserID) {
        $where = array('DocumentUserID' => $DocumentUserID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['DocumentID']] = DocumentModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getDocumentByCategory($DocumentCategoryID) {
        $where = array('DocumentCategoryID' => $DocumentCategoryID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['DocumentID']] = DocumentModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getDocumentByTagID($DocumentTagID) {
        $where = array('DocumentTagID' => $DocumentTagID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['DocumentID']] = DocumentModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getDocumentPublics() {
        $where = array('DocumentVisibilityID' => '1');
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['DocumentID']] = DocumentModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function deleteDocument(DocumentModel $obj) {
        try {
            $this->delete(self::TABLE_NAME, array('DocumentID' => $obj->getDocumentID()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function addTagtoDocument($tag, $documentID) {
        $ins = array();
        $ins['TagName'] = $tag;
        $ins['DocumentID'] = $documentID;
        $this->insert(self::TABLE_DOCUMENT_TAG, $ins);
    }

    public function deleteTagsDocument($documentID) {
        try {
            $this->delete(self::TABLE_DOCUMENT_TAG, array('DocumentID' => $documentID));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getTagsByDocumentID($documentID) {
        $where = array('DocumentID' => $documentID);
        $array = $this->getRecords(self::TABLE_DOCUMENT_TAG, $where);
        return $array;
    }

    public function addSharedUsers($documentID, $userID, $comments) {
        $ins = array();
        $ins['DocumentID'] = $documentID;
        $ins['UserID'] = $userID;
        $ins['DocumentUserCOMMENTS'] = $comments;
        $this->insert(self::TABLE_DOCUMENT_USER_SHARED, $ins);
    }

    public function deleteSharedUsers($documentID) {
        try {
            $this->delete(self::TABLE_DOCUMENT_USER_SHARED, array('DocumentID' => $documentID));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getSharedUsersByDocumentID($documentID) {
        $where = array('DocumentID' => $documentID);
        $array = $this->getRecords(self::TABLE_DOCUMENT_USER_SHARED, $where);
        return $array;
    }

    public function getSharedUsersByUser_DocumentID($userID, $documentID) {
        $where = array('DocumentID' => $documentID, 'UserID' => $userID);
        $array = $this->getRecords(self::TABLE_DOCUMENT_USER_SHARED, $where);
        return $array;
    }

}
