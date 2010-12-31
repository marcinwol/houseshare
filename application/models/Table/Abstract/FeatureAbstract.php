<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Abstract model for tables with FEATURES
 *
 * @author marcin
 */
abstract class My_Model_Table_Abstract_FeatureAbstract extends Zend_Db_Table_Abstract {
    //put your code here

    /**
     * Get all features.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    public function getFeatures() {
        return $this->fetchAll();
    }

    /**
     * Get all features.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    static public function getAllFeatures() {
        $className = get_called_class();
        $mdl = new $className();
        return $mdl->getFeatures();
    }

}

?>
