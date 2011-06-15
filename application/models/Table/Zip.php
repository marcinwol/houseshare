<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Zip
 *
 * @author marcin
 */
class My_Model_Table_Zip extends Zend_Db_Table_Abstract {

    protected $_name = "ZIP";
    protected $_dependentTables = array('My_Model_Table_Address');
    protected $_rowClass = 'My_Model_Table_Row_Zip';

    /**
     * Find Zip by value
     *
     * @param string $value Zip value
     * @return Zend_Db_Table_Row
     */
    public function findByValue($value) {

        $value = trim($value);

        return $this->fetchRow("value = '$value'");
    }

    /**
     * Insert zip if does not exisit.
     *
     * @param array $data zip data
     * @return int primary key value of zip
     */
    public function insertZip(array $data) {

        $row = $this->findByValue($data['zip']);

        if (is_null($row)) {
            //if 0 than such zip does not exist so create it.
            return $this->insert(array('value' => $data['zip']));
        } else {
            // such zip exists thus return its id
            return $row->zip_id;
        }
    }

    /**
     * Update zip if possible. It is possible to update zip
     * only when there is only one or less rows in the dependant table
     * (i.e. address)
     *
     * @param array $data zip data
     * @param int $id zip id
     * @return int primary key value of zip
     */
    public function updateZip(array $data, $id) {

        // first see if the new zip name already exhisits
        $row = $this->findByValue($data['zip']);

        if (!is_null($row)) {
            // if exists than return its id
            return $row->zip_id;
        }

        $row = $this->find($id)->current();

        if (is_null($row)) {
            throw new Zend_Db_Exception("No zip with id = $id");
        }

        if ($row->getAddresses()->count() > 1) {
            // There are many rows in dependant table, so
            // need to create new row in this one.
            return $this->insertZip($data);
        }

        $row->value = $data['zip'];
        return $row->save();
    }

}

?>
