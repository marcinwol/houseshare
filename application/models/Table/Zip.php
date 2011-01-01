<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Zip
 *
 * @author marcin
 */
class My_Model_Table_Zip extends Zend_Db_Table_Abstract {

     protected $_name = "ZIP";

     protected $_dependentTables = array(
        'My_Model_Table_Address'
    );


     /**
      * Find Zip by value
      *
      * @param string $value Zip value
      * @return Zend_Db_Table_Rowset_Abstract
      */
     public function findByValue($value) {

         $value = trim($value);

         return $this->fetchAll("value = '$value'");
     }


     /**
      * Insert zip if does not exisit.
      *
      * @param array $data zip data
      * @return int primary key value of zip
      */
     public function insertZip(array $data) {
         
         $rowSet = $this->findByValue($data['zip']);

         if (0 === count($rowSet)) {
             //if 0 than such zip does not exist so create it.
             return $this->insert(array('value'=>$data['zip']));
         } else {
             // such zip exists thus return its id
             return $rowSet->current()->zip_id;
         }

     }


}
?>
