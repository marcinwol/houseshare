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
class My_Model_Table_Rowset_Accommodation extends Zend_Db_Table_Rowset {

  
    /**
     * Get an array of My_Houseshare_Accommodation from the current rowset
     * 
     * @return array of My_Houseshare_Accommodation objects
     */
    public function toModels() {
        
        $models = array();
        
        foreach ($this as $acc) {
            $models []= My_Houseshare_Factory::accommodation($acc->acc_id);
        }
        
        return $models;
    }
    

}

?>
