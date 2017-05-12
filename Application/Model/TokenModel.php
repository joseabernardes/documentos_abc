<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TokenModel
 *
 * @author José Bernardes
 */
class TokenModel {

    //put your code here
    private $tokenID;
    private $tokenVALUE;

    function __construct($tokenID, $tokenVALUE) {

        $this->tokenID = bin2hex(openssl_random_pseudo_bytes(16));
        $this->tokenVALUE = password_hash(bin2hex(openssl_random_pseudo_bytes(16)), PASSWORD_DEFAULT);
    }

    public function generateNewToken() {
        $token = array();
        $this->setTokenVALUE(password_hash(bin2hex(openssl_random_pseudo_bytes(16)), PASSWORD_DEFAULT));
        return $token;
    }

    function getTokenID() {
        return $this->tokenID;
    }

    function getTokenVALUE() {
        return $this->tokenVALUE;
    }

    function setTokenID($tokenID) {
        $this->tokenID = $tokenID;
    }

    function setTokenVALUE($tokenVALUE) {
        $this->tokenVALUE = $tokenVALUE;
    }

}
