<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryManager
 *
 * @author Pc
 */
class CategoryManager extends MyDataAccessPDO{

    const TABLE_NAME = 'category';

    public function add(CategoryModel $a) {
        $ins = array();
        $ins['CategoryID'] = $a->getCategoryID();
        $ins['CategoryNAME'] = $a->getCategoryNAME();
        $this->insert(self::TABLE_NAME, $ins);
    }

    public function getCategoryByID($CategoryID) {
        $where = array('CategoryID' => $CategoryID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['CategoryID']] = CategoryModel::convertArrayToObject($rec);
        }
        return $list;
    }

}
