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
class My_Model_Table_Address extends Zend_Db_Table_Abstract {

    protected $_name = "ADDRESS";
    
    protected $_dependentTables = array(
        'My_Model_Table_Accommodation'
    );
    
    protected $_referenceMap = array(
        'City' => array(
            'columns' => array('city_id'),
            'refTableClass' => 'My_Model_Table_City',
            'refColumns' => array('city_id'),
        )
    );

}

?>
