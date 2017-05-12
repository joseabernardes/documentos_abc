<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'Album.php';

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
class AlbunsManagement extends MyDataAccessPDO {

    const TABLE_NAME = 'Album';

    /**
     * 
     * @param Album $a
     * @throws Exception
     */
    public function addAlbum(Album $a) {
        $ins = array();
        $ins['AlbumID'] = $a->getId();
        $ins['AlbumNOME'] = $a->getName();
        $ins['AlbumPATH'] = $a->getPath();
        $ins['AlbumYEAR'] = $a->getYear();
        $ins['AlbumPRICE'] = $a->getPrice();
        $ins['AlbumTYPE'] = $a->getType();
        $this->insert(self::TABLE_NAME, $ins);
    }

    /**
     * 
     * @return array
     */
    public function getAlbuns() {

        $results = $this->getRecords(self::TABLE_NAME);


        $list = array();
        foreach ($results AS $rec) {
            $list[$rec['AlbumID']] = Album::convertArrayToObject($rec);
        }
        return $list;
    }
    
    
        public function deletAlbum(Album $a) {
        try {
            $this->delete(self::TABLE_NAME, array('AlbumID' => $a->getId()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAlbumById($key) {
        $results = $this->getRecords(self::TABLE_NAME, array('AlbumID' => $key));

        $list = array();
        foreach ($results AS $rec) {
            $list[$rec['AlbumID']] = Album::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getAlbumByYear($year) {
        return $this->getRecords(self::TABLE_NAME, array('AlbumYEAR' => $year));
    }

}
