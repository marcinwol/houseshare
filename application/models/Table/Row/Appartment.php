<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Appartment
 *
 * @author marcin
 */
class My_Model_Table_Row_Appartment extends Zend_Db_Table_Row_Abstract {

    /**
     * Return Accommodation row for the current shared accommodation
     * 
     * @return My_Model_Table_Row_Accommodation
     */
    public function getAccommodation() {
        return $this->findParentRow('My_Model_Table_Accommodation');
    }


   /**
     * Return details row of the current appartment
     *
     * @return My_Model_Table_NonSharedDetails
     */
    public function getDetails() {
         return $this->findParentRow('My_Model_Table_NonSharedDetails');
        
    }

}

?>
