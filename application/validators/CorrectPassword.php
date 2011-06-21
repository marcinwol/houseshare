<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Custom validator to check if user entered correct password.
 *
 * @author marcin
 */
class My_Validate_CorrectPassword extends Zend_Validate_Abstract {

    /**
     * md5 string representing correct password
     * 
     * @var string 
     */
    protected $_correctPassword;

    const CORRECT_PASS = 'notCorrectPassword';

    protected $_messageTemplates = array(
        self::CORRECT_PASS => "Incorrect password"
    );
    
    
    public function __construct($correctPassword) {
        $this->_correctPassword = $correctPassword;
    }

    public function isValid($value, $context = null) {
       

        if (md5($value) !== $this->_correctPassword) {
            $this->_error(self::CORRECT_PASS);
            return false;
        }

        return true;
    }

}

?>
