<?php

/**
 * Model for FEATURE table
 *
 * Table ACCOMMODATION_has_FEATURE is dependant on this table.
 *
 * @todo add dependant table ACCOMMODATION_has_FEATURE
 *
 * @author marcin
 */
class My_Model_Table_AccFeature extends Zend_Db_Table_Abstract {


    protected $_name = "FEATURE";
  //  protected $_dependentTables = array('My_Model_Table_??');


    /**
     * Get all features by type
     * 
     * @param int | null $type_id (null means all features)
     * @return Zend_Db_Table_Rowset_Abstract 
     */
    static function getAllByType($type_id = null) {
        $obj = new self();
        $select = $obj->select()->where('type_id', $type_id);

        return $obj->fetchAll($select);
    }

}
?>
