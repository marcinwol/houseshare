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
     * Save new address in the database if necessery or update
     * exhisting address if possible. 
     *
     * @return int Primary key of inserted/updated row
     */
    public function save() {

        // insert/update state
        if (in_array('state', $this->_changedProperties)) {
            $stateModel = new My_Model_Table_State();

            $state_id = $stateModel->insertState(
                            array('state_name' => $this->state)
            );
        } else {
            $state_id = $this->_properties['state_id'];
        }


        // insert/update city
        if (in_array('city', $this->_changedProperties)) {
            $cityModel = new My_Model_Table_City();

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
        if (in_array('zip', $this->_changedProperties)) {
            $zipModel = new My_Model_Table_Zip();
            $zip_id = $zipModel->insertZip(array('zip' => $this->zip));
        } else {
            $zip_id = $this->_properties['zip_id'];
        }

        // insert/update street
        if (in_array('street', $this->_changedProperties)) {
            $streetModel = new My_Model_Table_Street();

            $street_id = $streetModel->insertStreet(
                            array('street_name' => $this->street)
            );
        } else {
            $street_id = $this->_properties['street_id'];
        }


        $row_id = $this->getModel()->insertAddress(
                        array(
                            'unit_no' => $this->unit_no,
                            'street_no' => $this->street_no,
                            'street_id' => $street_id,
                            'zip_id' => $zip_id,
                            'city_id' => $city_id
                        )
        );


        $this->_populateProperties($row_id);

        return $row_id;
    }

}

?>