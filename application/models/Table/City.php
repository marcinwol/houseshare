<?php

/**
 * Model for a CITY table
 * 
 * A city references STATE and is being referenced by ADDRESS
 * (i.e. ADDRESS depends on CITY).
 *
 * @author marcin
 */
class My_Model_Table_City extends Zend_Db_Table_Abstract {

    protected $_name = "CITY";

    protected $_dependentTables = array('My_Model_Table_Address');
    protected $_rowClass = 'My_Model_Table_Row_City';

    protected $_referenceMap  = array(
        'Menu' => array(
            'columns' => array('state_id'),
            'refTableClass' => 'My_Model_Table_State',
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


    /**
     * Set or update city.
     *
     * @param array $data city info
     * @param int $id city ID
     * @return int The primary key value.
     */
    public function setCity(array $data,  $id = null ) {
        $row = $this->fetchRow("name = '{$data['name']}' OR city_id = '$id'") ;;

        if (is_null($row)) {
            $row = $this->createRow($data);
        } else {
            $row->setFromArray($data);
        }
      
        return $row->save();
    }


    /**
     * Find cities that match a given string
     *
     * @param string    $term  City name or part of the name
     * @param int       $limit Limit of returned rows.
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function findCitiesBasedOnName($term, $limit = 5) {
        $select = $this->select();
        $select->where("name LIKE '%$term%' ")->order('name ASC')->limit($limit);
        return $this->fetchAll($select);
    }

     /**
     * Get all cities.
     *
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode
     */
    static public function getAllCities() {
        $obj = new self();
        return $obj->getCities();
    }

    /**
     * Get all cities from the databse in a form city_id=>name.
     *
     * @return array of cities
     */
    static public function getAllCitiesAsArray() {

        $cities = self::getAllCities()->toArray();

        $citiesOptions = array();

        foreach ($cities as $city) {
            $citiesOptions[$city['city_id']] = $city['name'];
        }

        return $citiesOptions;
    }



}

?>
