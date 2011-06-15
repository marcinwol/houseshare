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

   protected $_modelName = 'My_Model_Table_Street';

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
     * @dataProvider updateStreetProvider
     */
    public function testUpdateStreet($streetId, $streetName, $expectedId) {
        $id = $this->_model->updateStreet(
                        array('street_name' => $streetName),
                        $streetId
        );
        $this->assertEquals($id, $expectedId);
    }

    public function updateStreetProvider() {
        return array(
            array(1, 'Podtatrzanska updated', 1), // no reference
            array(3, 'Wyb. Wyspianskiego updated', 3), // one reference
            array(4, 'Aleja 1000 lecia updated', 5), // two reference, create new
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

    public function testFindBasedOnName() {
        $streets = $this->_model->findBasedOnName('tatrz');
        $this->assertEquals(1, count($streets));

        $streets = $this->_model->findBasedOnName('a');
        $this->assertEquals(4, count($streets));

    }

}

?>
