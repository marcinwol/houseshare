<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Custom validator for max and min ages.
 *
 * @author marcin
 */
class My_Validate_Identical2 extends Zend_Validate_Identical {
    
   
    
    protected $_messageTemplates = array(
        self::AGE => "Maximum age should be higher than the minninum age"
    );
    
    public function isValid($value, $context = null) {
        
        $maxAge = (int) $value;
        $minAge = (int) $context['min_age'];

        if ($maxAge <= $minAge) {
            $this->_error(self::AGE);
            return false;
        }
        
        return true;
    }

}
?>
