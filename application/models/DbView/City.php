<?php

/**
 * This is a view (inner join) of CITY and STATE tables.
 *
 * @author marcin
 */
class My_Model_DbView_City extends Zend_Db_Table_Abstract {
        
    protected $_name = "VIEW_CITY";
    protected $_primary = array('city_id','state_id');


    /**
     * Get all cities with associated States.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    public function getCities() {
       return  $this->fetchAll();
    }


     /**
     * Find cities along with states that match a given string
     *
     * @param string    $term  City name or part of the name
     * @param int       $limit Limit of returned rows.
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function findCitiesBasedOnName($term, $limit = 5) {
        $select = $this->select();
        $select->where("city_name LIKE '%$term%' ")->order('city_name DESC')->limit($limit);
        return $this->fetchAll($select);
    }


}
?>
