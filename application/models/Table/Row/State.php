<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of State
 *
 * @author marcin
 */
class My_Model_Table_Row_State extends Zend_Db_Table_Row_Abstract {

    /**
     * Get Cities in the current state.
     *
     * @return Zend_Db_Table_RowSet
     */
    public function getCities() {
        return $this->findDependentRowset('My_Model_Table_City');
    }

}
?>
