<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HistoricManager
 *
 * @author Pc
 */
class HistoricManager {

    const TABLE_NAME = 'document_editing';

    public function add(HistoricModel $a) {
        $ins = array();
        $ins['EditingID'] = $a->getEditingID();
        $ins['DocumentID'] = $a->getDocumentID();
        $ins['EditingReason'] = $a->getEditingReason();
        $ins['EditingDATE'] = $a->getEditingDATE();
        $this->insert(self::TABLE_NAME, $ins);
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
        $where = array('DocumentoID' => $DocumentID);
        $array = $this->getRecords(self::TABLE_NAME, $where);
        $list = array();
        foreach ($array AS $rec) {
            $list[$rec['EditingID']] = HistoricModel::convertArrayToObject($rec);
        }
        return $list;
    }

}
