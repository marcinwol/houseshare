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
        'My_Model_Table_Roomates',
        'My_Model_Table_Password',
        'My_Model_Table_AuthProvider',
    );

    public function findByEmail($email) {
        return $this->fetchRow("email = '$email'");
    }
    
    /**
     * Update/insert user.
     *
     * @param array $data data of the user
     * @param <type> $id user id
     * @return int  ID of the updated/new users
     */
    public function setUser($data, $id = null) {

        $row = $this->find($id)->current();

        if (is_null($row)) {
            // before creating check if there is no such email in database.

            if (!is_null($this->findByEmail($data['email']))) {
                throw new Zend_Db_Exception(
                        "Email {$data['email']} already exists."
                );
            }

            $row = $this->createRow();
        }

        $row->email = $data['email'];       
        $row->phone = $data['phone'];
        $row->phone_public = $data['phone_public'];
        $row->first_name = $data['first_name'];
        $row->last_name = $data['last_name'];
        $row->last_name_public = $data['last_name_public'];
        $row->description = $data['description'];
        $row->type = $data['type'];

        return $row->save();
    }
    
     /**
     * Find user by email
     *
     * @param string $email email
     * @return Zend_Db_Table_Row
     */
    static public function fetchUsingEmail($email) {
        $obj = new self();
        return $obj->findByEmail($email);
    }
    

}

?>
