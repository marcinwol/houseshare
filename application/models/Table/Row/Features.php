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
       
        $class = $this->_tableClass;

        $tableClass = new $class();

        return $tableClass->getLabels();
    }
    
    public function getAsString($feature = 'furniture') {
        $labels = $this->getLabels();
        
        $value = $this->$feature;
        
        $t = $this->_getTranslator();
        
        return $t->translate($labels[$feature]['value'][$value]);
    }
    
    protected function _getTranslator() {
        return Zend_Registry::get('Zend_Translate');
    }

}

?>
