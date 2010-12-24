<?php

/**
 * Model for PREFERENCE table
 *
 * Table ACCOMMODATION_has_preference is dependant on this table.
 *
 * @todo add dependant table ACCOMMODATION_has_preference
 *
 * @author marcin
 */
class My_Model_DbTable_Preference extends Zend_Db_Table_Abstract {

    protected $_name = "PREFERENCE";
  //  protected $_dependentTables = array('My_Model_DbTable_??');



     /**
     * Get all preferences.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    public function getPreferences() {
       return  $this->fetchAll();
    }


}
?>
