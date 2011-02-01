<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StringLengthNoTags
 *
 * @author marcin
 */
class My_Validate_StringLengthNoTags extends Zend_Validate_StringLength {

    public function  __construct($options = array()) {
        parent::__construct($options);
    }

    public function isValid($value) {
        return parent::isValid(trim(strip_tags($value)));
    }
}
?>
