<?php

/**
 * Description of AlertModel
 *
 * @author Pc
 */
class AlertModel {

    const SHARE = 'SHARE';
    const NOSHARE = 'NOSHARE';
    const DELETE = 'DELETE';

    private $AlertUserID;
    private $AlertDocumentID;
    private $AlertID;
    private $AlertDATE;
    private $AlertTYPE;
    private $AlertDocumentNAME;
    private $AlertUserSendID;

    function __construct($AlertID, $AlertUserID, $AlertUserSendID, $AlertDocumentID, $AlertDATE, $AlertTYPE, $AlertDocumentNAME = null) {
        $this->AlertUserID = $AlertUserID;
        $this->AlertDocumentID = $AlertDocumentID;
        $this->AlertUserSendID = $AlertUserSendID;
        $this->AlertID = $AlertID;
        $this->AlertDATE = $AlertDATE;
        $this->AlertTYPE = $AlertTYPE;
        $this->AlertDocumentNAME = $AlertDocumentNAME;
    }

    function getAlertUserSendID() {
        return $this->AlertUserSendID;
    }

    function setAlertUserSendID($AlertUserSendID) {
        $this->AlertUserSendID = $AlertUserSendID;
    }

    function getAlertDocumentNAME() {
        return $this->AlertDocumentNAME;
    }

    function setAlertDocumentNAME($AlertDocumentNAME) {
        $this->AlertDocumentNAME = $AlertDocumentNAME;
    }

    function getAlertTYPE() {
        return $this->AlertTYPE;
    }

    function setAlertTYPE($AlertTYPE) {
        $this->AlertTYPE = $AlertTYPE;
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
        return self::createObject($data['AlertID'], $data['AlertUserID'], $data['AlertUserSendID'], $data['AlertDocumentID'], $data['AlertDATE'], $data['AlertTYPE'], $data['AlertDocumentNAME']);
    }

    public static function createObject($AlertID, $AlertUserID, $AlertUserSendID, $ALertDocumentID, $AlertDATE, $AlertTYPE, $AlertDocumentNAME) {
        return new ALertModel($AlertID, $AlertUserID, $AlertUserSendID, $ALertDocumentID, $AlertDATE, $AlertTYPE, $AlertDocumentNAME);
    }

    public function convertObjectToArray() {
        return array(
            'AlertID' => $this->getAlertID(),
            'AlertUserID' => $this->getAlertUserID(),
            'AlertUserSendID' => $this->getAlertUserSendID(),
            'AlertDocumentID' => $this->getAlertDocumentID(),
            'AlertDATE' => $this->getAlertDATE(),
            'AlertTYPE' => $this->getAlertTYPE(),
            'AlertDocumentNAME' => $this->getAlertDocumentNAME(),
        );
    }

}
