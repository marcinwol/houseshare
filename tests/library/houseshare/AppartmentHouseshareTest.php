<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppartmentHouseshareTest
 *
 * @author marcin
 */
class AppartmentHouseshareTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_Appartment';

    public function testGetAppartmentDetails() {
        
        $acc = My_Houseshare_Factory::accommodation(4);
        
       
        $this->assertEquals(
                array(1,2),
                array($acc->details->details_id, $acc->details->bedrooms)
        );
    }

    public function testInsertAppartment1() {

        $newAcc = My_Houseshare_Factory::appartment();

        $newAcc->title = "New Acc title";
        $newAcc->description = "New description";
        $newAcc->setAddrId(2);
        $newAcc->setUserId(1);
        $newAcc->date_avaliable = "2011-01-04";
        $newAcc->price = 300;
        $newAcc->bond = 1200;
        $newAcc->street_address_public = 1;
        $newAcc->short_term_ok = 0;
        $newAcc->setTypeId(3);
        $newAcc->setDetailsId(2);
        

        $acc_id = $newAcc->save();

        $expectedAcc_id = 6;

        $sharedRow = $this->_model->find($acc_id)->current();

        $this->assertEquals(
                array(
                    $expectedAcc_id,
                    'New acc title',
                    $sharedRow->details_id
                ),
                array(
                    $acc_id,
                    $sharedRow->getAccommodation()->title,
                    2
                )
        );
    }

    public function testInsertAppartment2() {

        $newAcc = My_Houseshare_Factory::appartment();

        $newAcc->title = "New Acc title";
        $newAcc->description = "New description";
        $newAcc->setAddrId(2);
        $newAcc->setUserId(1);
        $newAcc->date_avaliable = "2011-01-04";
        $newAcc->price = 300;
        $newAcc->bond = 1200;
        $newAcc->street_address_public = 1;
        $newAcc->short_term_ok = 0;
        $newAcc->setTypeId(3);

        // set details_id
        $newAcc->setDetailsId(2);

        $acc_id = $newAcc->save();

        $expectedAcc_id = 6;

        $sharedRow = $this->_model->find($acc_id)->current();

        $this->assertEquals(
                array(
                    $expectedAcc_id,
                    'New acc title',
                    $sharedRow->details_id
                ),
                array(
                    $acc_id,
                    $sharedRow->getAccommodation()->title,
                    2
                )
        );
    }

    public function testUpdateAppartment2() {

        $newAcc = My_Houseshare_Factory::accommodation(4);

        $sharedRowBefore = $this->_model->find(4)->current();

        $newAcc->description = "New description";
        $newAcc->setAddrId(2);
        $newAcc->date_avaliable = "2011-01-04";
        $newAcc->price = 700;
        $newAcc->short_term_ok = 0;

        // set details_id
        $newAcc->setDetailsId(2);

        $acc_id = $newAcc->save();

        $expectedAcc_id = 4;

        $sharedRowAfter = $this->_model->find(4)->current();

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
                    $sharedRowAfter->details_id,
                    $sharedRowAfter->getAccommodation()->price,
                    $sharedRowAfter->getAccommodation()->bond
                )
        );
    }

    /**
     * Deleting appartment accommodation will also delete corresponding
     * accommodation row. To delete only appartment row, use model object
     * not My_Houseshare_Accommodation or My_Houseshare_Shared
     */
    public function testDeleteAppartment() {
        $newAcc =  My_Houseshare_Factory::accommodation(4);
        $newAcc->delete();

        $accRowAfter = $this->_model->find(4)->current();
        $this->assertTrue(null === $accRowAfter);

        My_Houseshare_Appartment::deleteAcc(5);

        $accRowAfter = $this->_model->find(5)->current();
        $this->assertTrue(null === $accRowAfter);

    }

}

?>
