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
class My_Validate_MinMaxAge extends Zend_Validate_Abstract {
    
    const AGE = 'age';
    
    protected $_messageTemplates = array(
        self::AGE => "Maximum age should be higher than the minninum age"
    );
    
    public function isValid($value, $context = null) {
        
        $maxAge = (int) $value;
        $minAge = (int) $context['min_age_of_roomates'];

        if ($maxAge <= $minAge) {
            $this->_error(self::AGE);
            return false;
        }
        
        return true;
    }

}
?>
