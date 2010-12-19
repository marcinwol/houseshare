<?php

/**
 * Model for a CITY table
 * 
 * A city references STATE and is being referenced by ADDRESS
 * (i.e. ADDRESS depends on CITY).
 *
 *
 * @todo Add reference to ADDRFESS
 * @author marcin
 */
class My_Model_DbTable_City extends Zend_Db_Table_Abstract {

    protected $_name = "CITY";

    // protected $_dependentTables = array('My_Model_Address');

    protected $_referenceMap  = array(
        'Menu' => array(
            'columns' => array('state_id'),
            'refTableClass' => 'My_Model_DbTable_State',
            'refColumns' => array('state_id'),
        )
    );


    /**
     * Get all cities. 
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    public function getCities() {
       return  $this->fetchAll();
    }

}

?>