<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewCounter
 *
 * @author marcin
 */
class My_Model_Table_ViewCounter extends Zend_Db_Table_Abstract {

    protected $_name = "VIEW_COUNTER";
    protected $_rowClass = 'My_Model_Table_Row_ViewCounter';    
    
    protected $_referenceMap = array(
        'Accommodation' => array(
            'columns' => array('acc_id'),
            'refTableClass' => 'My_Model_Table_Accommodation',
            'refColumns' => array('acc_id'),
        )
    );
   
    /**
     * Insert a view.
     *
     * @param array $data counter data
     * @return int primary key value of VIEW_COUNTER row
     */
    public function insertView(array $data) {

        return $this->insert(array(            
            'remote_id' => $data['remote_id'],
            'acc_id' => $data['acc_id']
        ));
    }

    
    
    /**
     * Get all vies for a given acc_id.
     * 
     * @param int $acc_id
     * @return My_Model_Table_Rowset 
     */
    public function findViews($acc_id) {
        return $this->fetchAll('acc_id = ' . $acc_id);
    }

}

?>
