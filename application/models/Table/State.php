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
    protected $_rowClass = 'My_Model_Table_Row_State';

    /**
     * Get all states.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    public function getStates() {
        return $this->fetchAll();
    }

    /**
     * Find State by name
     *
     * @param string $value State value
     * @return Zend_Db_Table_Row
     */
    public function findByValue($value) {

        $value = trim($value);

        return $this->fetchRow("name = '$value'");
    }

    /**
     * Insert state if does not exisit.
     *
     * @param array $data state data
     * @return int primary key value of state
     */
    public function insertState(array $data) {

        $row = $this->findByValue($data['state_name']);

        if (is_null($row)) {
            //if 0 than such state does not exist so create it.
            return $this->insert(array('name' => $data['state_name']));
        } else {
            // such state exists thus return its id
            return $row->state_id;
        }
    }

    /**
     * Update state if possible. It is possible to update state
     * only when there is only one or less rows in the dependant table
     * (i.e. city)
     *
     * @param array $data state data
     * @param int $id state id
     * @return int primary key value of state
     */
    public function updateState(array $data, $id) {

        $row = $this->find($id)->current();

        if (is_null($row)) {
            throw new Zend_Db_Exception("No state with id = $id");
        }

        if ($row->getCities()->count() > 1) {
            // There are many rows in dependant table, so
            // need to create new row in this one.
            return $this->insertState($data);
        }

        $row->name = $data['state_name'];
        return $row->save();
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
