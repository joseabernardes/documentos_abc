<?php

/**
 * Description of AddressException
 *
 * code = 1 -> Get Exception
 * code = 2 -> Insert/Update/Delete Exception
 * @author José Bernardes
 */
class AddressException extends Exception {

    function __construct($message = null, $code = null, $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}
