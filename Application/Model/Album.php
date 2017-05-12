<?php

/**
 * Description of Album
 *
 * @author José Bernardes
 */
class Album {

    private $id;
    private $name;
    private $path;
    private $year;
    private $price;
    private $type;

    function __construct($id, $name, $path, $year, $price, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->path = $path;
        $this->year = $year;
        $this->price = $price;
        $this->type = $type;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPath() {
        return $this->path;
    }

    function getYear() {
        return $this->year;
    }

    function getPrice() {
        return $this->price;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPath($path) {
        $this->path = $path;
    }

    function setYear($year) {
        $this->year = $year;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['AlbumID'], $data['AlbumNOME'], $data['AlbumPATH'], $data['AlbumYEAR'], $data['AlbumPRICE'], $data['AlbumTYPE']);
    }

    public static function createObject($id, $name, $path, $year, $price, $type) {
        $album = new Album($id, $name, $path, $year, $price, $type);

        return $album;
    }

}
