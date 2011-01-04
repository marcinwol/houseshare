<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Street
 *
 * @author marcin
 */
class My_Model_Table_Row_Street extends Zend_Db_Table_Row_Abstract {

    /**
     * Get Address at the current street.
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getAddresses() {
        return $this->findDependentRowset('My_Model_Table_Address');
    }

}
?>
