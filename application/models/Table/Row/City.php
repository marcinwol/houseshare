<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of City
 *
 * @author marcin
 */
class My_Model_Table_Row_City extends Zend_Db_Table_Row_Abstract {

    /**
     * Get State Row for the current city row.
     *
     * @return Zend_Db_Table_Row_State
     */
    public function getState() {
        return $this->findParentRow('My_Model_Table_State');
    }

    /**
     * Get Google map marker coordinates for the current city row if exist.
     * 
     * 
     * @param $makeIfDoesNotExist ask google for marker and create marker if true
     * @return Zend_Db_Table_Row_Marker
     */
    public function getMarker($makeIfDoesNotExist = false) {
        
        $markerRow = $this->findParentRow('My_Model_Table_Marker');

        // if does not exist
        if (is_null($markerRow) && true === $makeIfDoesNotExist) {
            
            $city =  "{$this->name}, {$this->getState()->name}";          
            
            $geocoder = new ZC_GeocodingAdapter();
            $latAndLng = $geocoder->getGeocodedLatitudeAndLongitude($city);
                            

            if (empty($latAndLng)) {
                return null;
            } else {
                $markerModel = new My_Model_Table_Marker();
                                                
                $marker_id = $markerModel->insertMarker((array) $latAndLng);
                
                if (null === $marker_id) {
                    throw new Zend_Db_Exception('Cannot create new marker');
                }
                
                $markerRow = $markerModel->find($marker_id)->current();
                
                // update City with new marker_id
                $this->marker_id = $marker_id;
                
                if ($this->city_id !== $this->save()) {
                     throw new Zend_Db_Exception('Error updating city witn new marker_id');
                }
                
            }
        }
        
        return $markerRow;
    }

    /**
     * Get Addressess in the current city row.
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getAddresses() {
        return $this->findDependentRowset('My_Model_Table_Address');
    }

}

?>
