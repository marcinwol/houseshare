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
    
    protected $_isView = false;

    protected $_id = null;

    protected $_modelName;
    protected $_properties = array();
    protected $_changedProperties = array();



    public function __construct($id = null) {

        $modelObj = "My_Model_{$this->_modelName}";
        $this->_model = new $modelObj();

        $this->checkIfView();

        $this->_makeProperties();

        if (!is_null($id)) {
            $this->_id = $id;
            $this->_populateProperties($id);
        }

         
    }

    /**
     * Check if a model is for view rather than for table.
     *
     * @return boolean true if view
     */
    protected function checkIfView() {
        if (false !== strpos($this->_modelName, 'View_')) {
            return $this->_isView = true;
        } else {
            return false;
        }
    }

    /**
     * Get model for the table.
     *
     * @return Zend_Db_Table
     */
    protected function getModel() {
        $modelName = 'My_Model_Table_' . str_replace('View_', '', $this->_modelName);
        return new $modelName();

    }

    /**
     * Make _properties table using model's info('cols') method.
     */
    protected function _makeProperties() {
        $this->_cleanProperties();
        foreach ($this->_model->info('cols') as $prop) {
            $this->_properties[$prop] = null;
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
            throw new Zend_Db_Exception("Row with id=$id was not found");
        }

        foreach ($this->_properties as $prop => $val) {
            $this->_properties[$prop] = $this->_row->$prop;
        }
        
        $this->_cleanChangedProperties();
    }

    protected function _cleanProperties() {
        $this->_properties = array();
    }

    protected function _cleanChangedProperties() {
        $this->_changedProperties = array();
    }


    /**
     * Get Properties
     *
     * @return array
     */
    public function getProperties() {
        return $this->_properties;
    }

    public function toArray() {
        return (array) $this->getProperties();
    }


    /**
     * Save new address in the database if necessery.
     *
     * @return int Primary key of address row
     */
    abstract public function save();
}

?>
