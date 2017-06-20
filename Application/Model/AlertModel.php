<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlertModel
 *
 * @author Pc
 */
class AlertModel {

    private $AlertUserID;
    private $AlertDocumentID;

    function __construct($AlertUserID, $AlertDocumentID) {
        $this->AlertUserID = $AlertUserID;
        $this->AlertDocumentID = $AlertDocumentID;
    }

    function getAlertUserID() {
        return $this->AlertUserID;
    }

    function getAlertDocumentID() {
        return $this->AlertDocumentID;
    }

    function setAlertUserID($AlertUserID) {
        $this->AlertUserID = $AlertUserID;
    }

    function setAlertDocumentID($AlertDocumentID) {
        $this->AlertDocumentID = $AlertDocumentID;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['AlertUserID'], $data['AlertDocumentID']);
    }

    public static function createObject($AlertUserID, $ALertDocumentID) {
        $alert = new ALertModel($AlertUserID, $ALertDocumentID);

        return $alert;
    }

}
