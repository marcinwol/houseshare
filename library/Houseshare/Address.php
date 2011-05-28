<?php

/**
 *
 * Class for working with address.
 *
 * @example
 * $address = new My_Houseshare_Address();
 * $address->unit_no = "12";
 * $address->street_no = '13A';
 * $address->street = "Nowa ulica";
 * $address->city = "Nowe miasto";
 * $address->zip = "34-455";
 * $address->state = "Mazowieckie"; 
 * $address->save();
 *
 *
 * @author marcin
 */
class My_Houseshare_Address extends My_Houseshare_Abstract_PropertyAccessor {

    protected $_modelName = 'View_Address';
    
    /**
     * Get address row
     * 
     *
     * @return type My_Model_Table_Row_Address
     */
    public function getRow() {
        $addressId = $this->_properties['id'];
        $model = new My_Model_Table_Address();
        return $model->find($addressId)->current();
    }
    
    
    /**
     * Save new address in the database if necessery or update
     * exhisting address if possible. 
     * 
     * @param boolean $update if true then updateAddress is performed instead of insertAddress
     *
     * @return int Primary key of inserted/updated row
     */
    public function save($update = false) {

        // insert/update state
        if (array_key_exists('state', $this->_changedProperties)) {
            $stateModel = new My_Model_Table_State();

            $state_id = $stateModel->insertState(
                            array('state_name' => $this->state)
            );
        } else {
            $state_id = $this->_properties['state_id'];
        }

        

        // insert/update city
        if (array_key_exists('city', $this->_changedProperties)) {
                      
            $cityModel = new My_Model_Table_City();
            
             if (is_null($state_id)) {
                $state_id = $cityModel->findByName($this->city)->state_id;                
            }

            $city_id = $cityModel->insertCity(
                            array(
                                'city_name' => $this->city,
                                'state_id' => $state_id,
                            )
            );
        } else {
            $city_id = $this->_properties['city_id'];
        }


        // insert/update zip
        if (array_key_exists('zip', $this->_changedProperties)) {
            $zipModel = new My_Model_Table_Zip();
            $zip_id = $zipModel->insertZip(array('zip' => $this->zip));
        } else {
            $zip_id = $this->_properties['zip_id'];
        }       

        // insert/update street
        if (array_key_exists('street', $this->_changedProperties)) {
            $streetModel = new My_Model_Table_Street();

            $street_id = $streetModel->insertStreet(
                            array('street_name' => $this->street)
            );
        } else {
            $street_id = $this->_properties['street_id'];
        }

        // insert/update google map marker localization
        if (array_key_exists('lng', $this->_changedProperties) || array_key_exists('lat', $this->_changedProperties)) {
            if (empty($this->_properties['lat']) || empty($this->_properties['lng'])) {
                $marker_id = null;
            } else {
                $markerModel = new My_Model_Table_Marker();
                $marker_id = $markerModel->insertMarker(array('lat' => $this->lat, 'lng' => $this->lng));
            }
        } else {
            $marker_id = $this->_properties['marker_id'];
        }



        $addrData = array(
            'unit_no' => $this->unit_no,
            'street_no' => $this->street_no,
            'street_id' => $street_id,
            'zip_id' => $zip_id,
            'city_id' => $city_id,
            'marker_id' => $marker_id
        );

        if (true === $update) {
            $row_id = $this->getModel()->updateAddress($addrData, $this->id);
        } else {
            $row_id = $this->getModel()->insertAddress($addrData);
        }
        
  
        $this->_populateProperties($row_id);
        

        return $row_id;
    }

}

?>
