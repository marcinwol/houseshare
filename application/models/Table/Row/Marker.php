<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Photo
 *
 * @author marcin
 */
class My_Model_Table_Row_Marker extends Zend_Db_Table_Row_Abstract {

    
     /**
     * Get Addressess for the current marker.
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getAddresses() {
        return $this->findDependentRowset('My_Model_Table_Address');
    }
    
     /**
     * Get Cities for the current marker.
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getCities() {
        return $this->findDependentRowset('My_Model_Table_City');
    }
    

}

?>
