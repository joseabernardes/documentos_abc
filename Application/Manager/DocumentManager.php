<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentManager
 *
 * @author Pc
 */
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
        return $this->insert(self::TABLE_NAME, $ins);
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

    public function addSharedUsers($documentID, $userID, $comments) {
        $ins = array();
        $ins['DocumentID'] = $documentID;
        $ins['UserID'] = $userID;
        $ins['DocumentUserCOMMENTS'] = $comments;
        $this->insert(self::TABLE_DOCUMENT_USER_SHARED, $ins);
    }

}
