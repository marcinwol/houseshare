<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhotoHouseshareTest
 *
 * @author marcin
 */
class PhotoHouseshareTest extends ModelTestCase {

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

    /**
     * @dataProvider getPhotoProvider
     */
    public function testGetPhoto($photo_id) {

        $photo = new My_Houseshare_Photo($photo_id);

        $photoRow = $this->_model->getPhoto($photo_id);

        $this->assertEquals(
                array(
                    $photoRow->acc_id,
                    $photoRow->filename,
                    $photoRow->path_id,
                    $photoRow->getPath()->value
                ),
                array(
                    $photo->acc_id,
                    $photo->filename,
                    $photo->path_id,
                    $photo->path
                )
        );
    }

    public function getPhotoProvider() {

        return array(
            array(1),
            array(2),
            array(7)
        );
    }

    /**
     * @dataProvider insertPhotoProvider
     */
    public function testInsertPhoto($data, $expected) {

        $photo = new My_Houseshare_Photo();

        $photo->filename = $data['filename'];
        $photo->path = $data['path'];
        $photo->setAccId($data['acc_id']);

        $id = $photo->save();

        $photoRow = $this->_model->getPhoto($id);

        $this->assertEquals(
                array(
                    $expected['photo_id'],
                    $data['acc_id'],
                    $data['filename'],
                    $expected['path_id'], // new path
                    $expected['path']
                ),
                array(
                    $id,
                    $photoRow->acc_id,
                    $photoRow->filename,
                    $photoRow->path_id,
                    $photoRow->getPath()->value
                )
        );
    }

    public function insertPhotoProvider() {

        $params [] = array(
            array(
                'filename' => 'new_photo.jpg',
                'path' => '/new/path',
                'acc_id' => 1,
            ),
            array(// expected data
                'photo_id' => 9,
                'path' => '/new/path' . '/',
                'path_id' => 3
            )
        );

        $params [] = array(
            array(
                'filename' => 'new_photo2.jpg',
                'path' => '/images2/upload2/',
                'acc_id' => 2,
            ),
            array(// expected data
                'photo_id' => 9,
                'path' => '/images2/upload2/',
                'path_id' => 2 // new path is already in db, so
            // do not create new path row. just use
            // existing path.
            )
        );

        return $params;
    }


    /**
     * Updating a photo is substituting files on disk, rahther than
     * records in database.
     *
     */
    public function testUpdatePhoto() {

        $this->assertTrue(true);
        
    }

   

}

?>
