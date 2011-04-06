<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Marker
 *
 * @author marcin
 */
class My_Model_Table_Marker extends Zend_Db_Table_Abstract {

    protected $_name = "MARKER";
    protected $_rowClass = 'My_Model_Table_Row_Marker';    
    
    protected $_dependentTables = array(
        'My_Model_Table_Accommodation',
        'My_Model_Table_City'
        );
   
   

}

?>
