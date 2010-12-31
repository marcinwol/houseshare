<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accommodation
 *
 * @author marcin
 */
class My_Model_Table_Accommodation extends Zend_Db_Table_Abstract {

    protected $_name = "ACCOMMODATION";

    protected $_dependentTables = array(
        'My_Model_Table_Bed',
        'My_Model_Table_Room',
        'My_Model_Table_Photo',
        'My_Model_Table_ACCOMMODATION_has_PREFERENCE',
        'My_Model_Table_ACCOMMODATION_has_FEATURE',
    );

    protected $_referenceMap = array(
        'Address' => array(
            'columns' => array('addr_id'),
            'refTableClass' => 'My_Model_Table_Address',
            'refColumns' => array('addr_id'),
        ),
        'User' => array(
            'columns' => array('user_id'),
            'refTableClass' => 'My_Model_Table_User',
            'refColumns' => array('user_id'),
        )
    );

}

?>
