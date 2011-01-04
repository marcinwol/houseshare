<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author marcin
 */
class My_Model_Table_Row_User extends Zend_Db_Table_Row_Abstract {

    /**
     * Get Accommodations of current user
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getAccommodations() {
        return $this->findDependentRowset('My_Model_Table_Accommodation');
    }

}
?>
