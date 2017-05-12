<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Track
 *
 * @author José Bernardes
 */
class Track {

    private $trackNumber;
    private $title;
    private $duration;
    private $albumID;

    function __construct($trackNumber, $title, $duration, $albumID) {
        $this->trackNumber = $trackNumber;
        $this->title = $title;
        $this->duration = $duration;
        $this->albumID = $albumID;
    }

    function getAlbumID() {
        return $this->albumID;
    }

    function setAlbumID($albumID) {
        $this->albumID = $albumID;
    }

    function getTrackNumber() {
        return $this->trackNumber;
    }

    function getTitle() {
        return $this->title;
    }

    function getDuration() {
        return $this->duration;
    }

    function setTrackNumber($trackNumber) {
        $this->trackNumber = $trackNumber;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setDuration($duration) {
        $this->duration = $duration;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['TrackNUMBER'], $data['TrackTITLE'], $data['TrackDURATION'], $data['TrackALBUM']);
    }

    public static function createObject($trackNumber, $title, $duration, $albumID) {
        return new Track($trackNumber, $title, $duration, $albumID);
    }
}
