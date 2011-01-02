<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Roomate
 *
 * @author marcin
 */
class My_Model_Table_Roomate extends Zend_Db_Table_Abstract {

      protected $_name = "ROOMATE";

      protected $_rowClass = 'My_Model_Table_Row_Roomate';

       protected $_referenceMap = array(
        'User' => array(
            'columns' => array('user_id'),
            'refTableClass' => 'My_Model_Table_User',
            'refColumns' => array('user_id'),
        )
    );

}
?>
