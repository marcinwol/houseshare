<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StreetModelTest
 *
 * @author marcin
 */
class StreetModelTest extends ModelTestCase {

    /**
     * STREET table model
     *
     * @var My_Model_Table_Street
     */
    private $_model;

    public function setUp() {
        parent::setUp();
        $this->_model = new My_Model_Table_Street();
    }

    public function tearDown() {
        $this->_model = null;
        parent::tearDown();
    }

    public function testGetAllStreets() {
        $streets = $this->_model->fetchAll();
        $this->assertEquals(count($streets), 4);
    }

    /**
     * @dataProvider insertStreetProvider
     */
    public function testInsertStreet($value, $expectedId) {
        $id = $this->_model->insertStreet(array('street_name' => $value));
        $this->assertEquals($id, $expectedId);
    }

    public function insertStreetProvider() {
        return array(
            array(' Podtatrzanska', 1),
            array(' Podtatrzanska   ', 1),
            array(' Aleja 1000 lecia  ', 4),
            array(' Wyb. Wyspianskiego   ', 3),
            array(' Wybrzeze Wyspianskiego   ', 5),
            array(' HAPDEN RD ', 2),
        );
    }

    /**
     * @dataProvider streetValuesProvider1
     */
    public function testFindByValueCorrect($value, $expectedResult) {
        $street = $this->_model->findByValue($value);
        $this->assertEquals($street->name, $expectedResult);
    }

    public function streetValuesProvider1() {
        return array(
            array(' Podtatrzanska', 'Podtatrzanska'),
            array(' Podtatrzanska   ', 'Podtatrzanska'),
            array(' Wyb. Wyspianskiego  ', 'Wyb. Wyspianskiego'),
            array(' HAPDEN RD   ', 'Hapden Rd'),
            array(' Aleja 1000 leCIA       ', 'Aleja 1000 lecia'),
        );
    }

    /**
     * @dataProvider streetValuesProvider2
     */
    public function testFindByValueInCorrect($value) {
        $street = $this->_model->findByValue($value);
        $this->assertTrue(is_null($street), 0);
    }

    public function streetValuesProvider2() {
        return array(
            array(' PodtatrzanskaA'),
            array(' Ul. Podtatrzanska   '),
            array(' Wybrzerze Wyspianskiego  '),
            array(' HAPDEN Road   '),
            array(' Al. 1000 leCIA   '),
        );
    }

}

?>
