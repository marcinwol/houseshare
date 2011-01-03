<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Path
 *
 * @author marcin
 */
class My_Model_Table_Row_Path extends Zend_Db_Table_Row_Abstract {


    /**
     * Get Photos in this path.
     *
     * @return My_Model_Table_RowSet
     */
    public function getPhotos() {
        return $this->findDependentRowset('My_Model_Table_Photo');
    }
}
?>
