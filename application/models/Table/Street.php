<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * A model for a STREET table.
 * ADDRESS table is dependant of STREET
 *
 * @author marcin
 */
class My_Model_Table_Street extends Zend_Db_Table_Abstract {

    protected $_name = "STREET";
    protected $_dependentTables = array('My_Model_Table_Address');
    protected $_rowClass = 'My_Model_Table_Row_Street';

    /**
     * Find Street by name
     *
     * @param string $value Street value
     * @return Zend_Db_Table_Row
     */
    public function findByValue($value) {

        $value = trim($value);

        return $this->fetchRow("name = '$value'");
    }

    /**
     * Insert street if does not exisit.
     *
     * @param array $data street data
     * @return int primary key value of street
     */
    public function insertStreet(array $data) {

        $row = $this->findByValue($data['street_name']);

        if (is_null($row)) {
            //if 0 than such zip does not exist so create it.
            return $this->insert(array('name' => $data['street_name']));
        } else {
            // such zip exists thus return its id
            return $row->street_id;
        }
    }

    /**
     * Update street if possible. It is possible to update street
     * only when there is only one or less rows in the dependant table
     * (i.e. address)
     *
     * @param array $data street data
     * @param int $id street id
     * @return int primary key value of zip
     */
    public function updateStreet(array $data, $id) {

        // first see if the new street name already exhisits
        $row = $this->findByValue($data['street_name']);

        if (!is_null($row)) {
            // if exists than return its id
            return $row->street_id;
        }

        // if does not exhist, find street row by id and try to update it
        $row = $this->find($id)->current();

        if (is_null($row)) {
            throw new Zend_Db_Exception("No street with id = $id");
        }

        if ($row->getAddresses()->count() > 1) {
            // There are many rows in dependant table, so
            // need to create new row in this one.
            return $this->insertStreet($data);
        }



        $row->name = $data['street_name'];
        return $row->save();
    }

    /**
     * Find street  that match a given string
     *
     * @param string    $term  street name or part of the name
     * @param int       $limit Limit of returned rows.
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function findBasedOnName($term, $limit = 5) {
        $select = $this->select();
        $select->where("name LIKE '%$term%' ")->order('name ASC')->limit($limit);
        return $this->fetchAll($select);
    }

}

?>
