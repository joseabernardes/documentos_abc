<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TagManager
 *
 * @author Pc
 */
class TagManager {

    const TABLE_NAME = 'Tag';

    public function add(TagModel $a) {
        $ins = array();
        $ins['TagID'] = $a->getTagID();
        $ins['TagNAME'] = $a->getTagNAME();
        $this->insert(self::TABLE_NAME, $ins);
    }

    public function getTagByID($TagID) {
        $where = array('TagID' => $TagID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['TagID']] = TagModel::convertArrayToObject($rec);
        }
        return $list;
    }

}
