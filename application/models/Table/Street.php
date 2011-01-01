<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * A model for a STREET table.
 * ADDRESS table is dependant of STREET
 *
 * @author marcin
 */
class My_Model_Table_Street extends Zend_Db_Table_Abstract {

   
    protected $_name = "STREET";
    
    protected $_dependentTables = array('My_Model_Table_Address');



     /**
      * Find Street by name
      *
      * @param string $value Street value
      * @return Zend_Db_Table_Rowset_Abstract
      */
     public function findByValue($value) {

         $value = trim($value);

         return $this->fetchAll("name = '$value'");
     }



   /**
      * Insert street if does not exisit.
      *
      * @param array $data street data
      * @return int primary key value of street
      */
     public function insertStreet(array $data) {

         $rowSet = $this->findByValue($data['street_name']);

         if (0 === count($rowSet)) {
             //if 0 than such zip does not exist so create it.
             return $this->insert(array('name'=>$data['street_name']));
         } else {
             // such zip exists thus return its id
             return $rowSet->current()->street_id;
         }

     }


     /**
     * Find street  that match a given string
     *
     * @param string    $term  street name or part of the name
     * @param int       $limit Limit of returned rows.
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function findBasedOnName($term, $limit = 5) {
        $select = $this->select();
        $select->where("name LIKE '%$term%' ")->order('name ASC')->limit($limit);
        return $this->fetchAll($select);
    }



  

}

?>
