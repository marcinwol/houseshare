<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ZipModelTest
 *
 * @author marcin
 */
class ZipModelTest extends ModelTestCase {

    /**
     * ZIP table model
     *
     * @var My_Model_Table_Zip
     */
    private $_model;

    public function setUp() {
        parent::setUp();
        $this->_model = new My_Model_Table_Zip();
    }

    public function tearDown() {
        $this->_model = null;
        parent::tearDown();
    }

    public function testGetAllZips() {
        $zips = $this->_model->fetchAll();
        $this->assertEquals(count($zips), 3);
    }

    /**
     * @dataProvider insertZipProvider
     */
    public function testInsertZip($value, $expectedId) {
        $id = $this->_model->insertZip(array('zip' => $value));
        $this->assertEquals($id, $expectedId);
    }

    public function insertZipProvider() {
        return array(
            array(' 2356', 2),
            array(' 2356   ', 2),
            array(' 34-543  ', 1),
            array(' 98-34a   ', 5),
            array(' 98-34A   ', 5),
            array(' 23-937 ', 6),
        );
    }

     /**
     * @dataProvider updateZipProvider
     */
    public function testUpdateZip($zipId, $zipValue, $expectedId) {
        $id = $this->_model->updateZip(
                        array('zip' => $zipValue),
                        $zipId
        );
        $this->assertEquals($id, $expectedId);
    }

    public function updateZipProvider() {
        return array(
            array(2, '2356', 2), // no change
            array(2, '2356-43', 2), // one reference
            array(1, '34-543', 1), // more references, no change
            array(1, '34-543-3', 6), // more references, change
        );
    }


    /**
     * @dataProvider zipValuesProvider1
     */
    public function testFindByValueCorrect($value, $expectedResult) {
        $zip = $this->_model->findByValue($value);
        $this->assertEquals($zip->value, $expectedResult);
    }

    public function zipValuesProvider1() {
        return array(
            array(' 2356', '2356'),
            array(' 2356   ', '2356'),
            array(' 34-543  ', '34-543'),
            array(' 98-34a   ', '98-34a'),
            array(' 98-34A   ', '98-34a'),
        );
    }

    /**
     * @dataProvider zipValuesProvider2
     */
    public function testFindByValueInCorrect($value) {
        $zip = $this->_model->findByValue($value);
        $this->assertTrue(is_null($zip), 0);
    }

    public function zipValuesProvider2() {
        return array(
            array(' 23a56'),
            array(' 23 56   '),
            array(' 34_543  '),
            array(' 98-34   '),
            array(' 98-34 A   '),
        );
    }

}

?>
