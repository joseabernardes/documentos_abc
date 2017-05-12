<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validations
 *
 * @author jam
 */
class Validations {
    public static function isInteger($value){
        return filter_var($value, FILTER_VALIDATE_INT);        
    }
    
    public static function isString($value){
        return is_string($value);
    }
}
