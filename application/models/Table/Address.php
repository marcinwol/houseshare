<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Address
 *
 * @author marcin
 */
class My_Model_Table_Address extends Zend_Db_Table_Abstract {

    protected $_name = "ADDRESS";

    protected $_rowClass = 'My_Model_Table_Row_Address';
    
    protected $_dependentTables = array(
        'My_Model_Table_Accommodation'
    );
    
    protected $_referenceMap = array(
        'City' => array(
            'columns' => array('city_id'),
            'refTableClass' => 'My_Model_Table_City',
            'refColumns' => array('city_id'),
        )
    );


    /**
     * Create new address
     *
     * @param array $data
     * @return int  The primary key of the row inserted
     */
    public function newAddress(array $data) {
        
        //first save state or get states ID if exists
        $stateModel = new My_Model_Table_State();
        $state_id = $stateModel->setState(array('name'=>$data['state']));

        //second save city for this state or get city ID if exists
        $cityModel = new My_Model_Table_City();
        $city = $cityModel->fetchRow(
                "name = '{$data['city']}' AND state_id = '$state_id'"
                );

        if (is_null($city)) {
            $city_id = $cityModel->insert(array(
                'name'=>$data['city'],
                'state_id'=>$state_id
            ));

        } else {
            $city_id = $city->city_id;
        }

        // do not need this data any more
        unset($data['state']);
        unset($data['city']);

        // add city_id and insert address
        $data['city_id'] = $city_id;
        return $this->insert($data);
    }

    /**
     * Get address row
     * 
     * @param int $id address id
     * @return My_Model_Table_Row_Address | null
     */
    static public function getAddress($id) {
        $model = new self();
        return $model->fetchRow(" addr_id = '$id' ");
    }

}

?>
