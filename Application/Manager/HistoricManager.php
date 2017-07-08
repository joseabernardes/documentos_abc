<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'HistoricModel.php';
require_once Config::getApplicationExceptionsPath() . "DocumentException.php";

class HistoricManager extends MyDataAccessPDO {

    const TABLE_NAME = 'documentediting';

    public function add(HistoricModel $a) {
        try {
            return $this->insert(self::TABLE_NAME, $a->convertObjectToArray());
        } catch (Exception $ex) {
            throw new DocumentException($ex->getMessage(), DocumentException::HIST_EXCEPTION);
        }
    }

    public function getHistoricByID($EditingID) {
        $where = array('EditingID' => $EditingID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['EditingID']] = HistoricModel::convertArrayToObject($rec);
        }

        return $list;
    }

    public function getHistoricByDocumentID($DocumentID) {
        $where = array('DocumentID' => $DocumentID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['EditingID']] = HistoricModel::convertArrayToObject($rec);
        }
        return $list;
    }

    public function deleteHistoric(HistoricModel $obj) {
        try {
            $this->delete(self::TABLE_NAME, array('EditingID' => $obj->getEditingID()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteHistoricByDocument($DocumentID) {
        try {
            $this->delete(self::TABLE_NAME, array('DocumentID' => $DocumentID));
        } catch (Exception $e) {
            throw $e;
        }
    }

}
