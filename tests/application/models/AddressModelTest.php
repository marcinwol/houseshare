<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddressModelTest
 *
 * @author marcin
 */
class AddressModelTest extends ModelTestCase {

    /**
     * ADDRESS table model
     *
     * @var My_Model_Table_Address
     */
    private $_model;

    public function setUp() {
        parent::setUp();
        $this->_model = new My_Model_Table_Address();
    }

    public function tearDown() {
        $this->_model = null;
        parent::tearDown();
    }

    public function testGetAllAddresses() {
        $result = $this->_model->fetchAll()->toArray();
        $this->assertEquals(count($result), 3);
    }



     /**
     * @dataProvider insertAddressProvider
     */
    public function testInsertAddress(
            $unit_no, $street_no, $street_id, $zip_id, $city_id, $expectedId) {
        $id = $this->_model->insertAddress(array(
                   'unit_no' => $unit_no,
                    'street_no' => $street_no,
                    'street_id' => $street_id,
                    'zip_id' => $zip_id,
                    'city_id' => $city_id
                ));
        $this->assertEquals($id, $expectedId);
    }

    public function insertAddressProvider() {
        return array(
           array('', ' 23c ', 2, 1, 1, 1),      // exhistig address
           array(' 12 ', ' 212 ', 3, 5, 3, 2),  // exhistig address
           array(' 13 ', ' 212 ', 3, 5, 3, 5),  // new address
        );
    }




    /**
     * @dataProvider addressValuesProvider1
     */
    public function testFindByValuesCorrect(
    $unit_no, $street_no, $street_id, $zip_id, $city_id, $expectedResult) {

        $cityRow = $this->_model->findByValues(array(
                    'unit_no' => $unit_no,
                    'street_no' => $street_no,
                    'street_id' => $street_id,
                    'zip_id' => $zip_id,
                    'city_id' => $city_id
                ));
        $this->assertEquals($cityRow->addr_id, $expectedResult);
    }

    public function addressValuesProvider1() {
        return array(
            array('', ' 23c ', 2, 1, 1, 1),
            array(' 12 ', ' 212 ', 3, 5, 3, 2),
        );
    }

    /**
     * @dataProvider addressValuesProvider2
     */
    public function testFindByValuesInCorrect(
    $unit_no, $street_no, $street_id, $zip_id, $city_id) {

        $cityRow = $this->_model->findByValues(array(
                    'unit_no' => $unit_no,
                    'street_no' => $street_no,
                    'street_id' => $street_id,
                    'zip_id' => $zip_id,
                    'city_id' => $city_id
                ));
        $this->assertTrue(is_null($cityRow));
    }

    public function addressValuesProvider2() {
        return array(
            array('a', ' 23c ', 2, 1, 1),
            array(' 22 ', ' 212 ', 3, 5, 3),
            array('', ' 23c ', 3, 1, 1),
            array(' 12 ', ' 212 ', 3, 5, 2)
        );
    }

}

?>
