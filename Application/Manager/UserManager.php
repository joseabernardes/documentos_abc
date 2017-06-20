<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'UserModel.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserManager
 *
 * @author Pc
 */
class UserManager extends MyDataAccessPDO {

    const TABLE_NAME = 'user';
    const TABLE_TOKEN = 'token';

    public function add(UserModel $a) {
        $ins = array();
        $ins['UserID'] = $a->getUserID();
        $ins['UserPASS'] = $a->getUserPASS();
        $ins['UserEMAIL'] = $a->getUserEMAIL();
        $ins['UserNAME'] = $a->getUserNAME();
        $ins['UserPHOTO'] = $a->getUserPHOTO();
        $ins['UserPHONE'] = $a->getUserPHONE();
        $ins['UserAUTHLEVEL'] = $a->getUserAUTHLEVEL();
        $ins['UserADDRESS'] = $a->getUserADDRESS();
        $ins['UserTokenID'] = $a->getUserTokenID();
        $this->insert(self::TABLE_NAME, $ins);
    }

    public function updateUser(UserModel $obj) {
        try {
            $this->update(self::TABLE_NAME, $obj->convertObjectToArray(), array('UserID' => $obj->getUserID()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getUserByID($UserID) {
        $where = array('UserID' => $UserID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['UserID']] = UserModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getUsers() {
        $array = $this->getRecordsByUserQuery("SELECT * FROM user WHERE UserAUTHLEVEL != 'USERINACTIVE'");
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['UserID']] = UserModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getUsersEmailStarts($email) {
        $email = $this->getConnection()->quote($email . '%');
        $sql = "SELECT * FROM user WHERE UserEMAIL LIKE {$email}";
        $array = $this->getRecordsByUserQuery($sql);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['UserID']] = UserModel::convertArrayToObject($rec);
        }
        return $list;
    }
   
    public function getUserByEmail($UserEMAIL) {
        $where = array('UserEMAIL' => $UserEMAIL);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['UserID']] = UserModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getUserByAuthLevel($UserAUTHLEVEL) {
        $where = array('UserAUTHLEVEL' => $UserAUTHLEVEL);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['UserID']] = UserModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getUserByTokenID($TokenID) {
        $where = array('UserTokenID' => $TokenID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['UserID']] = UserModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getTokenByID($TokenID) {
        $where = array('TokenID' => $TokenID);
        $array = $this->getRecords(self::TABLE_TOKEN, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['TokenID']] = $rec['TokenVALUE'];
        }
        return $list;
    }

//    public function deleteToken()

    public function updateTokenForUser(UserModel $user, $tokenID, $tokenVALUE) {
        $this->deleteToken($user);
        $this->addToken($tokenID, $tokenVALUE);
        $user->setUserTokenID($tokenID);
        $this->updateUser($user);
    }

    public function addToken($tokenID, $tokenVALUE) {
        $ins = array();
        $ins['TokenID'] = $tokenID;
        $ins['TokenVALUE'] = $tokenVALUE;
        $this->insert(self::TABLE_TOKEN, $ins);
    }

    public function deleteToken(UserModel $user) {
        $id = $user->getUserTokenID();
        $user->setUserTokenID(null);
        $this->updateUser($user);
        try {
            $this->delete(self::TABLE_TOKEN, array('TokenID' => $id));
        } catch (Exception $e) {
            throw $e;
        }
    }

}
