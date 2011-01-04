<?php


/**
 * Row for intersection table
 * for MANY-to-MANY relationship between ACCOMMODATION and FEATURE
 *
 * @author marcin
 */
class My_Model_Table_Row_AccsFeatures extends Zend_Db_Table_Row_Abstract {
 /**
     * Parrent rows array
     *
     * @var array of parrent rows
     */
    protected $_parent;

    public function init() {

        $this->_parent['accommodation'] = $this->findParentRow(
                'My_Model_Table_Accommodation');
        $this->_parent['feature'] = $this->findParentRow(
                'My_Model_Table_Feature');
    }


    /**
     * Parent Feature row.
     *
     * @return  My_Model_Table_Row_Feature
     */
    public function getFeature() {
        return $this->_parent['feature'];
    }

    /**
     * Feature name.
     *
     * @return string
     */
    public function getName() {
        return $this->getFeature()->name;
    }
    
    /**
     * Get feature value.
     *
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

}

?>
