<?php

class CommentModel {

    private $CommentID;
    private $CommentCONTENT;
    private $CommentDATE;
    private $CommentDocumentID;
    private $CommentNAME;
    private $CommentEMAIL;
    private $CommentUserID;

    function __construct($CommentID, $CommentCONTENT, $CommentDATE, $CommentDocumentID, $CommentNAME = null, $CommentEMAIL = null, $CommentUserID = null) {
        $this->CommentID = $CommentID;
        $this->CommentCONTENT = $CommentCONTENT;
        $this->CommentDATE = $CommentDATE;
        $this->CommentDocumentID = $CommentDocumentID;
        $this->CommentNAME = $CommentNAME;
        $this->CommentEMAIL = $CommentEMAIL;
        $this->CommentUserID = $CommentUserID;
    }

    function getCommentID() {
        return $this->CommentID;
    }

    function getCommentCONTENT() {
        return $this->CommentCONTENT;
    }

    function getCommentDATE() {
        return $this->CommentDATE;
    }

    function getCommentDocumentID() {
        return $this->CommentDocumentID;
    }

    function getCommentNAME() {
        return $this->CommentNAME;
    }

    function getCommentEMAIL() {
        return $this->CommentEMAIL;
    }

    function getCommentUserID() {
        return $this->CommentUserID;
    }

    function setCommentID($CommentID) {
        $this->CommentID = $CommentID;
    }

    function setCommentCONTENT($CommentCONTENT) {
        $this->CommentCONTENT = $CommentCONTENT;
    }

    function setCommentDATE($CommentDATE) {
        $this->CommentDATE = $CommentDATE;
    }

    function setCommentDocumentID($CommentDocumentID) {
        $this->CommentDocumentID = $CommentDocumentID;
    }

    function setCommentNAME($CommentNAME) {
        $this->CommentNAME = $CommentNAME;
    }

    function setCommentEMAIL($CommentEMAIL) {
        $this->CommentEMAIL = $CommentEMAIL;
    }

    function setCommentUserID($CommentUserID) {
        $this->CommentUserID = $CommentUserID;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['CommentID'], $data['CommentCONTENT'], $data['CommentDATE'], $data['CommentDocumentID'], $data['CommentNAME'], $data['CommentEMAIL'], $data['CommentUserID']);
    }

    public static function createObject($CommentID, $CommentCONTENT, $CommentDATE, $CommentDocumentID, $CommentNAME, $CommentEMAIL, $CommentUserID) {
        return new CommentModel($CommentID, $CommentCONTENT, $CommentDATE, $CommentDocumentID, $CommentNAME, $CommentEMAIL, $CommentUserID);
    }

    public function convertObjectToArray() {
        $data = array(
            'CommentID' => $this->getCommentID(),
            'CommentCONTENT' => $this->getCommentCONTENT(),
            'CommentDATE' => $this->getCommentDATE(),
            'CommentDocumentID' => $this->getCommentDocumentID(),
            'CommentNAME' => $this->getCommentNAME(),
            'CommentEMAIL' => $this->getCommentEMAIL(),
            'CommentUserID' => $this->getCommentUserID()
        );
        return $data;
    }

}
