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
     * Parrent rows array
     *
     * @var array of parrent rows
     */
    protected $_parent;

    public function init() {

        $this->_parent['accommodation'] = $this->findParentRow(
                'My_Model_Table_Accommodation');
        $this->_parent['preference'] = $this->findParentRow(
                'My_Model_Table_Preference');

    }

    /**
     * Parent Preference row.
     *
     * @return  My_Model_Table_Row_Preferences
     */
    public function getPreference() {
        return $this->_parent['preference'];
    }

    /**
     * Get preference name.
     *
     * @return string
     */
    public function getName() {
        return $this->getPreference()->name;
    }

    /**
     * Get preference's binary field value.
     *
     * @return string
     */
    public function getBinary() {
        return $this->getPreference()->binary;
    }

    /**
     * Get preference value.
     *
     * @return string
     */
    public function getValue() {
        return $this->value;
    }



}

?>