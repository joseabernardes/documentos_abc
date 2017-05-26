<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'CategoryModel.php';

class CategoryManager extends MyDataAccessPDO {

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

    public function getAllCategories() {

        $results = $this->getRecords(self::TABLE_NAME);


        $list = array();
        foreach ($results AS $rec) {
            $list[$rec['CategoryID']] = CategoryModel::convertArrayToObject($rec);
        }
        return $list;
    }

}