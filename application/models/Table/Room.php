<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Room
 *
 * @author marcin
 */
class My_Model_Table_Room extends Zend_Db_Table_Abstract {

    protected $_name = "ROOM";

    protected $_dependentTables = array(
        'My_Model_Table_ROOMATES',
        'My_Model_Table_ROOM_has_FEATURE'
    );

    protected $_referenceMap = array(
        'Accommodation' => array(
            'columns' => array('acc_id'),
            'refTableClass' => 'My_Model_Table_Accommodation',
            'refColumns' => array('acc_id')
        )
    );

}
?>
