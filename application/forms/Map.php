<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Map
 *
 * @author marcin
 */
class My_Form_Map extends Zend_Form {

    public function init() {

        $this->setAttrib('id', 'address');

        $street_no = $this->createElement('hidden', 'street_no');
        $street_no->removeDecorator('Label');

        $street_name = $this->createElement('hidden', 'street_name');
        $street_name->removeDecorator('Label');

        $zip = $this->createElement('hidden', 'zip');
        $zip->removeDecorator('Label');

        $city = $this->createElement('hidden', 'city');
        $city->removeDecorator('Label');

        $state = $this->createElement('hidden', 'state');
        $state->removeDecorator('Label');


        $address = $this->createElement('hidden', 'address_for_geocoder');
        $address->removeDecorator('Label');


        $lat = $this->createElement('hidden', 'addr_lat');
        $lat->removeDecorator('Label');

        $lng = $this->createElement('hidden', 'addr_lng');
        $lng->removeDecorator('Label');
        
        
        $cityLat = $this->createElement('hidden', 'city_lat');
        $cityLat->removeDecorator('Label');

        $cityLng = $this->createElement('hidden', 'city_lng');
        $cityLng->removeDecorator('Label');

        $submit = $this->createElement('submit', 'Submit', array('label' => 'Go to step 3'));

        $this->addElements(
                array(
                    $street_no, $street_name, $zip, $city, $state, $address,
                    $lat, $lng, $cityLat, $cityLng, $submit
                )
        );
    }

    public function populateFromAcc(My_Houseshare_Accommodation $acc) {
        
        $address = "{$acc->address->street} {$acc->address->street_no}, {$acc->address->city} {$acc->address->zip}";
        
        /*@var $cityMarker Zend_Db_Table_Row_Marker */
        $cityMarker = $acc->cityrow->getMarker(true);
        
        $city_lat = $city_lng = '';        
        
        if ($cityMarker instanceof My_Model_Table_Row_Marker) {             
            $city_lat = (string) $cityMarker->lat;
            $city_lng = (string) $cityMarker->lng;
        }
            
        $this->populate(
                array(
                    'street_no' => $acc->address->street_no,
                    'street_name' => $acc->address->street,
                    'zip' => $acc->address->zip,
                    'city' => $acc->address->city,
                    'state' => $acc->address->state,
                    'address_for_geocoder' => $address,
                    'addr_lat' => $acc->address->lat,
                    'addr_lng' => $acc->address->lng,
                    'city_lat' => $city_lat,
                    'city_lng' => $city_lng,
             )
        );
    }

}

?>
