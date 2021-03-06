<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RoomateModelTest
 *
 * @author marcin
 */
class RoomateModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_Roomate';

    public function testGetAllRoomates() {
        $rowSet = $this->_model->fetchAll();
        $this->assertEquals(2, count($rowSet));
    }

    public function testGetName() {
        $row = $this->_model->fetchRow('user_id = 1')->getUser();
        $this->assertEquals('Marcin', $row->first_name);

        $row = $this->_model->fetchRow('user_id = 2')->getUser();
        $this->assertEquals('Michal', $row->first_name);
    }

    public function testSetRoomate() {
        $id = $this->_model->setRoomate(array('is_owner' => '0'), 1);
        $this->assertEquals('0', $this->_model->find(1)->current()->is_owner);

        $id = $this->_model->setRoomate(array('is_owner' => '1'), 2);
        $this->assertEquals('1', $this->_model->find(2)->current()->is_owner);
    }

}

?>
