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
class My_Houseshare_Address {

    /**
     *
     * @var My_Model_Table_Address 
     */
    protected $_model;

    protected $_propertiesTable = array();
    
    protected $_changedProperties = array();

    protected $_data = array();

    public function __construct($id = null) {
        $this->_model = new My_Model_Table_Address();

        $this->_makePropertiesArray();

        if (!is_null($id)) {
            $this->_getRow($id);
        }
    }

    protected function _makePropertiesArray() {
        $this->_propertiesTable['id'] = array('model' => 'address', 'col' => 'addr_id');
        $this->_propertiesTable['unit_no'] = array('model' => 'address', 'col' => 'unit_no');
        $this->_propertiesTable['street_no'] = array('model' => 'address', 'col' => 'street_no');
        $this->_propertiesTable['street'] = array('model' => 'street', 'col' => 'name');
        $this->_propertiesTable['street_id'] = array('model' => 'street', 'col' => 'street_id');
        $this->_propertiesTable['city_id'] = array('model' => 'city', 'col' => 'city_id');
        $this->_propertiesTable['state_id'] = array('model' => 'state', 'col' => 'state_id');
        $this->_propertiesTable['city'] = array('model' => 'city', 'col' => 'name');
        $this->_propertiesTable['state'] = array('model' => 'state', 'col' => 'name');
        $this->_propertiesTable['zip'] = array('model' => 'zip', 'col' => 'value');
        $this->_propertiesTable['zip_id'] = array('model' => 'zip', 'col' => 'zip_id');
    }

    public function __get($propertyName) {

        if (!array_key_exists($propertyName, $this->_propertiesTable)) {
            throw new Zend_Exception("Invalid property: $propertyName");
        } else {
            $where = $this->_propertiesTable[$propertyName];
            return $this->_data[$where['model']][$where['col']];
        }
    }

    public function __set($propertyName, $value) {
        if (!array_key_exists($propertyName, $this->_propertiesTable)) {
            throw new Zend_Exception("Invalid property: $propertyName");
        } else {
            if (stripos($propertyName, '_id')) {
                throw new Zend_Exception("Cannot change '_id' property : $propertyName");
            }
            $where = $this->_propertiesTable[$propertyName];
            $this->_changedProperties[$propertyName] = true;
            $this->_data[$where['model']][$where['col']] = $value;
        }
    }

    /**
     * Fetch data from database.
     *
     * @param int $id
     */
    protected function _getRow($id) {
        $row = $this->_model->find($id)->current();

        if (is_null($row)) {
            throw new Zend_Exception("Row with addr_id=$id not found");
        }

        $this->_data['address']['addr_id'] = $row->addr_id;
        $this->_data['address']['unit_no'] = $row->unit_no;
        $this->_data['address']['street_no'] = $row->sAddress2treet_no;
        $this->_data['street']['name'] = $row->getStreet()->name;
        $this->_data['street']['street_id'] = $row->getStreet()->street_id;
        $this->_data['city']['name'] = $row->getCity()->name;
        $this->_data['city']['city_id'] = $row->getCity()->city_id;
        $this->_data['state']['name'] = $row->getState()->name;
        $this->_data['zip']['value'] = $row->getZip()->value;
        $this->_data['zip']['zip_id'] = $row->getZip()->zip_id;
    }

    /**
     * Save new address in the database if necessery.
     *
     * @return int Primary key of address row
     */
    public function save() {

        // insert city and state if changed
        if (in_array('state', $this->_changedProperties) ||
                in_array('city', $this->_changedProperties)
        ) {
            $stateModel = new My_Model_Table_State();
            $state_id = $stateModel->insertState(
                            array('state_name' => $this->state)
            );

            $cityModel = new My_Model_Table_City();
            $city_id = $cityModel->insertCity(
                            array(
                                'city_name' => $this->city,
                                'state_id' => $state_id,
                            )
            );
        } else {
            $state_id = $this->_data['state']['state_id'];
            $city_id = $this->_data['city']['state_id'];
        }

        // insert zip if changed
        if (in_array('zip', $this->_changedProperties)) {

            $zipModel = new My_Model_Table_Zip();
            $zip_id = $zipModel->insertZip(
                            array('zip' => $this->zip)
            );
        } else {
            $zip_id = $this->_data['zip']['zip_id'];
        }

        // insert street if changed
        if (in_array('street', $this->_changedProperties)) {

            $stritModel = new My_Model_Table_Street();
            $street_id = $stritModel->insertStreet(
                            array('street_name' => $this->street)
            );
        } else {
            $street_id = $this->_data['street']['street_id'];
        }

        // insert address
        $row_id =  $this->_model->insertAddress(array(
            'unit_no' => $this->unit_no,
            'street_no' => $this->street_no,
            'street_id' => $street_id,
            'zip_id' => $zip_id,
            'city_id' => $city_id
        ));

        $this->_getRow($row_id);

        return $row_id;

    }

}

?>
