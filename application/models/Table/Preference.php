<?php

/**
 * Model for PREFERENCE table
 *
 * Table ACCOMMODATION_has_PREFERENCE is dependant on this table.
 *
 *
 * @author marcin
 */
class My_Model_Table_Preference extends Zend_Db_Table_Abstract {

    protected $_name = "PREFERENCE";
    protected $_rowClass = 'My_Model_Table_Row_Preference';
    protected $_dependentTables = array('My_Model_Table_AccsPreferences');

    /**
     * Get all preferences.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    public function getPreferences() {
        return $this->fetchAll();
    }

    /**
     * Get all preferences.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    static public function getAllPreferences() {
        $mdl = new self();
        return $mdl->getPreferences();
    }

}

?>
