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
class RoomateModelTest extends ModelTestCase  {

    /**
     * ROOMATE table model
     *
     * @var My_Model_Table_Roomate
     */
    private $_model;

    public function setUp() {
        parent::setUp();
        $this->_model = new My_Model_Table_Roomate();
    }

    public function tearDown() {
        $this->_model = null;
        parent::tearDown();
    }

    public function testGetAllRoomates() {
        $rowSet = $this->_model->fetchAll();
        $this->assertEquals(2,count($rowSet));
    }

    public function testGetName() {
        $row = $this->_model->fetchRow('user_id = 1')->getUser();
        $this->assertEquals('Marcin',$row->first_name);

        $row = $this->_model->fetchRow('user_id = 2')->getUser();
        $this->assertEquals('Michal',$row->first_name);
    }

}
?>
