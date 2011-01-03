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
class My_Model_Table_Type extends Zend_Db_Table_Abstract {

    protected $_name = "TYPE";
    protected $_rowClass = 'My_Model_Table_Row_Type';
    protected $_dependentTables = array('My_Model_Table_Accommodation');


    /**
     * Get id of type by given name
     *
     * @param string $name
     * @return Zend_Db_Table_Row
     */
    static function getByName($name) {
        $obj = new self();
        $select = $obj->select()->where('name', $name);

        return $obj->fetchRow($select);
    }


}
?>
