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
class DocumentManager {

    const TABLE_NAME = 'document';

    public function add(DocumentModel $a) {
        $ins = array();
        $ins['DocumentID'] = $a->getDocumentID();
        $ins['DocumentTITLE'] = $a->getDocumentTITLE();
        $ins['DocumentUserID'] = $a->getDocumentUserId();
        $ins['CategoryID'] = $a->getDocumentCategoryId();
        $ins['DocumentDATE'] = $a->getDocumentDATE();
        $ins['DocumentCONTENT'] = $a->getDocumentCONTENT();
        $ins['DocumentPATH'] = $a->getDocumentPATH();
        $ins['DocumentVisibilityID'] = $a->getDocumentVisibilityId();
        $ins['DocmentCOMMENTS'] = $a->getDocumentCOMMENTS();
        $this->insert(self::TABLE_NAME, $ins);
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

}
