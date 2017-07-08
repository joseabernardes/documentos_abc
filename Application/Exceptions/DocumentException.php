<?php

/**
 * Description of DocumentException
 * 
 * code = 1 -> Get Exception
 * code = 2 -> Insert/Update/Delete Exception
 * code = 3 -> Historic Exception
 *
 * @author José Bernardes
 */
class DocumentException extends Exception {
    
    const HIST_EXCEPTION = 3;
    

    function __construct($message = null, $code = null, $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}
