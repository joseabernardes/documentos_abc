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
 * Description of AlbunsManagement
 *
 * @author José Bernardes
 */
class UsersManagement extends MyDataAccessPDO {

    const TABLE_NAME = 'User';

    /**
     * 
     * @param Album $a
     * @throws Exception
     */
    public function addUser(UserModel $a) {
        $ins = array();
        $ins['UserEMAIL'] = $a->getID();
        $ins['UserPASS'] = $a->getPassword();
        $ins['UserNAME'] = $a->getName();
        $ins['TokenID'] = $a->getTokenID();
        $ins['TokenVALUE'] = $a->getTokenVALUE();
        $this->insert(self::TABLE_NAME, $ins);
    }

    /**
     * 
     * @return array
     */
    public function getUsers() {

        $results = $this->getRecords(self::TABLE_NAME);


        $list = array();
        foreach ($results AS $rec) {
            $list[$rec['UserEMAIL']] = UserModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function deletUser(UserModel $a) {
        try {
            $this->delete(self::TABLE_NAME, array('UserEMAIL' => $a->getId()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateUser(UserModel $obj) {
        try {
            $this->update(self::TABLE_NAME, $obj->convertObjectToArray(), array('UserEMAIL' => $obj->getId()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getUserById($key) {
        $results = $this->getRecords(self::TABLE_NAME, array('UserEMAIL' => $key));

        $list = array();
        foreach ($results AS $rec) {
            $list[$rec['UserEMAIL']] = UserModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getUsersByToken($token) {
        $results = $this->getRecords(self::TABLE_NAME, array('TokenID' => $token));
        $list = array();

        foreach ($results AS $rec) {
            $list[$rec['UserEMAIL']] = UserModel::convertArrayToObject($rec);
        }

        return $list;
    }

    public function updateTokenForUser(UserModel $user, $tokenID, $tokenVALUE) {
        $user->setTokenID($tokenID);
        $user->setTokenVALUE($tokenVALUE);
        $this->updateUser($user);
    }

}
