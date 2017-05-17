<?php

require_once __DIR__ . '/../Model/UserModel.php';
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

    public function getUserByID($UserID) {
        $where = array('UserID' => $UserID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
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

    public function getUserByTokenID($TokenID) {
        $where = array('$UserTokenID' => $TokenID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['$UserID']] = UserModel::convertArrayToObject($rec);
        }
        return $list;
    }

}
