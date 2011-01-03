<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhotoModelTest
 *
 * @author marcin
 */
class PhotoModelTest extends ModelTestCase {

    /**
     * CITY table model
     *
     * @var My_Model_Table_Photo
     */
    private $_model;

    public function setUp() {
        parent::setUp();
        $this->_model = new My_Model_Table_Photo();
    }

    public function tearDown() {
        $this->_model = null;
        parent::tearDown();
    }

    public function testGetAllPhotos() {
        $photos = $this->_model->fetchAll();
        $this->assertEquals(5, count($photos));
    }

  
    /**
     * @dataProvider insertPhotoProvider
     */
    public function testInsertPhoto($filename, $path_id, $acc_id, $expected_id) {
        $id = $this->_model->insertPhoto(array(
                    'filename' => $filename,
                    'path_id' => $path_id,
                    'acc_id'  => $acc_id
                ));
        $this->assertEquals($id, $expected_id);
    }

    public function insertPhotoProvider() {
        return array(
            array(' photo_new.png', 2,1, 9), // new photo
            array('photo_new2.png', 1,2, 9)  // new photo
        );
    }

    public function testGetFullPath() {
        $fullPath = $this->_model->getPhoto(2)->getFullPath();
        $this->assertEquals('/images/upload/photo2.jpg',$fullPath);

        $fullPath = $this->_model->getPhoto(7)->getFullPath();
        $this->assertEquals('/images2/upload2/photo11.jpg',$fullPath);
    }

  
}

?>
