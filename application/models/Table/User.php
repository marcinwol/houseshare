<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author marcin
 */
class My_Model_Table_User extends Zend_Db_Table_Abstract {
    
    protected $_name = "USER";

    protected $_rowClass = 'My_Model_Table_Row_User';

    protected $_dependentTables = array(
        'My_Model_Table_Accommodation',
        'My_Model_Table_Roomates'
    );

    /**
     * Update/insert user.
     *
     * @param array $data data of the user
     * @param <type> $id user id
     * @return int  ID of the updated/new user
     */
    public function setUser($data, $id = null) {
        
        $row = $this->find($id)->current();
        
        if (is_null($row)) {
            $row = $this->createRow();            
        }        
        
        $row->email = $data['email'];
        $row->password = $data['password'];
        $row->phone = $data['phone'];
        $row->phone_public = $data['phone_public'];
        $row->first_name = $data['first_name'];
        $row->last_name = $data['last_name'];
        $row->last_name_public = $data['last_name_public'];
        
        return $row->save();
    }


}
?>
