<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'AddressModel.php';
require_once Config::getApplicationExceptionsPath() . "AddressException.php";
/**
 * Description of AddressManager
 *
 * @author Pc
 */
class AddressManager extends MyDataAccessPDO {

    const TABLE_NAME = 'address';

    public function add(AddressModel $a) {
        try {
            return $this->insert(self::TABLE_NAME, $a->convertObjectToArray());
        } catch (Exception $ex) {
            throw new AddressException("Insert", 2);
        }
    }

    public function getAddressByID($AddressID) {
        try {
            $array = $this->getRecords(self::TABLE_NAME, array('AddressID' => $AddressID));
            if (count($array) == 1) {
                $rec = reset($array);
                return AddressModel::convertArrayToObject($rec);
            } else {
                throw new Exception();
            }
        } catch (Exception $ex) {
            throw new AddressException("multiple ID", 1);
        }
    }

    public function deleteAddress($AddressID) {
        try {
            $this->delete(self::TABLE_NAME, array('AddressID' => $AddressID));
        } catch (Exception $e) {
            throw new AddressException("Delete", 2);
        }
    }

    public function updateAdress(AddressModel $a) {
        try {
            $this->update(self::TABLE_NAME, $a->convertObjectToArray(), array('AddressID' => $a->getAddressID()));
        } catch (Exception $e) {
            throw new AddressException("Update", 2);
        }
    }

}
