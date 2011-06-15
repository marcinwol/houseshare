<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Marker
 *
 * @author marcin
 */
class My_Model_Table_Marker extends Zend_Db_Table_Abstract {

    protected $_name = "MARKER";
    protected $_rowClass = 'My_Model_Table_Row_Marker';    
    
    protected $_dependentTables = array(
        'My_Model_Table_Address',
        'My_Model_Table_City'
        );
   
     /**
     * Find marker by its lat and lng values
     *
     * @param float $lat 
     * @param float $lng 
     * @return Zend_Db_Table_Row_Marker|null
     */
    public function findByValue($lat, $lng) {  
        $select = $this->select()->where("lat = ?", (float) $lat)->where('lng = ?', (float) $lng);
     
        return $this->fetchRow($select);
    }
    
    
     /**
     * Insert marker if does not exisit.
     *
     * @param array $data marker lat and lng
     * @return int primary key value of marker
     */
    public function insertMarker(array $data) {

        // first see if the new marker  already exisits
        $row = $this->findByValue($data['lat'], $data['lng']);
        
        if (is_null($row)) {
            //if null than such city in this state does not exist so create it.
            return $this->insert(array(
                'lat' => $data['lat'],
                'lng' => $data['lng']
            ));
        } else {
            // such marker in that state exists thus return its marker's id
            return $row->marker_id;
        }
    }
    
    
    
     /**
     * Update marker if possible. It is possible to update marker
     * only when there is only one or less rows in the dependant tables
     * (i.e. ADDRESS and CITY)
     *
     * @param array $data marker data
     * @param int $marker_id marker id
     * @return int primary key value of marker
     */
    public function updateMarker(array $data, $marker_id) {

        // first see if the new marker already exisits
        $row = $this->findByValue($data['lat'], $data['lng']);

        if (!is_null($row)) {
            // if exists than return its id
            return $row->marker_id;
        }

        $row = $this->find($marker_id)->current();

        if (is_null($row)) {
            throw new Zend_Db_Exception("No marker with id = $marker_id");
        }

        if ($row->getAddresses()->count() > 1 || $row->getCities()->count() > 1) {
            // There are many rows in dependant tables, so
            // need to create new row in this one.
            return $this->insertMarker($data);
        }
        
        // only one dependant row so update marker
        $row->lat = $data['lat'];
        $row->lng = $data['lng'];        
        return $row->save();
    }

    
    
    
}

?>
