<?php
/**
 * Description of SessionException
 *
 * @author José Bernardes
 */
class SessionException extends Exception {

    function __construct($message = null, $code = null, $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}
