<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthProvider
 *
 * @author marcin
 */
class My_Model_Table_ResetPassword extends Zend_Db_Table_Abstract {

    protected $_name = "RESET_PASSWORD";
    protected $_rowClass = 'My_Model_Table_Row_ResetPassword';
    protected $_referenceMap = array(
        'User' => array(
            'columns' => array('user_id'),
            'refTableClass' => 'My_Model_Table_User',
            'refColumns' => array('user_id'),
        )
    );
   

    /**
     * Find row by unique ID
     *
     * @param string $value unique id value
     * @return My_Model_Table_Row_ResetPassword|null
     */
    public function findByUniqueID($value) {

        $value = trim($value);
        $select = $this->select()->where("uid = ?", $value);
        
        return $this->fetchRow($select);
    }

    /**
     * Find row by unique ID
     *
     * @param string $uid uid value
     * @return My_Model_Table_Row_ResetPassword|null
     */
    static public function fetchUsingUID($uid) {
        $obj = new self();
        return $obj->findByUniqueID($uid);
    }
    
    /**
     * Create new row for resetting password for a 
     * given user id
     * 
     * @param int $user_id 
     * @param string $seed some seed
     * @return string generated unique id
     */
    static public function newRow($user_id, $seed = "random_string") {
        
        //create unique $uid
        $uid = md5(uniqid($seed, true));
        
        $obj = new self();
        
        // make sure that there is no duplicate in database
        while (!is_null($obj->findByUniqueID($uid))) {
            $uid = md5(uniqid($seed, true));
        }
        
        $row = $obj->createRow();
        $row->uid = $uid;
        $row->user_id = $user_id;        
        
        if (!is_numeric($row->save())) {
            throw new Zend_Db_Statement_Exception(
                    'Cannot create new \'reset password\' row'
            );
        }
        
        return $uid;
    }

}

?>
