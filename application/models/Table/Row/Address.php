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
class My_Model_Table_Row_Address extends Zend_Db_Table_Row_Abstract {

    /**
     * Get City Row for the current address row.
     *
     * @return Zend_Db_Table_Row
     */
    public function getCityRow() {
        return $this->findParentRow('My_Model_Table_City');
    }

    /**
     * Get State Row for the current address row.
     *
     * @return Zend_Db_Table_Row
     */
    public function getStateRow() {
        return $this->getCityRow()->getStateRow();
    }

}
?>
