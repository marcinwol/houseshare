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
class My_Model_Table_Row_User extends Zend_Db_Table_Row_Abstract {

    /**
     * Get Accommodations of current user
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getAccommodations() {
        
        $accModel = new My_Model_Table_Accommodation();
        $select = $accModel->select()->order('created DESC');
        
        return $this->findDependentRowset('My_Model_Table_Accommodation', null, $select);
    }
    
    /**
     * Get hashed password for a give user. If not exists than return null.
     * 
     * @return Zend_Db_Table_Row|null  
     */
    public function getPassword() {
        return $this->findDependentRowset('My_Model_Table_Password')->current();
    }


     /**
     * Get Roomate table model for current user if possible
     *
     * @return Zend_Db_Table_Row_Roomate | NULL
     */
    public function getRoomate() {
        $rowset = $this->findDependentRowset('My_Model_Table_Roomate');

        if (count($rowset) > 1) {
            throw new Zend_Db_Table_Rowset_Exception(
                    'More than one roomate table row for currect user'
            );
        }

        return $rowset->current();
    }
    
    /**
     * Get AuthProvider for current user or return NULL in not found
     *
     * @return Zend_Db_Table_Row_AuthProvider|NULL
     */
    public function getAuthProvider() {
        
        $rowset = $this->findDependentRowset('My_Model_Table_AuthProvider');
        
        if (count($rowset) === 0) {
            return null;
        }
        
         if (count($rowset) > 1) {
            throw new Zend_Db_Table_Rowset_Exception(
                    'More than one authenntication provider table row for a currect user'
            );
        }
        
        return $rowset->current();
    }
    
    

}
?>
