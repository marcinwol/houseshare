<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accommodation
 *
 * @author marcin
 */
class My_Model_Table_Row_Accommodation extends Zend_Db_Table_Row_Abstract {

    /**
     * Get Address Row for the current accommodation row.
     *
     * @return Zend_Db_Table_Row_Address
     */
    public function getAddress() {
        return $this->findParentRow('My_Model_Table_Address');
    }

     /**
     * Get user Row for the current accommodation row.
     *
     * @return Zend_Db_Table_Row_User
     */
    public function getUser() {
        return $this->findParentRow('My_Model_Table_User');
    }

    /**
     * Get type Row for the current accommodation row.
     *
     * @return Zend_Db_Table_Row_Type
     */
    public function getType() {
        return $this->findParentRow('My_Model_Table_Type');
    }


     /**
     * Get Photos for the current accommodation.
     *
     * @return Zend_Db_Table_RowSet
     */
    public function getPhotos() {
        return $this->findDependentRowset('My_Model_Table_Photo');
    }



}

?>
