<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PathModelTest
 *
 * @author marcin
 */
class PathModelTest extends ModelTestCase {

     protected $_modelName = 'My_Model_Table_Path';

   
    public function testGetAllPaths() {
        $this->assertEquals(2, $this->_model->fetchAll()->count());
    }

    /**
     * @dataProvider insertPathProvider
     */
    public function testInsertPath($value, $expectedId) {
        $id = $this->_model->insertPath(array('path_value' => $value));
        $this->assertEquals($id, $expectedId);
    }

    public function insertPathProvider() {
        return array(
            array(' vfs://images/forrent/', 1),
            array(' vfs://images/forsell/ ', 2),
            array(' vfs://images/forlease/ ', 3)
        );
    }

    /**
     * @dataProvider pathValuesProvider1
     */
    public function testFindByValueCorrect($value, $expectedResult) {
        $path = $this->_model->findByValue($value);
        $this->assertEquals($path->value, $expectedResult);
    }

    public function pathValuesProvider1() {
        return array(
            array(' vfs://images/forrent/', 'vfs://images/forrent/'),
            array(' vfs://images/forrent/   ', 'vfs://images/forrent/'),
            array(' vfs://images/forsell/  ', 'vfs://images/forsell/'),
            array(' vfs://images/FORsell/  ', 'vfs://images/forsell/')
        );
    }

    /**
     * @dataProvider pathValuesProvider2
     */
    public function testFindByValueInCorrect($value) {
        $path = $this->_model->findByValue($value);
        $this->assertTrue(is_null($path), 0);
    }

    public function pathValuesProvider2() {
        return array(
            array(' /non/existing/path/'),
            array(' /non/existing/path/2  ')
        );
    }

    /**
     * @dataProvider getPhotosInPatProvider
     */
    public function testGetPhotosInPath($path_id, $expected) {
        $photos = $this->_model->getPath($path_id)->getPhotos();

        $photo_ids = array();

        foreach ($photos as $photo) {
            $photo_ids[] = $photo->photo_id;
        }

        sort($photo_ids);

        $this->assertEquals($expected, $photo_ids);
    }

    public function getPhotosInPatProvider() {
        return array(
            array(
                1,             //path id
                array(1, 2, 8) // photos ids in path id=1
            ),
            array(
                2,            //path id
                array(3, 7)   // photos ids in path id=2
            )
        );
    }

}

?>
