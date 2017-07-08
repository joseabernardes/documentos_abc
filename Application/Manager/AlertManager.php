<?php
require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'AlertModel.php';

/**
 * Description of AlertManager
 *
 * @author Pc
 */
class AlertManager extends MyDataAccessPDO {

    const TABLE_NAME = 'alert';

    public function add(AlertModel $a) {
        return $this->insert(self::TABLE_NAME, $a->convertObjectToArray());
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
        $array = $this->getRecords(self::TABLE_NAME, array('AlertID' => $AlertID));
        if (count($array) == 1) {
            $rec = reset($array);
            return AlertModel::convertArrayToObject($rec);
        } else {
            throw new Exception();
        }
    }
}
