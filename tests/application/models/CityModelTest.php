<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CityModelTest
 *
 * @author marcin
 */
class CityModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_City';

    public function testGetAllCities() {
        $citis = $this->_model->getCities();
        $this->assertEquals(count($citis), 3);

        $citis = My_Model_Table_City::getAllCities();
        $this->assertEquals(count($citis), 3);

        $citis = My_Model_Table_City::getAllCitiesAsArray();
        $this->assertEquals(count($citis), 3);
    }

    public function testGetAllCitiesByPartialName() {
        $arrayStates = $this->_model->findCitiesBasedOnName('ta');
        $this->assertEquals(
                array(
            $arrayStates[0]->name,
                ), array(
            'Nowy Targ'
        ));
    }

    /**
     * @dataProvider insertCityProvider
     */
    public function testInsertCity($cityName, $stateId, $markerId, $expectedId) {
        $id = $this->_model->insertCity(array(
                    'city_name' => $cityName,
                    'state_id' => $stateId,
                    'marker_id' => $markerId
                ));
        $this->assertEquals($id, $expectedId);
    }

    public function insertCityProvider() {
        return array(
            array(' Krakow', 1, 1, 1), //exhisting city
            array(' Nowy Targ', 1, 1, 2), //exhisting city
            array(' Nowy Targ', 2, 1, 4), // new city
            array(' Wroclaw', 3, 1, 3), //exhisting city
            array(' Nowa Sol ', 3, 5, 4) // new city
        );
    }

    /**
     * @dataProvider updateCityProvider
     */
    public function testUpdateCity($cityId, $cityName, $stateId, $expectedId) {
        $id = $this->_model->updateCity(
                        array(
                    'city_name' => $cityName,
                    'state_id' => $stateId
                        ), $cityId
        );
        $this->assertEquals($id, $expectedId);
    }

    public function updateCityProvider() {
        return array(
            array(1, 'Krakow updated', 1, 1), //only one reference
            array(1, 'Krakow updated2', 2, 1), //only one reference
            array(2, 'Nowy targ updated', 2, 2), //no references
            array(2, 'Nowy tg updated1', 3, 2), //no references
            array(3, 'Wroclaw updated', 3, 4), // many references
            array(3, 'Wroclaw', 2, 4), // many references
            array(3, 'Wroclaw updated2', 1, 4), // many references
        );
    }

    /**
     * @dataProvider cityValuesProvider1
     */
    public function testFindByNameAndStateCorrect($cityName, $state_id, $expectedResult) {
        $city = $this->_model->findByNameAndState($cityName, $state_id);
        $this->assertEquals($city->name, $expectedResult);
    }

    public function cityValuesProvider1() {
        return array(
            array(' Krakow  ', 1, 'Krakow'),
            array(' Krakow   ', 1, 'Krakow'),
            array(' WROCLAW  ', 3, 'Wroclaw'),
            array(' Nowy targ   ', 1, 'Nowy Targ')
        );
    }

    /**
     * @dataProvider cityValuesProvider2
     */
    public function testFindByNameAndStateInCorrect($cityName, $state_id) {
        $city = $this->_model->findByNameAndState($cityName, $state_id);
        $this->assertTrue(is_null($city));
    }

    public function cityValuesProvider2() {
        return array(
            array(' KrakowW  ', 1),
            array(' Krakow   ', 2),
            array(' WROCLAW  ', 1),
            array(' Nowy targ   ', 4)
        );
    }

    /**
     * @dataProvider getCityMarkerProvider
     */
    public function testGetCityMarker($cityId, $expLat, $expLng) {
        $cityRow = $this->_model->find($cityId)->current();
        $marker = $cityRow->getMarker();
        $this->assertEquals(array($expLat, $expLng), array($marker->lat, $marker->lng));
    }

    public function getCityMarkerProvider() {
        return array(
            array(1, '50.074799', '19.947701'),
            array(2, '49.480099', '20.032499')
        );
    }

    /**
     * @dataProvider updateCitySetMarkerProvider
     */
    public function testSetCityMarker($cityId, $newMarkerId) {
        
        $city_id = $this->_model->setMarker($cityId, $newMarkerId);
        $cityRow = $this->_model->find($city_id)->current();
        $this->assertEquals($newMarkerId, $cityRow->marker_id);
        
    }

    public function updateCitySetMarkerProvider() {
        return array(
            array(1, 3),
            array(2, 4),
            array(3, null)
        );
    }

}

?>
