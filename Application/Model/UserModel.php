<?php

class UserModel {

    private $email;
    private $password;
    private $name;
    private $tokenID;
    private $tokenVALUE;

    function __construct($email, $password, $name, $tokenID = null, $tokenVALUE = null) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->tokenID = $tokenID;
        $this->tokenVALUE = $tokenVALUE;
    }

    function getID() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getName() {
        return $this->name;
    }

    function getTokenID() {
        return $this->tokenID;
    }

    function getTokenVALUE() {
        return $this->tokenVALUE;
    }

    function setID($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setTokenID($tokenID) {
        $this->tokenID = $tokenID;
    }

    function setTokenVALUE($tokenVALUE) {
        $this->tokenVALUE = $tokenVALUE;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['UserEMAIL'], $data['UserPASS'], $data['UserNAME'], $data['TokenID'], $data['TokenVALUE']);
    }

    public static function createObject($email, $password, $name, $tokenID, $tokenVALUE) {
        $user = new UserModel($email, $password, $name, $tokenID, $tokenVALUE);

        return $user;
    }

    public function convertObjectToArray() {
        $data = array('UserEMAIL' => $this->getId(),
            'UserPASS' => $this->getPassword(),
            'UserNAME' => $this->getName(),
            'TokenID' => $this->getTokenID(),
            'tokenVALUE' => $this->getTokenVALUE());

        return $data;
    }

}
