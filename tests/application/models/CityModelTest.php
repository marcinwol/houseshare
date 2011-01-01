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

    /**
     * CITY table model
     *
     * @var My_Model_Table_City
     */
    private $_model;

    public function setUp() {
        parent::setUp();
        $this->_model = new My_Model_Table_City();
    }

    public function tearDown() {
        $this->_model = null;
        parent::tearDown();
    }

    public function testGetAllCities() {
        $arrayStates = $this->_model->getCities()->toArray();
        $this->assertEquals(count($arrayStates), 3);
    }

    public function testGetAllCitiesByPartialName() {
        $arrayStates = $this->_model->findCitiesBasedOnName('ta');
        $this->assertEquals(
                array(
                    $arrayStates[0]->name,
                ),
                array(
                    'Nowy Targ'
        ));
    }

    /**
     * @dataProvider insertCityProvider
     */
    public function testInsertCity($cityName, $stateId, $expectedId) {
        $id = $this->_model->insertCity(array(
                    'city_name' => $cityName,
                    'state_id' => $stateId
                ));
        $this->assertEquals($id, $expectedId);
    }

    public function insertCityProvider() {
        return array(
            array(' Krakow', 1, 1), //exhisting city
            array(' Nowy Targ', 1, 2), //exhisting city
            array(' Nowy Targ', 2, 4), // new city
            array(' Wroclaw', 3, 3), //exhisting city
            array(' Nowa Sol ', 3, 4) // new city
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
                        ),
                        $cityId
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
            array(3, 'Wroclaw', 2, 4),     // many references
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

}

?>
