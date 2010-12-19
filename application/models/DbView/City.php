<?php

/**
 * This is a view (inner join) of CITY and STATE tables.
 *
 * @author marcin
 */
class My_Model_DbView_City extends Zend_Db_Table_Abstract {
        
    protected $_name = "CITY_VIEW";


    /**
     * Get all cities with associated States.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    public function getCities() {
       return  $this->fetchAll();
    }


}
?>
