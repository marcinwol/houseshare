<?php

/**
 * Abstract class to work with houseshare data.
 *
 * @author marcin
 */
abstract class My_Houseshare_Abstract_PropertyAccessor {

    /**
     *
     * @var My_Model_Table
     */
    protected $_model;
    /**
     *
     * @var My_Model_Table_Row 
     */
    protected $_row;
    /**
     *
     * @var string 
     */
    protected $_modelName;
    protected $_properties = array();
    protected $_changedProperties = array();


    public function __construct($id = null) {

        $modelObj = "My_Model_Table_{$this->_modelName}";
        $this->_model = new $modelObj();

        if (!is_null($id)) {
            $this->_populateProperties($id);
        }
    }

    public function __get($propertyName) {

        if (!array_key_exists($propertyName, $this->_properties)) {
            throw new Zend_Exception("Invalid property: $propertyName");
        } else {
            return $this->_properties[$propertyName];
        }
    }

    public function __set($propertyName, $value) {

        if (!array_key_exists($propertyName, $this->_properties)) {
            throw new Zend_Exception("Invalid property: $propertyName");
        } else {
            if (stripos($propertyName, '_id')) {
                throw new Zend_Exception("Cannot change '_id' property : $propertyName");
            }
            $this->_properties[$propertyName] = $value;
            $this->_changedProperties[$propertyName] = true;
        }
    }

    /**
     * Fetch data from database.
     *
     * @param int $id
     */
    protected function _populateProperties($id) {

        $this->_row = $this->_model->find($id)->current();

        if (is_null($this->_row)) {
            throw new Zend_Exception("Row with addr_id=$id not found");
        }
    }

    /**
     * Save new address in the database if necessery.
     *
     * @return int Primary key of address row
     */
    abstract public function save();
}

?>
