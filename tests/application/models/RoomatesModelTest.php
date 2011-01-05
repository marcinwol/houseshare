<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RoomatesModelTest
 *
 * @author marcin
 */
class RoomatesModelTest extends ModelTestCase {

    /**
     * ROOMATES table model
     *
     * @var My_Model_Table_Roomates
     */
    private $_model;

    public function setUp() {
        parent::setUp();
        $this->_model = new My_Model_Table_Roomates();
    }

    public function tearDown() {
        $this->_model = null;
        parent::tearDown();
    }

    public function testGetAll() {
        $rowset = $this->_model->fetchAll();
        $this->assertEquals(count($rowset), 2);
    }

    /**
     * @dataProvider setRoomatesProvider
     */
    public function testSetRoomates($id, $data, $expected_id) {
        $result_id = $this->_model->setRoomates($data, $id);

        $row = $this->_model->find($result_id)->current();

        // add roomates_id to $data to simplfy assertion
        $data['roomates_id'] = $expected_id;

        $this->assertEquals(
                array($expected_id, $data),
                array($result_id  , $row->toArray())
        );
    }

    public function setRoomatesProvider() {
        return array(
            array( // insert new record
                null,
                array('no_roomates' => 2, 'min_age' => 25, 'max_age' => 45, 'gender' => 1),
                3
            ),
            array( // updated existing record
                1,
                array('no_roomates' => 0, 'min_age' => 20, 'max_age' => 35, 'gender' => 0),
                1
            ),
            array( // insert new  record
                5, // no such ID, so make new record
                array('no_roomates' => 0, 'min_age' => 20, 'max_age' => 35, 'gender' => 0),
                3
            )
        );
    }

}

?>
