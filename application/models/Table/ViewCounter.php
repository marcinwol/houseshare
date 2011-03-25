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

    protected $_name = "VIEWS_COUNTER";
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
     * @return int|null primary key value of VIEW_COUNTER row or null.
     */
    public function insertView(array $data, $allowDuplicateIPs = true) {

        $ip = new Zend_Db_Expr("INET_ATON('".$data['remote_ip']."')");
        $acc_id = $data['acc_id'];
        
        $select = $this->select()->where('remote_ip = ? ', $ip)
                                 ->where('acc_id = ?', $acc_id);
        
        $result = $this->fetchAll($select);
       
        if (false === $allowDuplicateIPs && count($result) > 0 ) {
            return null;
        }     
  
        return $this->insert(array(            
            'remote_ip' => $ip,
            'acc_id' => $acc_id
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
