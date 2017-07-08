<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'DocumentModel.php';
require_once Config::getApplicationExceptionsPath() . "DocumentException.php";

class DocumentManager extends MyDataAccessPDO {

    const TABLE_NAME = 'document';
    const TABLE_DOCUMENT_TAG = 'document_tag';
    const TABLE_DOCUMENT_USER_SHARED = 'document_user_shared';

    public function add(DocumentModel $a) {
        try {
            $docid = $this->insert(self::TABLE_NAME, $a->convertObjectToArray());
        } catch (Exception $ex) {
            throw new DocumentException($ex->getMessage(), Config::CUD_EXCEPTION);
        }
        return $docid;
    }

    public function updateDocument(DocumentModel $obj) {
        try {
            $this->update(self::TABLE_NAME, $obj->convertObjectToArray(), array('DocumentID' => $obj->getDocumentID()));
        } catch (Exception $e) {
            throw new DocumentException($e->getMessage(), Config::CUD_EXCEPTION);
        }
    }

    public function getDocumentByID($DocumentID) {
        try {
            $array = $this->getRecords(self::TABLE_NAME, array('DocumentID' => $DocumentID));
            if (count($array) == 1) {   
                $rec = reset($array);
                return DocumentModel::convertArrayToObject($rec);
            } else {
                throw new Exception('IDs');
            }
        } catch (Exception $ex) {
            throw new DocumentException($ex->getMessage(), Config::GET_EXCEPTION);
        }
    }

    public function getDocumentByLimitOrdered($limit) {
        $sql = "SELECT * FROM document ORDER BY DocumentDATE DESC LIMIT {$limit}";
        $array = $this->getRecordsByUserQuery($sql);
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

    public function getDocumentByTag($tag) {
        $where = array('TagName' => $tag);
        $array = $this->getRecords(self::TABLE_DOCUMENT_TAG, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['DocumentID']] = $this->getDocumentByID($rec['DocumentID']);
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

    public function getDocumentbyTitleStarts($string) {
        $string = $this->getConnection()->quote($string . '%');
        $sql = "SELECT * FROM document WHERE DocumentTITLE LIKE {$string}";
        $array = $this->getRecordsByUserQuery($sql);
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
        return $this->getRecords(self::TABLE_DOCUMENT_TAG, array('DocumentID' => $documentID));
    }

    public function addSharedUsers($documentID, $userID, $comments) {
        $ins = array(
            'DocumentID' => $documentID,
            'UserID' => $userID,
            'DocumentUserCOMMENTS' => $comments
        );
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

    public function getSharedDocsByUserID($userID) {
        $where = array('UserID' => $userID);
        $array = $this->getRecords(self::TABLE_DOCUMENT_USER_SHARED, $where);
        return $array;
    }

}
