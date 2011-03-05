<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Db model for PASSWORD table.
 *
 * @author marcin
 */
class My_Model_Table_Password extends Zend_Db_Table_Abstract {

    protected $_name = "PASSWORD";
    protected $_rowClass = 'My_Model_Table_Row_Password';
    protected $_referenceMap = array(
        'User' => array(
            'columns' => array('user_id'),
            'refTableClass' => 'My_Model_Table_User',
            'refColumns' => array('user_id'),
        )
    );

}

?>
