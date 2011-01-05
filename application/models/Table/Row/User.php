<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author marcin
 */
class My_Model_Table_Row_User extends Zend_Db_Table_Row_Abstract {

    /**
     * Get Accommodations of current user
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getAccommodations() {
        return $this->findDependentRowset('My_Model_Table_Accommodation');
    }


     /**
     * Get Roomate table model for current user if possible
     *
     * @return Zend_Db_Table_Row_Roomate | NULL
     */
    public function getRoomate() {
        $rowset = $this->findDependentRowset('My_Model_Table_Roomate');

        if (count($rowset) > 1) {
            throw new Zend_Db_Table_Rowset_Exception(
                    'More than one roomate table row for currect user'
            );
        }

        return $rowset->current();

    }

}
?>
