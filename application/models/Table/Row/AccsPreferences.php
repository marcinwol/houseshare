<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *  Row for intersection table
 * for MANY-to-MANY relationship between ACCOMMODATION and PREFERENCE
 *
 * @author marcin
 */
class My_Model_Table_Row_AccsPreferences extends Zend_Db_Table_Row_Abstract {

    /**
     * Name of parrent table.
     * 
     * @var string 
     */
    protected $_parentTable = 'My_Model_Table_Preference';
    /**
     * Parrent row
     *
     * @var My_Model_Table_Row
     */
    protected $_parentRow;
    /**
     * he data for each column in the row (column_name => value)
     * in the parrent Row.
     *
     * @var array
     */
    protected $_parentRowData;

    public function init() {

        $this->_parentRow = $this->findParentRow($this->_parentTable);

        // get parrent row data
        $this->_parentRowData = $this->_parentRow->toArray();

        // check if there are no duplicate columns (i.e. keys)
        // execpt primary key.
        $intersection = array_intersect_assoc($this->_data, $this->_parentRowData);

        if (count($intersection) > 1) {
            throw new Zend_Db_Table_Row_Exception("Duplicate columns");
        }
    }

    public function __get($columnName) {
        try {
            return parent::__get($columnName);
        } catch (Zend_Db_Table_Row_Exception $e) {

            // No $columnName in $this row, so check
            // parrent row.

            if (!array_key_exists($columnName, $this->_parentRowData)) {
                throw new Zend_Db_Table_Row_Exception("Specified column \"$columnName\" is not in the row");
            }

            return $this->_parentRowData[$columnName];
        }
    }

    /**
     * Returns the column/value data as an array.
     *
     * @return array
     */
    public function toArray() {

        return (array) array_merge($this->_data, $this->_parentRowData);
    }

    /**
     * Saves the properties to the database.
     *
     * This is not rewritten so it does NOT CHANGE values in the parrent
     * row.
     *
     * @return int The primary key value.
     */
    public function save() {
        return parent::save();
    }

}

?>
