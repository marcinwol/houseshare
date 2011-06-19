<?php

require_once 'vfsStream/vfsStream.php';

/**
 * Description of PhotoHouseshareTest
 *
 * @author marcin
 */
class PhotoHouseshareTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_Photo';

    public function setUp() {
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('images'));
        $root = vfsStreamWrapper::getRoot();
        $root->addChild(new vfsStreamDirectory('forrent'));
        $root->addChild(new vfsStreamDirectory('forsell'));

        // make some test images .
        copy(MY_TEST_FILES . '/test.jpg', 'vfs://images/forrent/photo1.jpg');
        copy(MY_TEST_FILES . '/lena.png', 'vfs://images/forrent/lena.png');
        copy(MY_TEST_FILES . '/house.gif', 'vfs://images/forrent/house.gif');


        parent::setUp();
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
                'path' => 'vfs://images/new/',
                'acc_id' => 1,
            ),
            array(// expected data
                'photo_id' => 9,
                'path' => 'vfs://images/new' . '/',
                'path_id' => 3
            )
        );

        $params [] = array(
            array(
                'filename' => 'new_photo2.jpg',
                'path' => 'vfs://images/forsell/',
                'acc_id' => 2,
            ),
            array(// expected data
                'photo_id' => 9,
                'path' => 'vfs://images/forsell/',
                'path_id' => 2 // new path is already in db, so
            // do not create new path row. just use
            // existing path.
            )
        );

        return $params;
    }

    /**
     * @dataProvider makeThumbImgProvider
     */
    public function testMakeThumbImg($imgPath) {
        $vfsRoot = vfsStreamWrapper::getRoot();
               
        $result = My_Houseshare_Photo::makeThumb($imgPath);                
        
        $pinfo = pathinfo($imgPath);
        $thumbPath = 'vfs://images/' .
                My_Houseshare_Photo::$THUMBS_DIR_NAME . 'forrent/' .
                $pinfo['filename'] . '.jpg';

        $this->assertEquals($thumbPath,$result);

//        foreach ($vfsRoot->getChildren() as $child) {
//            var_dump($child->getName());
//        }


        // check if thumbs folder created
        $this->assertTrue(
                file_exists('vfs://images/' . My_Houseshare_Photo::$THUMBS_DIR_NAME)
        );




        // check if photo1.jpg is in thumbs folder.
        $this->assertTrue(file_exists($thumbPath));

//        var_dump($thumbPath);

        //copy($thumbPath,$pinfo['filename'] . '.jpg');
        // check if its size is correct.
        $thumb = PhpThumbFactory::create($thumbPath);
        $this->assertEquals(
                array(
                    'width' => My_Houseshare_Photo::THUMB_WIDTH,
                    'height' => My_Houseshare_Photo::THUMB_HEIGHT
                ),
                $thumb->getCurrentDimensions()
        );
    }

    public function makeThumbImgProvider() {
        return array(
            array('vfs://images/forrent/photo1.jpg'),
            array('vfs://images/forrent/lena.png'),
            array('vfs://images/forrent/house.gif')
        );
    }

    public function testDeletePhoto() {
        $root = vfsStreamWrapper::getRoot();

        // check if file exists before deleting photo
        $this->assertTrue(file_exists('vfs://images/forrent/photo1.jpg'));


        $photo = My_Houseshare_Factory::photo(1);
        $photo->delete();

        //var_dump($photo->getThumbPath());

        $photoRow = $this->_model->getPhoto(1);
        $this->assertTrue(null === $photoRow);

        // assert if file DON'T exists after deleting photo
        $this->assertFalse(file_exists('vfs://images/forrent/photo1.jpg'));
    }

    /**
     * Updating a photo is substituting files on disk, rahther than
     * records in database.
     *
     */
    public function testUpdatePhoto1() {

        $root = vfsStreamWrapper::getRoot();

        /* @var $thumb GdThumb */
        $thumb = PhpThumbFactory::create('vfs://images/forrent/photo1.jpg');
        //   var_dump($thumb->getFormat());
        $pinfo = pathinfo('vfs://images/forrent/photo1.jpg');
        //  var_dump(basename($pinfo['dirname']));
        // var_dump($root->getName());
    }

}

?>
