<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of City
 *
 * @author marcin
 */
class My_Model_Table_Row_City extends Zend_Db_Table_Row_Abstract  {

     /**
     * Get State Row for the current city row.
     *
     * @return Zend_Db_Table_Row
     */
    public function getState() {
        return $this->findParentRow('My_Model_Table_State');
    }

    /**
     * Get Addressess in the current city row.
     *
     * @return Zend_Db_Table_RowSet
     */
    public function getAddresses() {
        return $this->findDependentRowset('My_Model_Table_Address');
    }

}
?>
