<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * A model for a STATE table.
 * CITY table is dependant of STATE
 *
 * @author marcin
 */
class My_Model_DbTable_State extends Zend_Db_Table_Abstract {
    //put your code here

    protected $_name = "STATE";
    protected $_dependentTables = array('My_Model_DbTable_City');


    /**
     * Get all cities.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    public function getStates() {
       return  $this->fetchAll();
    }

}
?>
