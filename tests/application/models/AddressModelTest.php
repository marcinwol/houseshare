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

    protected $_modelName = 'My_Model_Table_Address';

    public function testGetAllAddresses() {
        $result = $this->_model->fetchAll()->toArray();
        $this->assertEquals(count($result), 4);
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
            array('', ' 23c ', 2, 1, 1, 1), // exhistig address
            array(' 12 ', ' 212 ', 3, 5, 3, 2), // exhistig address
            array(' 13 ', ' 212 ', 3, 5, 3, 6), // new address
        );
    }

    /**
     * @dataProvider updateAddressProvider
     */
    public function testUpdateAddress($addr_id, $unit_no, $street_no,
            $street_id, $zip_id, $city_id, $expectedId) {

        $id = $this->_model->updateAddress(array(
                    'unit_no' => $unit_no,
                    'street_no' => $street_no,
                    'street_id' => $street_id,
                    'zip_id' => $zip_id,
                    'city_id' => $city_id
                        ),
                        $addr_id);
        $this->assertEquals($id, $expectedId);
    }

    public function updateAddressProvider() {
        return array(
            array(1, '', '23c', 2, 1, 1, 1), // one ref. to accomm
            array(1, '2', 'd23c', 1, 2, 2, 1), // one ref. to accomm
            array(4, '2', 'd23c', 1, 2, 2, 4), // no ref. to accomm
            array(2, '12-a', '221', 2, 2, 2, 6), // two ref. to accomm, make new
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
