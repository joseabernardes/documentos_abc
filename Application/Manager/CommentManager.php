<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'CommentModel.php';

class CommentManager extends MyDataAccessPDO {

    const TABLE_NAME = 'comment';

    public function convertObjectToArray() {
        $data = array(
            'CommentID' => $a->getCommentID(),
            'CommentCONTENT' => $a->getCommentCONTENT(),
            'CommentDATE' => $a->getCommentDATE(),
            'CommentDocumentID' => $a->getCommentDocumentID(),
            'CommentNAME' => $a->getCommentNAME(),
            'CommentEMAIL' => $a->getCommentEMAIL(),
            'CommentUserID' => $a->getCommentUserID()
        );
        return $data;
    }

    public function add(DocumentModel $a) {
        $ins = array(
            'CommentID' => $a->getCommentID(),
            'CommentCONTENT' => $a->getCommentCONTENT(),
            'CommentDATE' => $a->getCommentDATE(),
            'CommentDocumentID' => $a->getCommentDocumentID(),
            'CommentNAME' => $a->getCommentNAME(),
            'CommentEMAIL' => $a->getCommentEMAIL(),
            'CommentUserID' => $a->getCommentUserID()
        );
        return $this->insert(self::TABLE_NAME, $ins);
    }

    public function getCommentsByID($CommentID) {
        $where = array('CommentID' => $CommentID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['CommentID']] = CommentModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getCommentsByUserID($UserID) {
        $where = array('CommentUserID' => $UserID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['CommentID']] = CommentModel::convertArrayToObject($rec);
        }
        return $list;
    }
    
        public function getCommentsByDocumentID($DocumentID) {
        $where = array('CommentDocumentID' => $DocumentID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['CommentID']] = CommentModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function deleteComment($CommentID) {
        try {
            $this->delete(self::TABLE_NAME, array('CommentID' => $CommentID));
        } catch (Exception $e) {
            throw $e;
        }
    }

}
