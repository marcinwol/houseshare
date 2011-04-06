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
     * @return Zend_Db_Table_Row_State
     */
    public function getState() {
        return $this->findParentRow('My_Model_Table_State');
    }
    
     /**
     * Get Google map marker coordinates for the current city row.
     *
     * @return Zend_Db_Table_Row_Marker
     */
    public function getMarker() {
        return $this->findParentRow('My_Model_Table_Marker');
    }

    /**
     * Get Addressess in the current city row.
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getAddresses() {
        return $this->findDependentRowset('My_Model_Table_Address');
    }

}
?>
