<?php
require_once __DIR__ . '/../../Config.php';
use Config as Conf;
require_once Conf::getApplicationExceptionsPath() . "SessionException.php";

/**
 * Description of SessionManager
 *
 * @author José Bernardes
 */
class SessionManager {

    /**
     * 
     * @param type $key
     * @param type $value
     * @throws SessionException
     */
    public static function addSessionValue($key, $value) {
        self::startSession();
        if (!array_key_exists($key, $_SESSION)) {
            $_SESSION[$key] = $value;
        } else {
            throw new SessionException("Session key already exist");
        }
    }

    /**
     * 
     * @param type $key
     * @param type $value
     * @throws SessionException
     */
    public static function updateSessionValue($key, $value) {
        self::startSession();
        if (array_key_exists($key, $_SESSION)) {
            $_SESSION[$key] = $value;
        } else {
            throw new SessionException("Session key don't exist");
        }
    }

    /**
     * 
     * @param type $key
     * @throws SessionException
     */
    public static function deleteSessionValue($key) {
        self::startSession();
        if (array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        } else {
            throw new SessionException("Session key don't exist");
        }
    }

    /**
     * 
     * @param type $key
     * @return type
     * @throws SessionException
     */
    public static function getSessionValue($key) {
        self::startSession();
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        } else {
            throw new SessionException("Session key don't exist");
        }
    }

    /**
     * 
     * @throws SessionException
     */
    public static function destroySession() {
        if (!self::startSession()) {
            session_unset();
            session_destroy();
        } else {
            throw new SessionException("There is no open Session");
        }
    }

    /**
     * 
     * @return boolean
     */
    public static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            return true;
        } else {
            return false;
        }
    }

    public static function keyExists($key) {
          self::startSession();
        if (array_key_exists($key, $_SESSION)) {
            return true;
        } else {
            return false;
        }
    }

}
