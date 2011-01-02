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
    protected $_referenceMap = array(
        'State' => array(
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
        return $this->fetchAll();
    }

    /**
     * Find City by its name and state
     *
     * @param string $name City name
     * @param int $state_id Id of a state in which the city is
     * @return Zend_Db_Table_Row_City | NULL
     */
    public function findByNameAndState($name, $state_id) {

        $name = trim($name);

        return $this->fetchRow("name = '$name' AND state_id = $state_id");
    }

    /**
     * Insert city if does not exisit.
     *
     * @param array $data city data
     * @return int primary key value of city
     */
    public function insertCity(array $data) {

        $row = $this->findByNameAndState(
                        $data['city_name'],
                        $data['state_id']
        );

        if (is_null($row)) {
            //if null than such city in this state does not exist so create it.
            return $this->insert(array(
                'name' => $data['city_name'],
                'state_id' => $data['state_id']
            ));
        } else {
            // such city in that state exists thus return its city's id
            return $row->city_id;
        }
    }

    /**
     * Update city if possible. It is possible to update city
     * only when there is only one or less rows in the dependant table
     * (i.e. address)
     *
     * @param array $data city data
     * @param int $id city id
     * @return int primary key value of city
     */
    public function updateCity(array $data, $id) {

        // first see if the new city  already exhisits
        $row = $this->findByNameAndState(
                        $data['city_name'],
                        $data['state_id']
        );

        if (!is_null($row)) {
            // if exists than return its id
            return $row->city_id;
        }

        $row = $this->find($id)->current();

        if (is_null($row)) {
            throw new Zend_Db_Exception("No city with id = $id");
        }

        if ($row->getAddresses()->count() > 1) {
            // There are many rows in dependant table, so
            // need to create new row in this one.
            return $this->insertCity($data);
        }

        $row->name = $data['city_name'];
        $row->state_id = $data['state_id'];
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
