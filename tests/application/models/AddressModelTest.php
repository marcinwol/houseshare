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
            array(' 13 ', ' 212 ', 3, null, 3, 6), // new address but null zip_id
        );
    }

    /**
     * @dataProvider updateAddressProvider
     */
    public function testUpdateAddress($addr_id, $unit_no, $street_no, $street_id, $zip_id, $city_id, $expectedId) {

        $id = $this->_model->updateAddress(array(
                    'unit_no' => $unit_no,
                    'street_no' => $street_no,
                    'street_id' => $street_id,
                    'zip_id' => $zip_id,
                    'city_id' => $city_id
                        ), $addr_id);
        $this->assertEquals($id, $expectedId);
    }

    public function updateAddressProvider() {
        return array(
            array(1, '', '23c', 2, 1, 1, 1), // one ref. to accomm
            array(1, '2', 'd23c', 1, 2, 2, 1), // one ref. to accomm
            array(4, '2', 'd23c', 1, 2, 2, 4), // no ref. to accomm
            array(2, '12-a', '221', 2, 2, 2, 6), // two ref. to accomm, make new
            array(2, '12-a', '221', 2, null, 2, 6), // two ref. to accomm, make new
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

    /**
     * @dataProvider getAddressMarkerProvider
     */
    public function testGetAddressMarker($addressId, $expMarkerId) {
        $addressRow = $this->_model->find($addressId)->current();
        $marker = $addressRow->getMarker();
        if (is_null($expMarkerId)) {
            $this->assertEquals(null, $marker);
        } else {
            $this->assertEquals($expMarkerId, $marker->marker_id);
        }
    }

    public function getAddressMarkerProvider() {
        return array(
            array(1, 4),
            array(2, null), // address has no marker, so returned marker should be null.
            array(4, 5)
        );
    }

    /**
     * @dataProvider insertAddressWithMarkerProvider
     */
    public function testInsertAddressWithMarker(
    $unit_no, $street_no, $street_id, $zip_id, $city_id, $marker_id, $expectedId) {
        $id = $this->_model->insertAddress(array(
                    'unit_no' => $unit_no,
                    'street_no' => $street_no,
                    'street_id' => $street_id,
                    'zip_id' => $zip_id,
                    'city_id' => $city_id,
                    'marker_id' => $marker_id
                ));
        $this->assertEquals($id, $expectedId);

        // get addressRow and check if marker_id was saved correctly
        $addressRow = $this->_model->find($id)->current();
        $this->assertEquals($marker_id, $addressRow->getMarker()->marker_id);
    }

    /**
     * Test only for new addresses. For existing addresses, marker is not going
     * to be changed.
     * 
     * @return array 
     */
    public function insertAddressWithMarkerProvider() {
        return array(
            array(' 13 ', ' 212 ', 3, 5, 3, 4, 6), // new address
            array(' 13a ', ' 2121 ', 3, 5, 3, 5, 6), // new address
        );
    }

    /**
     * @dataProvider updateAddressWithMarkerProvider
     */
    public function testUpdateAddressWithMarker($addr_id, $unit_no, $street_no,
            $street_id, $zip_id, $city_id, $marker_id, $expectedId) {

        $id = $this->_model->updateAddress(
                        array(
                            'unit_no' => $unit_no,
                            'street_no' => $street_no,
                            'street_id' => $street_id,
                            'zip_id' => $zip_id,
                            'city_id' => $city_id,
                            'marker_id' => $marker_id
                        ),
                        $addr_id
        );

        $this->assertEquals($id, $expectedId);
        
         // get addressRow and check if marker_id was saved correctly
        $addressRow = $this->_model->find($id)->current();
        $this->assertEquals($marker_id, $addressRow->getMarker()->marker_id);
        
    }

    public function updateAddressWithMarkerProvider() {
        return array(
            array(1, '', '23c', 2, 1, 1, 4, 1), // one ref. to accomm, no change in marker
            array(1, '2', 'd23c', 1, 2, 2, 5, 1), // one ref. to accomm, change marker
            array(4, '2', 'd23c', 1, 2, 2, 3, 4), // no ref. to accomm, change marker
            array(2, '12-a', '221', 2, 2, 2, 2, 6), // two ref. to accomm, add marker, make new
        );
    }

}

?>
