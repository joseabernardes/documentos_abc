<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserModel
 *
 * @author Pc
 */
class UserModel {

    private $UserID;
    private $UserPASS;
    private $UserEMAIL;
    private $UserNAME;
    private $UserPHOTO;
    private $UserPHONE;
    private $UserAUTHLEVEL;
    private $UserADDRESS;
    private $UserTokenID;

    function __construct($UserID, $UserPASS, $UserEMAIL, $UserNAME, $UserPHOTO, $UserPHONE, $UserAUTHLEVEL, $UserADDRESS, $UserTokenID) {
        $this->UserID = $UserID;
        $this->UserPASS = $UserPASS;
        $this->UserEMAIL = $UserEMAIL;
        $this->UserNAME = $UserNAME;
        $this->UserPHOTO = $UserPHOTO;
        $this->UserPHONE = $UserPHONE;
        $this->UserAUTHLEVEL = $UserAUTHLEVEL;
        $this->UserADDRESS = $UserADDRESS;
        $this->UserTokenID = $UserTokenID;
    }

    function getUserID() {
        return $this->UserID;
    }

    function getUserPASS() {
        return $this->UserPASS;
    }

    function getUserEMAIL() {
        return $this->UserEMAIL;
    }

    function getUserNAME() {
        return $this->UserNAME;
    }

    function getUserPHOTO() {
        return $this->UserPHOTO;
    }

    function getUserPHONE() {
        return $this->UserPHONE;
    }

    function getUserAUTHLEVEL() {
        return $this->UserAUTHLEVEL;
    }

    function getUserADDRESS() {
        return $this->UserADDRESS;
    }

    function getUserTokenID() {
        return $this->UserTokenID;
    }

    function setUserID($UserID) {
        $this->UserID = $UserID;
    }

    function setUserPASS($UserPASS) {
        $this->UserPASS = $UserPASS;
    }

    function setUserEMAIL($UserEMAIL) {
        $this->UserEMAIL = $UserEMAIL;
    }

    function setUserNAME($UserNAME) {
        $this->UserNAME = $UserNAME;
    }

    function setUserPHOTO($UserPHOTO) {
        $this->UserPHOTO = $UserPHOTO;
    }

    function setUserPHONE($UserPHONE) {
        $this->UserPHONE = $UserPHONE;
    }

    function setUserAUTHLEVEL($UserAUTHLEVEL) {
        $this->UserAUTHLEVEL = $UserAUTHLEVEL;
    }

    function setUserADDRESS($UserADDRESS) {
        $this->UserADDRESS = $UserADDRESS;
    }

    function setUserTokenID($UserTokenID) {
        $this->UserTokenID = $UserTokenID;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['UserID'], $data['UserPASS'], $data['UserEMAIL'], $data['UserNAME'], $data['UserPHOTO'], $data['UserPHONE'], $data['UserAUTHLEVEL'], $data['UserADDRESS'], $data['UserTokenID']);
    }

    public static function createObject($UserID, $UserPASS, $UserEMAIL, $UserNAME, $UserPHOTO, $USerPHONE, $UserAUTHLEVEL, $UserADDRESS, $UserTokenID) {
        $user = new UserModel($UserID, $UserPASS, $UserEMAIL, $UserNAME, $UserPHOTO, $USerPHONE, $UserAUTHLEVEL, $UserADDRESS, $UserTokenID);

        return $user;
    }

    public function convertObjectToArray() {
        $data = array(
            'UserID' => $this->getUserID(),
            'UserPASS' => $this->getUserPASS(),
            'UserEMAIL' => $this->getUserEMAIL(),
            'UserNAME' => $this->getUserNAME(),
            'UserPHOTO' => $this->getUserPHOTO(),
            'UserPHONE' => $this->getUserPHONE(),
            'UserAUTHLEVEL' => $this->getUserAUTHLEVEL(),
            'UserADDRESS' => $this->getUserADDRESS(),
            'UserTokenID' => $this->getUserTokenID()
        );
        return $data;
    }

}
