<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Type
 *
 * @author marcin
 */
class My_Model_Table_Type extends Zend_Db_Table_Abstract {

    protected $_name = "TYPE";
    protected $_rowClass = 'My_Model_Table_Row_Type';
    protected $_dependentTables = array('My_Model_Table_Accommodation');

    /**
     * Get id of type by given name
     *
     * @param string $name
     * @return Zend_Db_Table_Row
     */
    static function getByName($name) {
        $obj = new self();
        $select = $obj->select()->where(" name = ? ", $name);

        return $obj->fetchRow($select);
    }

    /**
     * Find Type by name
     *
     * @param string $value Type value
     * @return Zend_Db_Table_Row_Type
     */
    public function findByValue($value) {

        $value = trim($value);

        return $this->fetchRow("name = '$value'");
    }

    /**
     * Insert type if does not exisit.
     *
     * @param array $data type data
     * @return int primary key value of type
     */
    public function insertType(array $data) {

        $row = $this->findByValue($data['name']);

        if (is_null($row)) {
            //if 0 than such type does not exist so create it.
            return $this->insert(array('name' => $data['name']));
        }
        
        // such type exists thus return its id
        return $row->type_id;
    }

}

?>
