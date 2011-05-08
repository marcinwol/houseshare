<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accommodation row
 *
 * @author marcin
 */
class My_Model_Table_Row_Accommodation extends Zend_Db_Table_Row_Abstract {

    public function init() {
        
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
     * Get views for the current accommodation.
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getViews() {
        return $this->findDependentRowset('My_Model_Table_ViewCounter');
    }

    /**
     * Get views count for the current accommodation.
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getViewsCount() {
        return count($this->getViews());
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
     * @return Zend_Db_Table_Rowset_AccsFeatures
     */
    public function getFeatures() {
        return $this->findDependentRowset('My_Model_Table_AccsFeatures');
    }

    /**
     * Deletes all features for this accommodation
     * @return int The number of rows deleted.
     */
    public function deteleFeatures() {
        $rowset = $this->getFeatures();
        $noOfRowsDeleted = 0;
        foreach ($rowset as $row) {
            $noOfRowsDeleted += $row->delete();
        }
        return $noOfRowsDeleted;
    }

    /**
     * Get preferences for this accommodations.
     *
     * @return Zend_Db_Table_Rowset_AccsPreferences
     */
    public function getPreferences() {
        return $this->findDependentRowset('My_Model_Table_AccsPreferences');
    }

    /**
     * Deletes all preferences for this accommodation
     * @return int The number of rows deleted.
     */
    public function detelePreferences() {
        $rowset = $this->getPreferences();
        $noOfRowsDeleted = 0;
        foreach ($rowset as $row) {
            $noOfRowsDeleted += $row->delete();
        }
        return $noOfRowsDeleted;
    }

    /**
     * Get shared table row, if possiple, for a given accommodations.
     *
     * @return Zend_Db_Table_Row_Shared | NULL Null if no shared rows exist
     */
    public function getShared() {

        $rowset = $this->findDependentRowset('My_Model_Table_Shared');

        if (count($rowset) > 1) {
            throw new Zend_Db_Table_Rowset_Exception(
                    'More than one shared table row for currect accommodation'
            );
        }

        return $rowset->current();
    }

    public function __wakeup() {
        $this->setTable(new My_Model_Table_Accommodation());
    }

}

?>
