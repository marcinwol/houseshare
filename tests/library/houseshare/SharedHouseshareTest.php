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

    protected $_modelName = 'My_Model_Table_Shared';

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

    public function testInsertSharedAccommodation1() {

        $newAcc = My_Houseshare_Factory::shared();

        $newAcc->title = "New Acc title";
        $newAcc->description = "New description";
        $newAcc->setAddrId(2);
        $newAcc->setUserId(1);
        $newAcc->date_avaliable = "2011-01-04";
        $newAcc->price = 300;
        $newAcc->bond = 1200;
        $newAcc->street_address_public = 1;
        $newAcc->short_term_ok = 0;
        $newAcc->setTypeId(1);

        $acc_id = $newAcc->save();

        $expectedAcc_id = 4;

        $sharedRow = $this->_model->find($acc_id)->current();

        $this->assertEquals(
                array(
                    $expectedAcc_id,
                    'New acc title',
                    $sharedRow->roomates_id
                ),
                array(
                    $acc_id,
                    $sharedRow->getAccommodation()->title,
                    null
                )
        );
    }

    public function testInsertSharedAccommodation2() {

        $newAcc = My_Houseshare_Factory::shared();

        $newAcc->title = "New Acc title";
        $newAcc->description = "New description";
        $newAcc->setAddrId(2);
        $newAcc->setUserId(1);
        $newAcc->date_avaliable = "2011-01-04";
        $newAcc->price = 300;
        $newAcc->bond = 1200;
        $newAcc->street_address_public = 1;
        $newAcc->short_term_ok = 0;
        $newAcc->setTypeId(1);

        // set roomates_id
        $newAcc->setRoomatesId(2);

        $acc_id = $newAcc->save();

        $expectedAcc_id = 4;

        $sharedRow = $this->_model->find($acc_id)->current();

        $this->assertEquals(
                array(
                    $expectedAcc_id,
                    'New acc title',
                    $sharedRow->roomates_id
                ),
                array(
                    $acc_id,
                    $sharedRow->getAccommodation()->title,
                    2
                )
        );
    }

    public function testUpdateSharedAccommodation2() {

        $newAcc = My_Houseshare_Factory::shared(2);

        $sharedRowBefore = $this->_model->find(2)->current();

        $newAcc->description = "New description";
        $newAcc->setAddrId(2);
        $newAcc->date_avaliable = "2011-01-04";
        $newAcc->price = 700;
        $newAcc->short_term_ok = 0;
        $newAcc->setTypeId(1);

        // set roomates_id
        $newAcc->setRoomatesId(2);

        $acc_id = $newAcc->save();

        $expectedAcc_id = 2;

        $sharedRowAfter = $this->_model->find(2)->current();

        $this->assertEquals(
                array(
                    $expectedAcc_id,
                    $sharedRowBefore->getAccommodation()->title,
                    'New description',
                    2,
                    700,
                    $sharedRowBefore->getAccommodation()->bond
                ),
                array(
                    $acc_id,
                    $sharedRowAfter->getAccommodation()->title,
                    $sharedRowAfter->getAccommodation()->description,
                    $sharedRowAfter->roomates_id,
                    $sharedRowAfter->getAccommodation()->price,
                    $sharedRowAfter->getAccommodation()->bond
                )
        );
    }

    /**
     * Deleting shared accommodation will also delete corresponding
     * accommodation row. To delete only shared row, use model object
     * not My_Houseshare_Accommodation or My_Houseshare_Shared
     */
    public function testDeleteSharedAccommodation1() {
        $newAcc = new My_Houseshare_Shared(2);
        $newAcc->delete();

        $accRowAfter = $this->_model->find(2)->current();
        $this->assertTrue(null === $accRowAfter);

        My_Houseshare_Shared::deleteAcc(3);

        $accRowAfter = $this->_model->find(3)->current();
        $this->assertTrue(null === $accRowAfter);

    }

}

?>
