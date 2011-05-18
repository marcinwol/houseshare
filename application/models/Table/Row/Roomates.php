<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Roomates row
 *
 * @author marcin
 */
class My_Model_Table_Row_Roomates extends Zend_Db_Table_Row_Abstract {

    /**
     * Get user friendly names of properties
     * 
     * @return array 
     */
    public function getLabels() {
       
        $class = $this->_tableClass;

        $tableClass = new $class();

        return $tableClass->getLabels();
    }

}

?>
