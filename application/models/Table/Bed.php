<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bed
 *
 * @author marcin
 */
class My_Model_Table_Bed extends Zend_Db_Table_Abstract {

    protected $_name = "BED";

    protected $_dependentTables = array(
        'My_Model_Table_ROOMATES',
        'My_Model_Table_BED_has_FEATURE'
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
