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
    private $AlertDATE;

    function __construct($AlertID, $AlertUserID, $AlertDocumentID, $AlertDATE) {
        $this->AlertUserID = $AlertUserID;
        $this->AlertDocumentID = $AlertDocumentID;
        $this->AlertID = $AlertID;
        $this->AlertDATE = $AlertDATE;
    }

    function getAlertDATE() {
        return $this->AlertDATE;
    }

    function setAlertDATE($AlertDATE) {
        $this->AlertDATE = $AlertDATE;
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
        return self::createObject($data['AlertID'], $data['AlertUserID'], $data['AlertDocumentID'], $data['AlertDATE']);
    }

    public static function createObject($AlertID, $AlertUserID, $ALertDocumentID, $AlertDATE) {
        $alert = new ALertModel($AlertID, $AlertUserID, $ALertDocumentID, $AlertDATE);

        return $alert;
    }

}
