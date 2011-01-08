<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Type
 *
 * @author marcin
 */
class My_Model_Table_Row_Type extends Zend_Db_Table_Row_Abstract {

     /**
     * Get Accommodations that are of a this type.
     *
     * @return My_Model_Table_Rowset
     */
    public function getAccommodations() {
        return $this->findDependentRowset('My_Model_Table_Accommodation');
    }

}
?>
