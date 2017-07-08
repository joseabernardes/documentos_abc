<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'UserModel.php';
require_once Config::getApplicationExceptionsPath() . "UserException.php";

/**
 * Description of UserManager
 *
 * @author Pc
 */
class UserManager extends MyDataAccessPDO {

    const TABLE_NAME = 'user';
    const TABLE_TOKEN = 'token';

    public function add(UserModel $a) {
        try {
            $this->insert(self::TABLE_NAME, $a->convertObjectToArray());
        } catch (Exception $ex) {
            throw new UserException($ex->getMessage(), Config::CUD_EXCEPTION);
        }
    }

    public function updateUser(UserModel $obj) {
        try {
            $this->update(self::TABLE_NAME, $obj->convertObjectToArray(), array('UserID' => $obj->getUserID()));
        } catch (Exception $e) {
            throw new UserException($e->getMessage(), Config::CUD_EXCEPTION);
        }
    }

    public function getUserByID($UserID) {
        try {
            $array = $this->getRecords(self::TABLE_NAME, array('UserID' => $UserID));
            if (count($array) == 1) {
                $rec = reset($array);
                return UserModel::convertArrayToObject($rec);
            } else {
                throw new Exception('Multiples IDs');
            }
        } catch (Exception $ex) {
            throw new UserException($ex->getMessage(), Config::GET_EXCEPTION);
        }
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
        $sql = "SELECT * FROM user WHERE UserEMAIL LIKE {$email} AND UserAUTHLEVEL != 'USERINACTIVE' LIMIT 5";
        $array = $this->getRecordsByUserQuery($sql);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['UserID']] = UserModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getUserByEmail($UserEMAIL) {
        $array = $this->getRecords(self::TABLE_NAME, array('UserEMAIL' => $UserEMAIL));
        if (count($array) == 1) {
            $rec = reset($array);
            return UserModel::convertArrayToObject($rec);
        } else {
            return false;
        }
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
