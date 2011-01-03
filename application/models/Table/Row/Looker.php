<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Looker
 *
 * @author marcin
 */
class My_Model_Table_Row_Looker extends Zend_Db_Table_Row_Abstract {

    /**
     * Return User row for the current roomate
     * 
     * @return My_Model_Table_Row_User 
     */
    public function getUser() {
        return $this->findParentRow('My_Model_Table_User');
    }

}

?>
