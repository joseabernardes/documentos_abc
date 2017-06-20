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
    private $AlertID;

    function __construct($AlertID,$AlertUserID, $AlertDocumentID) {
        $this->AlertUserID = $AlertUserID;
        $this->AlertDocumentID = $AlertDocumentID;
        $this->$AlertID = $AlertID;
    }
    
    function getAlertID() {
        return $this->AlertID;
    }

    function setAlertID($AlertID) {
        $this->AlertID = $AlertID;
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
        return self::createObject($data['AlertID'],$data['AlertUserID'], $data['AlertDocumentID']);
    }

    public static function createObject($AlertID,$AlertUserID, $ALertDocumentID) {
        $alert = new ALertModel($AlertID,$AlertUserID, $ALertDocumentID);

        return $alert;
    }

}
