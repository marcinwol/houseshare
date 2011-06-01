<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Custom validator to check if user email is unique.
 *
 * @author marcin
 */
class My_Validate_UniqueEmail extends Zend_Validate_Identical {
    
   const UNIQUE_EMAIL = 'notUniqueEmail';
    
    protected $_messageTemplates = array(
        self::UNIQUE_EMAIL => "Given email already exist in our system"
    );
    
    public function isValid($value, $context = null) {    
        $row = My_Model_Table_User::fetchUsingEmail($value);
        
        // check if a given email belongs to a logged user
        // as we should not show an error when a user edits his/her info
        
        $auth  = Zend_Auth::getInstance();
        
        if ($auth->hasIdentity()) {
            if ($auth->getIdentity()->property->email === $value) {
                return true;
            }
        }
       
        if (null !== $row) {
            $this->_error(self::UNIQUE_EMAIL);
            return false;
        }
        
        return true;
    }

}
?>
