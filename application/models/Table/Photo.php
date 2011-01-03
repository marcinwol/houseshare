<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Photo
 *
 * @author marcin
 */
class My_Model_Table_Photo extends Zend_Db_Table_Abstract {

    protected $_name = "PHOTO";
    protected $_rowClass = 'My_Model_Table_Row_Photo';
    protected $_referenceMap = array(
        'Accommodation' => array(
            'columns' => array('acc_id'),
            'refTableClass' => 'My_Model_Table_Accommodation',
            'refColumns' => array('acc_id'),
        ),
        'Path' => array(
            'columns' => array('path_id'),
            'refTableClass' => 'My_Model_Table_Path',
            'refColumns' => array('path_id'),
        )
    );





}

?>
