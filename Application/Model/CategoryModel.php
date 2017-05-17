<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryModel
 *
 * @author Pc
 */
class CategoryModel {

    private $CategoryID;
    private $CategoryNAME;

    function __construct($CategoryID, $CategoryNAME) {
        $this->CategoryID = $CategoryID;
        $this->CategoryNAME = $CategoryNAME;
    }

    function getCategoryID() {
        return $this->CategoryID;
    }

    function getCategoryNAME() {
        return $this->CategoryNAME;
    }

    function setCategoryID($CategoryID) {
        $this->CategoryID = $CategoryID;
    }

    function setCategoryNAME($CategoryNAME) {
        $this->CategoryNAME = $CategoryNAME;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['CategoryID'], $data['CategoryNAME']);
    }

    public static function createObject($CategoryID, $CategoryNAME) {
        $category = new TagModel($CategoryID, $CategoryNAME);

        return $category;
    }

}
