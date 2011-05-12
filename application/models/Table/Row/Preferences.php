<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Preference
 *
 * @author marcin
 */
class My_Model_Table_Row_Preferences extends Zend_Db_Table_Row_Abstract {

    /**
     * Get user friendly names of properties
     * 
     * @return array 
     */
    public function getLabels() {

        $tableClass = $this->_tableClass;
        $labels = array();

        if (isset($tableClass::$labels)) {
            $labels = $tableClass::$labels;
        }

        return $labels;
    }
  

}

?>
