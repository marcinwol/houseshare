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
        ),
        'Street' => array(
            'columns' => array('street_id'),
            'refTableClass' => 'My_Model_Table_Street',
            'refColumns' => array('street_id'),
        ),
        'Zip' => array(
            'columns' => array('zip_id'),
            'refTableClass' => 'My_Model_Table_Zip',
            'refColumns' => array('zip_id'),
        ),
        'Marker' => array(
            'columns' => array('marker_id'),
            'refTableClass' => 'My_Model_Table_Marker',
            'refColumns' => array('marker_id'),
        )
    );


     /**
      * Find Address by all its elements (except addr_id)
      *
      * @param array $data Address data
      * @return Zend_Db_Table_Row_Address | NULL
      */
     public function findByValues(array $data) {

         $select = $this->select();
         $select->where("unit_no = ? ", trim($data['unit_no']) );
         $select->where("street_no = ? ", trim($data['street_no']) );
         $select->where("street_id = ? ", $data['street_id']);
         $select->where("zip_id = ? ", $data['zip_id']);
         $select->where("city_id = ? ", $data['city_id']);
        
         // if marker_id given, then also use it in a search.
         if (isset($data['marker_id'])) {
             $select->where("marker_id = ? ", $data['marker_id']);
         }

         return $this->fetchRow($select);
     }

    /**
      * Insert address if does not exisit.
      *
      * @param array $data address data
      * @return int primary key value of address
      */
     public function insertAddress(array $data) {

         $row = $this->findByValues($data);

         if (is_null($row)) {
             //if null than such address does not exist so create it.
             return $this->insert(array(
                 'unit_no' => $data['unit_no'],
                 'street_no' => $data['street_no'],
                 'street_id' => $data['street_id'],
                 'zip_id' => $data['zip_id'],
                 'city_id' => $data['city_id'],
                 'marker_id' => (isset($data['marker_id']) ? $data['marker_id'] : new Zend_Db_Expr('NULL'))
                 ));
         } else {
             // such address in that exists thus return its  id
             return $row->addr_id;
         }
     }


    /**
     * Update address if possible. It is possible to update address
     * only when there is only one or less rows in the dependant table
     * (i.e. accommodation, agent)
     * 
     * @todo if AGENT model is added than this function must be updated.
     *
     * @param array $data address data
     * @param int $id address id
     * @return int primary key value of address
     */
    public function updateAddress(array $data, $id) {

        // first see if the new address  already exhisits
        $row = $this->findByValues($data);

         if (!is_null($row)) {
            // if exists then return its id
            return $row->addr_id;
        }
        
        

        $row = $this->find($id)->current();

        if (is_null($row)) {
            throw new Zend_Db_Exception("No address with id = $id");
        }
        
      

        if ($row->getAccommodations()->count() > 1) {
            // There are many rows in dependant table, so
            // need to create new row in this one.
            return $this->insertAddress($data);
        }

        $row->unit_no = $data['unit_no'];
        $row->street_no = $data['street_no'];
        $row->street_id = $data['street_id'];
        $row->zip_id = $data['zip_id'];
        $row->city_id = $data['city_id'];
        $row->marker_id = (isset($data['marker_id']) ? $data['marker_id'] : new Zend_Db_Expr('NULL'));
        return $row->save();
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
