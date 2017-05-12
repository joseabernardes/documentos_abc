<?php

require_once __DIR__ . '/../../Config.php';
require_once Config::getApplicationDatabasePath() . 'MyDataAccessPDO.php';
require_once Config::getApplicationModelPath() . 'Track.php';

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
class TracksManagement extends MyDataAccessPDO {

    const TABLE_NAME = 'Track';

    /**
     * 
     * @param Track $a
     */
    public function addTrack(Track $a) {
        $ins = array();
        $ins['TrackNUMBER'] = $a->getTrackNumber();
        $ins['TrackTITLE'] = $a->getTitle();
        $ins['TrackDURATION'] = $a->getDuration();
        $ins['TrackALBUM'] = $a->getAlbumID();
        $this->insert(self::TABLE_NAME, $ins);
    }
    public function deleteTrack(Track $a) {
        try {
            $this->delete(self::TABLE_NAME, array('TrackNUMBER' => $a->getTrackNumber(),'TrackALBUM' => $a->getAlbumID()));
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getTracks() {

        $results = $this->getRecords(self::TABLE_NAME);


        $list = array();
        foreach ($results AS $rec) {
            $list[$rec['TrackNUMBER']] = Track::convertArrayToObject($rec);
        }
        return $list;
    }

    public function getTracksByAlbum($key) {
        $results = $this->getRecords(self::TABLE_NAME, array('TrackALBUM' => $key));
        $list = array();
        foreach ($results AS $rec) {
            $list[$rec['TrackNUMBER']] = Track::convertArrayToObject($rec);
        }
        return $list;
    }

//    public function getAlbumById($key) {
//        return $this->getRecords(self::TABLE_NAME, array('AlbumID' => $key));
//    }
//
//    public function getAlbumByYear($year) {
//        return $this->getRecords(self::TABLE_NAME, array('AlbumYEAR' => $year));
//    }
}
