<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddressModel
 *
 * @author Pc
 */
class AddressModel {

    private $AddressID;
    private $AddressADDRESS;
    private $AddressCITY;
    private $AddressCP1;
    private $AddressCP2;

    function __construct($AddressID, $AddressADDRESS, $AddressCITY, $AddressCP1, $AddressCP2) {
        $this->AddressID = $AddressID;
        $this->AddressADDRESS = $AddressADDRESS;
        $this->AddressCITY = $AddressCITY;
        $this->AddressCP1 = $AddressCP1;
        $this->AddressCP2 = $AddressCP2;
    }

    function getAddressID() {
        return $this->AddressID;
    }

    function getAddressADDRESS() {
        return $this->AddressADDRESS;
    }

    function getAddressCITY() {
        return $this->AddressCITY;
    }

    function getAddressCP1() {
        return $this->AddressCP1;
    }

    function getAddressCP2() {
        return $this->AddressCP2;
    }

    function setAddressID($AddressID) {
        $this->AddressID = $AddressID;
    }

    function setAddressADDRESS($AddressADDRESS) {
        $this->AddressADDRESS = $AddressADDRESS;
    }

    function setAddressCITY($AddressCITY) {
        $this->AddressCITY = $AddressCITY;
    }

    function setAddressCP1($AddressCP1) {
        $this->AddressCP1 = $AddressCP1;
    }

    function setAddressCP2($AddressCP2) {
        $this->AddressCP2 = $AddressCP2;
    }

}
