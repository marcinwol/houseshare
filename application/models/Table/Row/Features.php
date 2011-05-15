<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Feature
 *
 * @author marcin
 */
class My_Model_Table_Row_Features extends Zend_Db_Table_Row_Abstract {

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
    
    public function getAsString($feature = 'furniture') {
        $labels = $this->getLabels();
        $value = $this->$feature;
        return $labels[$feature]['value'][$value];
    }

}

?>
