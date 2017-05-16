<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HistoricModel
 *
 * @author Pc
 */
class HistoricModel {

    private $EditingID;
    private $DocumentID;
    private $EditingReason;
    private $EditingDATE;

    function __construct($EditingID, $DocumentID, $EditingReason, $EditingDATE) {
        $this->EditingID = $EditingID;
        $this->DocumentID = $DocumentID;
        $this->EditingReason = $EditingReason;
        $this->EditingDATE = $EditingDATE;
    }

    function getEditingID() {
        return $this->EditingID;
    }

    function getDocumentID() {
        return $this->DocumentID;
    }

    function getEditingReason() {
        return $this->EditingReason;
    }

    function getEditingDATE() {
        return $this->EditingDATE;
    }

    function setEditingID($EditingID) {
        $this->EditingID = $EditingID;
    }

    function setDocumentID($DocumentID) {
        $this->DocumentID = $DocumentID;
    }

    function setEditingReason($EditingReason) {
        $this->EditingReason = $EditingReason;
    }

    function setEditingDATE($EditingDATE) {
        $this->EditingDATE = $EditingDATE;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['EditingID'], $data['DocumentID'], $data['EditingReason'], $data['EditingDATE']);
    }

    public static function createObject($EditingID, $DocumentID, $EditingReason, $EditingDATE) {
        $historic = new HistoricModel($EditingID, $DocumentID, $EditingReason, $EditingDATE);

        return $historic;
    }

}
