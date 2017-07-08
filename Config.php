<?php

/**
 * Ficheiro de configuração
 *
 * @author ESTGF.PAW
 */
class Config {

    const IMAGES_FOLDER = '/images/';
    const SGBD_HOST_NAME = 'localhost';
    const SGBD_DATABASE_NAME = 'documentos_abc';
    const SGBD_USERNAME = 'root';
    const SGBD_PASSWORD = '';
    const DEFAULT_CATEGORY = 1;
    const PUBLIC_DOC = 1;
    const PRIVATE_DOC = 2;
    const SHARED_DOC = 3;
    const GET_EXCEPTION = 1;
    const CUD_EXCEPTION = 2; //Create Update Delete

    public static function getImagesPathBase() {
        return realpath(dirname(__FILE__)) . IMAGES_FOLDER;
    }

    public static function getApplicationPath() {
        return realpath(dirname(__FILE__)) . '/Application/';
    }

    public static function getApplicationDatabasePath() {
        return self::getApplicationPath() . '/Database/';
    }

    public static function getApplicationManagerPath() {
        return self::getApplicationPath() . '/Manager/';
    }

    public static function getApplicationModelPath() {
        return self::getApplicationPath() . '/Model/';
    }

    public static function getApplicationUtilsPath() {
        return self::getApplicationPath() . '/Utils/';
    }

    public static function getApplicationExceptionsPath() {
        return self::getApplicationPath() . '/Exceptions/';
    }

    public static function getApplicationControllersPath() {
        return self::getApplicationPath() . '/Controllers/';
    }

}
