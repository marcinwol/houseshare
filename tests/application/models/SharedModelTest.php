<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SharedModelTest
 *
 * @author marcin
 */
class SharedModelTest extends ModelTestCase {

    /**
     * SHARED table model
     *
     * @var My_Model_Table_Shared
     */
    private $_model;

    public function setUp() {
        parent::setUp();
        $this->_model = new My_Model_Table_Shared();
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
     * @dataProvider setSharedProvider
     */
    public function testSetShared($id, $data) {
        $result_id = $this->_model->setShared($data, $id);

        $row = $this->_model->find($result_id)->current();

        // add acc_id to $data to simplfy assertion
        $data['acc_id'] = $result_id;

        // shared row must have the same acc_id as parent accommodation table.
        $expected_id = $id;

        $this->assertEquals(
                array($expected_id, $data),
                array($result_id, $row->toArray())
        );
    }

    public function setSharedProvider() {
        return array(
            array(1 /* acc_id */, array('roomates_id' => 2)),
            array(2 /* acc_id */, array('roomates_id' => null)),
            array(3 /* acc_id */, array('roomates_id' => 3)),
        );
    }

    /**
     * Test if referential integrity will not allow to insert shared row
     * if acc_id and roomates_id don't exist.
     *     
     * @dataProvider setSharedExceptionProvider
     */
    public function testSetSharedException($id, $data) {

        try {
            $result_id = $this->_model->setShared($data, $id);
        } catch (Zend_Exception $e) {
            // SQLSTATE[23000]: Integrity constraint violation
            $this->assertTrue(23000 === $e->getCode());
        }
    }

    public function setSharedExceptionProvider() {
        return array(
            array(1 /* acc_id */, array('roomates_id' => 5)),
            array(6 /* acc_id */, array('roomates_id' => null)),
            array(6 /* acc_id */, array('roomates_id' => 6)),
        );
    }

    public function testGetAccommodationFromShared() {

        $acc_ids = array(1, 2, 3);

        foreach ($acc_ids as $acc_id) {
            $sharedAccRow = $this->_model->find($acc_id)->current();

            if (3 === $acc_id) {
                // no shared table row for acc_id = 3
                $this->assertTrue(is_null($sharedAccRow));
                continue;
            }
            $accRow = $sharedAccRow->getAccommodation();
            $this->assertTrue($accRow instanceof My_Model_Table_Row_Accommodation);
        }
    }

    public function testGetRoomatesFromShared() {

        $acc_ids = array(1, 2, 3);

        foreach ($acc_ids as $acc_id) {
            $sharedAccRow = $this->_model->find($acc_id)->current();

            if (3 === $acc_id) {
                // no shared table row for acc_id = 3
                $this->assertTrue(is_null($sharedAccRow));
                continue;
            }

            $roomatesRow = $sharedAccRow->getRoomates();

            if (1 === $acc_id) {
                // no roomates table row for acc_id = 2
                $this->assertTrue(is_null($roomatesRow));
                continue;
            }

            // roomates table row exists only for acc_id = 1

            $this->assertTrue($roomatesRow instanceof My_Model_Table_Row_Roomates);
        }
    }

}

?>
