<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Password
 *
 * @author marcin
 */
class My_Model_Table_Row_ResetPassword extends Zend_Db_Table_Row_Abstract {

    /**
     * Return User row for the current roomate
     * 
     * @return My_Model_Table_Row_User 
     */
    public function getUser() {
        return $this->findParentRow('My_Model_Table_User');
    }

    /**
     * If the row is expired or not.
     * 
     * @return boolean 
     */
    public function isExpired() {
        
        if (time() - $this->created > My_Model_Table_ResetPassword::EXPIRE_IN) {
            return true;
        }
        
        return false;
    }

}

?>
