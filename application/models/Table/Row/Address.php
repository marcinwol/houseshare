<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Address
 *
 * @author marcin
 */
class My_Model_Table_Row_Address extends Zend_Db_Table_Row_Abstract {


     /**
     * Get Accommodations in the current address.
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getAccommodations() {
        return $this->findDependentRowset('My_Model_Table_Accommodation');
    }

     /**
     * Get Street Row for the current address row.
     *
     * @return Zend_Db_Table_Row_Street
     */
    public function getStreet() {
        return $this->findParentRow('My_Model_Table_Street');
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
     * Get Zip Row for the current address row.
     *
     * @return Zend_Db_Table_Row_Zip
     */
    public function getZip() {
        return $this->findParentRow('My_Model_Table_Zip');
    }


    /**
     * Get City Row for the current address row.
     *
     * @return Zend_Db_Table_Row_City
     */
    public function getCity() {
        return $this->findParentRow('My_Model_Table_City');
    }

    /**
     * Get State Row for the current address row.
     *
     * @return Zend_Db_Table_Row_State
     */
    public function getState() {
        return $this->getCity()->getState();
    }

}
?>
