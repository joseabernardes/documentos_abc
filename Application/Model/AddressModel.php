<?php
/**
 * Description of AddressModel
 *
 * @author Pc
 */
class AddressModel {
    

    private $AddressID;
    private $AddressCOUNTRY;
    private $AddressCITY;

    function __construct($AddressID, $AddressCOUNTRY, $AddressCITY) {
        $this->AddressID = intval($AddressID);
        $this->AddressCOUNTRY = $AddressCOUNTRY;
        $this->AddressCITY = $AddressCITY;
    }

    function getAddressID() {
        return $this->AddressID;
    }

    function getAddressCOUNTRY() {
        return $this->AddressCOUNTRY;
    }

    function getAddressCITY() {
        return $this->AddressCITY;
    }

    function setAddressID($AddressID) {
        $this->AddressID = $AddressID;
    }

    function setAddressCOUNTRY($AddressCOUNTRY) {
        $this->AddressCOUNTRY = $AddressCOUNTRY;
    }

    function setAddressCITY($AddressCITY) {
        $this->AddressCITY = $AddressCITY;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['AddressID'], $data['AddressCOUNTRY'], $data['AddressCITY']);
    }

    public static function createObject($AddressID, $AddressCOUNTRY, $AddressCITY) {
        return new AddressModel($AddressID, $AddressCOUNTRY, $AddressCITY);
    }

    public function convertObjectToArray() {
        return array(
            'AddressID' => $this->getAddressID(),
            'AddressCOUNTRY' => $this->getAddressCOUNTRY(),
            'AddressCITY' => $this->getAddressCITY()
        );
    }
}
