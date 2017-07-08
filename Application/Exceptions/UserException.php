<?php

/**
 * Description of UserException
 * 
 * code = 1 -> Get Exception
 * code = 2 -> Insert/Update/Delete Exception
 *
 * @author José Bernardes
 */
class UserException extends Exception {
    

    function __construct($message = null, $code = null, $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}
