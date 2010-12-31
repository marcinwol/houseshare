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
class My_Model_Table_State extends Zend_Db_Table_Abstract {

    //put your code here

    protected $_name = "STATE";
    protected $_dependentTables = array('My_Model_Table_City');

    /**
     * Get all states.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    public function getStates() {
        return $this->fetchAll();
    }


     /**
     * Find states  that match a given string
     *
     * @param string    $term  State name or part of the name
     * @param int       $limit Limit of returned rows.
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function findStatesBasedOnName($term, $limit = 5) {
        $select = $this->select();
        $select->where("name LIKE '%$term%' ")->order('name ASC')->limit($limit);
        return $this->fetchAll($select);
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
