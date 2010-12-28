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
     * Get all states.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    public function getStates() {
        return $this->fetchAll();
    }

    /**
     * Get all states.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    static public function getAllStates() {
        $obj = new self();
        return $obj->getStates();
    }

    /**
     * Get all sates from the databse in a form state_id=>name.
     * 
     * @return array of states
     */
    static public function getAllStatesAsArray() {

        $states = self::getAllStates()->toArray();

        $statesOptions = array();

        foreach ($states as $state) {
            $statesOptions[$state['state_id']] = $state['name'];
        }

        return $statesOptions;
    }

}

?>
