<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'AlertModel.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlertManager
 *
 * @author Pc
 */
class AlertManager extends MyDataAccessPDO {

    const TABLE_NAME = 'alert';

    public function add(AlertModel $a) {
        $ins = array();
        $ins['AlertUserID'] = $a->getAlertUserID();
        $ins['AlertDocumentID'] = $a->getAlertDocumentID();
        $ins['AlertID'] = $a->getAlertID();
        $ins['AlertDATE'] = $a->getAlertDATE();
        return $this->insert(self::TABLE_NAME, $ins);
    }

    public function deleteAlert(AlertModel $obj) {
        try {
            $this->delete(self::TABLE_NAME, array('AlertID' => $obj->getAlertID()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteAlertByDocument($DocumentID) {
        try {
            $this->delete(self::TABLE_NAME, array('AlertDocumentID' => $DocumentID));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAlertsByUserID($AlterUserID) {
        $where = array('AlertUserID' => $AlterUserID);
        $array = $this->getRecords(self::TABLE_NAME, $where, array('AlertDATE DESC'));
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['AlertID']] = AlertModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getAlertsByAlertID($AlertID) {
        $where = array('AlertID' => $AlertID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['AlertID']] = AlertModel::convertArrayToObject($rec);
        }
        return $list;
    }

}
