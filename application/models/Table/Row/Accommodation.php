<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accommodation
 *
 * @author marcin
 */
class My_Model_Table_Row_Accommodation extends Zend_Db_Table_Row_Abstract {

    /**
     *
     * @var My_Model_Table_Rowset
     */
    protected $_preferencesRowset;

    public function init() {

        $this->_preferencesRowset = $this->findDependentRowset(
                        'My_Model_Table_AccsPreferences'
        );
    }

    public function __get($columnName) {
        if ('preferences' === $columnName) {
            return $this->_preferencesRowset;
        }

        return parent::__get($columnName);
    }

    public function save() {

        foreach ($this->_preferencesRowset as $preference) {
            $preference->save();
        }

        return parent::save();
    }

    /**
     * Get Address Row for the current accommodation row.
     *
     * @return Zend_Db_Table_Row_Address
     */
    public function getAddress() {
        return $this->findParentRow('My_Model_Table_Address');
    }

    /**
     * Get user Row for the current accommodation row.
     *
     * @return Zend_Db_Table_Row_User
     */
    public function getUser() {
        return $this->findParentRow('My_Model_Table_User');
    }

    /**
     * Get type Row for the current accommodation row.
     *
     * @return Zend_Db_Table_Row_Type
     */
    public function getType() {
        return $this->findParentRow('My_Model_Table_Type');
    }

    /**
     * Get Photos for the current accommodation.
     *
     * @return Zend_Db_Table_Rowset_Photo
     */
    public function getPhotos() {
        return $this->findDependentRowset('My_Model_Table_Photo');
    }

    /**
     * Get fullPaths for this Photo rowset.
     *
     * @return array Array of photo full paths
     */
    public function getPhotoPaths() {
        return $this->getPhotos()->getFullPaths();
    }

    /**
     * Get features of a given accommodations.
     * 
     * @return Zend_Db_Table_Rowset_Abstract 
     */
    public function getFeatures() {
        return $this->findManyToManyRowset(
                'My_Model_Table_Feature',
                'My_Model_Table_AccsFeatures');
    }

    /**
     * Get preferences of a given accommodations.
     *
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getPreferences() {
        return $this->findManyToManyRowset(
                'My_Model_Table_Preference',
                'My_Model_Table_AccsPreferences');
    }

}

?>
