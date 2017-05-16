<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TagModel
 *
 * @author Pc
 */
class TagModel {

    private $TagID;
    private $TagNAME;

    function __construct($TagID, $TagNAME) {
        $this->TagID = $TagID;
        $this->TagNAME = $TagNAME;
    }

    function getTagID() {
        return $this->TagID;
    }

    function getTagNAME() {
        return $this->TagNAME;
    }

    function setTagID($TagID) {
        $this->TagID = $TagID;
    }

    function setTagNAME($TagNAME) {
        $this->TagNAME = $TagNAME;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['TagID'], $data['TagNAME']);
    }

    public static function createObject($TagID, $TagNAME) {
        $tag = new TagModel($TagID, $TagNAME);

        return $tag;
    }

}
