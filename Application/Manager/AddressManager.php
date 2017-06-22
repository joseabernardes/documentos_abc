<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'AddressModel.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddressManager
 *
 * @author Pc
 */
class AddressManager extends MyDataAccessPDO {

    const TABLE_NAME = 'address';

    public function add(AddressModel $a) {
        $ins = array();
        $ins['AddressID'] = $a->getAddressID();
        $ins['AddressADDRESS'] = $a->getAddressADDRESS();
        $ins['AddressCITY'] = $a->getAddressCITY();
        $ins['AddressCP1'] = $a->getAddressCP1();
        $ins['AddressCP2'] = $a->getAddressCP2();
        return $this->insert(self::TABLE_NAME, $ins);
    }

    public function getAddressByID($AddressID) {
        $where = array('AddressID' => $AddressID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['AddressID']] = AddressModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function updateAdress(AddressModel $a) {
        try {
            $this->update(self::TABLE_NAME, $a->convertObjectToArray(), array('AddressID' => $a->getAddressID()));
        } catch (Exception $e) {
            throw $e;
        }
    }

}
