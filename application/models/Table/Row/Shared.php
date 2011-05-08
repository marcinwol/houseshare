<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Shared accommodation
 *
 * @author marcin
 */
class My_Model_Table_Row_Shared extends Zend_Db_Table_Row_Abstract {

    /**
     * Return Accommodation row for the current shared accommodation
     * 
     * @return My_Model_Table_Row_Accommodation
     */
    public function getAccommodation() {
        return $this->findParentRow('My_Model_Table_Accommodation');
    }


   /**
     * Return roomates row for the current shared accommodation
     *
     * @return My_Model_Table_Row_Roomates
     */
    public function getRoomates() {
         return $this->findParentRow('My_Model_Table_Roomates');
        
    }
    
      public function __wakeup() {
        $this->setTable(new My_Model_Table_Shared());
    }

}

?>
