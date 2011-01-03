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
     * PHOTO table model
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
                    'acc_id' => $acc_id
                ));
        $this->assertEquals($id, $expected_id);
    }

    public function insertPhotoProvider() {
        return array(
            array(' photo_new.png', 2, 1, 9), // new photo
            array('photo_new2.png', 1, 2, 9)  // new photo
        );
    }

    /**
     * @dataProvider updatePhotoProvider
     */
    public function testUpdatePhoto($photo_id, $data) {

        $id = $this->_model->updatePhoto(
                        array(
                            'filename' => $data['filename'],
                            'path_id' => $data['path_id'],
                            'acc_id' => $data['acc_id']
                        ), $photo_id);

        $photoData = $this->_model->getPhoto($id)->toArray();

        $data['photo_id'] = $photo_id;

        ksort($data);
        ksort($photoData);
        
        $this->assertEquals($data, $photoData);
    }

    public function updatePhotoProvider() {
        return array(
            array(
                1, //photo id
                array('acc_id' => 1, 'filename' => 'photo12.jpg', 'path_id' => 2)
            ),
             array(
                3, //photo id
                array('acc_id' => 3, 'filename' => 'photo31.jpg', 'path_id' =>1)
            )
        );
    }


    /**
     * @expectedException Zend_Db_Exception
     */
    public function testPhotoThrowDbException() {

         // path_id and filename should be unique. Thus
         // you cannot change filename and path_id of photo 2 to be
         // the same as those of photo 1.
        
         $id = $this->_model->updatePhoto(
                        array(
                            'filename' => 'photo1.jpg',
                            'path_id' => 1,
                            'acc_id' => 1
                        ), 2);

    }

    public function testGetFullPath() {
        $fullPath = $this->_model->getPhoto(2)->getFullPath();
        $this->assertEquals('/images/upload/photo2.jpg', $fullPath);

        $fullPath = $this->_model->getPhoto(7)->getFullPath();
        $this->assertEquals('/images2/upload2/photo11.jpg', $fullPath);
    }

}

?>
