<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userModelTest
 *
 * @author marcin
 */
class UserModelTest extends ModelTestCase  {

    /**
     * USEr table model
     *
     * @var My_Model_Table_User
     */
    private $_model;

    public function setUp() {
        parent::setUp();
        $this->_model = new My_Model_Table_User();
    }

    public function tearDown() {
        $this->_model = null;
        parent::tearDown();
    }

    public function testFoo() {
        $this->assertTrue(true);
    }


}
?>
