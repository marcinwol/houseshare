<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResetPasswordModelTest
 *
 * @author marcin
 */
class ResetPasswordModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_ResetPassword';


    public function testGetAll() {
        $rowset = $this->_model->fetchAll();
        $this->assertEquals(count($rowset), 3);
    }
    
    public function testFindByKey() {
        //find correct id
        $row = $this->_model->findByUniqueID('ad0234829205b9033196ba818f7a872b');
        $this->assertEquals(2, $row->reset_p_id);
        
        //check if we can get correct user row.
        $this->assertEquals(3, $row->getUser()->user_id);
        
        //find INcorrect id
        $row = $this->_model->findByUniqueID('ad0234829205b9033196ba818f7a873b');
        $this->assertEquals(null, $row);     
        
        //uid exist but is expired. return null;
        $row = $this->_model->findByUniqueID('wd0234829205b9033196na818f7a872b');
        $this->assertEquals(null, $row);     
        
    }
    
    public function testNewRow() {
        //reset password of this user
        $user_id = 2;
        
        $uid = My_Model_Table_ResetPassword::newRow($user_id);               
        
        //check if new row was created
        $row = My_Model_Table_ResetPassword::fetchUsingUID($uid);
     
        $this->assertEquals($uid, $row->uid);              
    }


}
?>
