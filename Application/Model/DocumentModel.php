<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Document
 *
 * @author Pc
 */
class DocumentModel {

    private $DocumentID;
    private $DocumentTITLE;
    private $DocumentSUMMARY;
    private $DocumentUserID;
    private $DocumentCategoryID;
    private $DocumentDATE;
    private $DocumentCONTENT;
    private $DocumentPATH;
    private $DocumentVisibilityID;
    private $DocumentCOMMENTS;

    function __construct($DocumentID, $DocumentTITLE, $DocumentSUMMARY, $DocumentUserId, $DocumentCategoryId, $DocumentDATE, $DocumentCONTENT, $DocumentVisibilityId, $DocumentCOMMENTS, $DocumentPATH = null) {
        $this->DocumentID = $DocumentID;
        $this->DocumentTITLE = $DocumentTITLE;
        $this->DocumentSUMMARY = $DocumentSUMMARY;
        $this->DocumentUserID = $DocumentUserId;
        $this->DocumentCategoryID = $DocumentCategoryId;
        $this->DocumentDATE = $DocumentDATE;
        $this->DocumentCONTENT = $DocumentCONTENT;
        $this->DocumentPATH = $DocumentPATH;
        $this->DocumentVisibilityID = $DocumentVisibilityId;
        $this->DocumentCOMMENTS = $DocumentCOMMENTS;
    }

    function getDocumentID() {
        return $this->DocumentID;
    }

    function getDocumentTITLE() {
        return $this->DocumentTITLE;
    }

    function getDocumentSUMMARY() {
        return $this->DocumentSUMMARY;
    }

    function getDocumentUserId() {
        return $this->DocumentUserID;
    }

    function getDocumentCategoryId() {
        return $this->DocumentCategoryID;
    }

    function getDocumentDATE() {
        return $this->DocumentDATE;
    }

    function getDocumentCONTENT() {
        return $this->DocumentCONTENT;
    }

    function getDocumentPATH() {
        return $this->DocumentPATH;
    }

    function getDocumentVisibilityId() {
        return $this->DocumentVisibilityID;
    }

    function getDocumentCOMMENTS() {
        return $this->DocumentCOMMENTS;
    }

    function setDocumentID($DocumentID) {
        $this->DocumentID = $DocumentID;
    }

    function setDocumentTITLE($DocumentTITLE) {
        $this->DocumentTITLE = $DocumentTITLE;
    }

    function setDocumentSUMMARY($DocumentSUMMARY) {
        $this->DocumentSUMMARY = $DocumentSUMMARY;
    }

    function setDocumentUserId($DocumentUserId) {
        $this->DocumentUserID = $DocumentUserId;
    }

    function setDocumentCategoryId($DocumentCategoryId) {
        $this->DocumentCategoryID = $DocumentCategoryId;
    }

    function setDocumentDATE($DocumentDATE) {
        $this->DocumentDATE = $DocumentDATE;
    }

    function setDocumentCONTENT($DocumentCONTENT) {
        $this->DocumentCONTENT = $DocumentCONTENT;
    }

    function setDocumentPATH($DocumentPATH) {
        $this->DocumentPATH = $DocumentPATH;
    }

    function setDocumentVisibilityId($DocumentVisibilityId) {
        $this->DocumentVisibilityID = $DocumentVisibilityId;
    }

    function setDocumentCOMMENTS($DocumentCOMMENTS) {
        $this->DocumentCOMMENTS = $DocumentCOMMENTS;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['DocumentID'], $data['DocumentTITLE'], $data['DocumentSUMMARY'], $data['DocumentUserID'], $data['DocumentCategoryID'], $data['DocumentDATE'], $data['DocumentCONTENT'], $data['DocumentPATH'], $data['DocumentVisibilityID'], $data['DocumentCOMMENTS']);
    }

    public static function convertTagsToArray(Array &$tags) {
        $return = array();
        foreach ($tags as $tag) {
            $return[] = $tag['TagName'];
        }
        return $return;
    }

    public static function createObject($DocumentID, $DocumentTITLE, $DocumentSUMMARY, $DocumentUserId, $DocumentCategoryId, $DocumentDATE, $DocumentCONTENT, $DocumentPATH, $DocumentVisibilityId, $DocumentCOMMENTS) {
        $document = new DocumentModel($DocumentID, $DocumentTITLE, $DocumentSUMMARY, $DocumentUserId, $DocumentCategoryId, $DocumentDATE, $DocumentCONTENT, $DocumentVisibilityId, $DocumentCOMMENTS, $DocumentPATH);

        return $document;
    }

    public function convertObjectToArray() {
        $data = array(
            'DocumentID' => $this->getDocumentID(),
            'DocumentTITLE' => $this->getDocumentTITLE(),
            'DocumentUserID' => $this->getDocumentUserId(),
            'DocumentSUMMARY' => $this->getDocumentSUMMARY(),
            'DocumentCategoryID' => $this->getDocumentCategoryId(),
            'DocumentDATE' => $this->getDocumentDATE(),
            'DocumentCONTENT' => $this->getDocumentCONTENT(),
            'DocumentPATH' => $this->getDocumentPATH(),
            'DocumentVisibilityID' => $this->getDocumentVisibilityId(),
            'DocumentCOMMENTS' => $this->getDocumentCOMMENTS()
        );
        return $data;
    }

}
