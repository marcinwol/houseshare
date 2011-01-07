<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SharedHouseshareTest
 *
 * @author marcin
 */
class SharedHouseshareTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_Accommodation';

    public function testGetRoomatesOfSharedAcc() {

        // acc_id = 1 has no roomates info
        $acc = My_Houseshare_Factory::accommodation(1, 'ROOM');
        $this->assertTrue(null === $acc->roomates);

        // cc_id = 2 has roomates info
        $acc = My_Houseshare_Factory::shared(2);

        // get data using model to simplify assertion.
        $sharedMoodel = new My_Model_Table_Shared();
        $expectedRoomatesData = $sharedMoodel->find(2)->current()->getRoomates()->toArray();

        $this->assertEquals(
                $expectedRoomatesData,
                $acc->roomates->toArray()
        );

    }



}

?>
