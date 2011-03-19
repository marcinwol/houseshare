<?php

class AccommodationControllerTest extends ControllerTestCase {

    public function setUp() {

        // create mock file system
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('images'));

        parent::setUp();
    }

    public function testIndexAction() {
        $this->dispatch('/accommodation');         
        $this->assertController('accommodation');
        $this->assertAction('list');

       
    }

    /**
     *
     * @dataProvider addAccommodationProvider
     * @param array $postData
     */
    public function testAddAccommodationSuccessfull($postData) {
        $this->request->setPost($postData)->setMethod('POST');
        $this->dispatch('/accommodation/add');


        // expected user id is 4
        $user = My_Houseshare_Factory::roomate(4);

        $this->assertEquals(
                array(
                    'marcin',
                    0
                ),
                array(
                    $user->first_name,
                    $user->last_name_public
                )
        );

        // expected address id is 6
        $address = new My_Houseshare_Address(6);
        $this->assertEquals(
                array(
                    '',
                    'Aleja Zamonska',
                    'Wroclaw'
                ),
                array(
                    $address->unit_no,
                    $address->street,
                    $address->city
                )
        );

        // expected roomates id is 4
        $roomatesModel = new My_Model_Table_Roomates();
        $roomates = $roomatesModel->find(4)->current();

        $this->assertEquals(
                array(
                    4,
                    2
                ),
                array(
                    $roomates->no_roomates,
                    $roomates->gender
                )
        );

        // expected accommodation id is 4
        $acc = My_Houseshare_Factory::shared(4);

        $this->assertEquals(
                array(
                    4,
                    'Great room for rent in quite place'
                ),
                array(
                    $acc->roomates_id,
                    $acc->title
                )
        );

        // check expected number of preferences
        $this->assertEquals(5, count($acc->features));
        $this->assertEquals(3, count($acc->preferences));

        // check if session variablec acc_id was created
        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');
        $this->assertEquals(4, $addAccInfoNamespace->acc_id);

        // finally check if user is redirected to addphotos
        $this->assertRedirectTo('/accommodation/addphotos');
    }

    public function addAccommodationProvider() {
        return array(
            array(
                array(// correct form data
                    'basic_info' => array(
                        'acc_type' => 1,
                        'title' => 'Great room for rent in quite place',
                        'description' => "Description of the accommodation",
                        'date_avaliable' => "13/01/2011",
                        'short_term' => 1,
                        'price' => 323,
                        'bond' => 1232
                    ),
                    'address' => array(
                        'unit_no' => '',
                        'street_no' => '34a',
                        'address_public' => 0,
                        'street_name' => 'Aleja Zamonska',
                        'zip' => '34-234',
                        'city' => 'Wroclaw',
                        'state' => 'Dolnoslaskie'
                    ),
                    'roomates' => array(
                        'no_roomates' => 4,
                        'gender' => 2,
                        'min_age' => 20,
                        'max_age' => 35
                    ),
                    'preferences' => array(
                        'smokers' => 1,
                        'kids' => -1,
                        'couples' => 3,
                        'pets' => -1,
                        'gender' => 1
                    ),
                    'acc_features' => array(
                        'internet' => 1,
                        'parking' => -1,
                        'tv' => 3,
                        'airconditioning' => 5,
                        'furnished' => 2
                    ),
                    'room_features' => array(
                        'privatebath' => -1,
                        'privatebalcony' => 7
                    ),
                    'about_you' => array(
                        'first_name' => 'marcin',
                        'last_name' => 'wolski',
                        'last_name_public' => 0,
                        'phone_no' => '+234 234 243',
                        'phone_public' => 1,
                        'email' => 'marcin@test.com',
                        'password1' => 'haslo12',
                        'password2' => 'haslo12'
                    )
                )
            )
        );
    }
    
    
     /**
     *
     * @dataProvider addAccommodationProvider
     * @param array $postData
     */
    public function testEditAccommodationSuccessfull($postData) {
        
        // first authenticate correct user
        $this->request->setMethod('POST')->setPost(
                array('email'=>'test@test.com', 'password'=>'test12')
                );
        $this->dispatch('/user/login');
        $this->resetRequest()->resetResponse();
        
        $this->request->setPost($postData)->setMethod('POST')->setParam('id','1');
        $this->dispatch('/accommodation/edit');
              
        
     //   $acc = My_Houseshare_Factory::shared(1);
        
      //  var_dump($this->getResponse()->getBody());
 //        var_dump($acc->preferences->asArray());
        
        // at the very end check if successful redirection
        $this->assertRedirectTo('/accommodation/show/id/1');
        

    }
    

    /**
     * Using phpt file to test POSTS is a bet overkill.
     */
    public function _testUploadPhotos() {

        $phpt = new PHPUnit_Extensions_PhptTestCase(
                        MY_TEST_FILES . '/_phpt/upload-example.phpt',
                        array('cgi' => 'php-cgi')
        );

        $result = $phpt->run();

        $this->assertTrue($result->wasSuccessful());
    }

    public function testGoToIndexIfNoSession() {

        // session is not set as in testSuccessfullUploadOfTwoPhotos()

        $this->dispatch('/accommodation/addphotos');
        $this->assertRedirectTo('/index');

        $this->resetRequest()->resetResponse();

        $this->dispatch('/accommodation/success');
        $this->assertRedirectTo('/index');
    }

    public function testIfSessionDeletedInSuccessAction() {

        // use this acc for the tests
        $acc_id = 1;

        // set session that is needed to upload photos
        $this->_setAddAccInfoSession($acc_id);

        $this->dispatch('/accommodation/success');

        $this->assertFalse(Zend_Session::namespaceIsset('addAccInfo'));
    }

    public function testIfSkipPressedGoToSuccess() {

        // use this acc for the tests
        $acc_id = 1;

        // set session that is needed to upload photos
        $this->_setAddAccInfoSession($acc_id);

        // setup $_FILES variable
        $this->_mockFileUPload();

        // set  POST data
        $this->request->setPost(array(
            'MAX_FILE_SIZE' => '67108864',
            'skip' => 'Skip'
        ))->setMethod('POST');

        $this->dispatch('/accommodation/addphotos');

        $this->assertRedirectTo('/accommodation/success');
    }

    /**
     * This session is needed for uploading photos
     *
     * @param int $acc_id
     */
    protected function _setAddAccInfoSession($acc_id) {
        Zend_Session_Namespace::unlockAll();
        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');
        $addAccInfoNamespace->acc_id = $acc_id;
        $addAccInfoNamespace->lock();
    }

    /**
     * Test sucessful upload
     */
    public function testSuccessfullUploadOfTwoPhotos() {

        // use this acc for the tests
        $acc_id = 1;

        // set session that is needed to upload photos
        $this->_setAddAccInfoSession($acc_id);

        // delete photos if there are already in the database
        $photoModel = new My_Model_Table_Photo();
        $photoRowset = $photoModel->delete("acc_id = $acc_id");

        // setup $_FILES variable
        $this->_mockFileUPload();

        // set some other POST data
        $this->request->setPost(array(
            'Submit' => 'Submit',
            'MAX_FILE_SIZE' => '67108864'
        ))->setMethod('POST');

        $this->dispatch('/accommodation/addphotos');

        //$files = My_Houseshare_Tools::getDirContent('vfs://images');
        //var_dump($files);

        $this->assertRedirectTo('/accommodation/success');

        $acc = My_Houseshare_Factory::accommodation($acc_id);

        // acc 1 should have now 2 photos
        $this->assertEquals(2, count($acc->photos));

        foreach ($acc->photos as $p) {
            /* @var $p My_Houseshare_Photo */
            $this->assertTrue(file_exists(PHOTOS_PATH . "/{$p->getFullPath()}"));
            $this->assertTrue(file_exists(THUMBS_PATH . "/{$p->getThumbPath()}"));

            // var_dump(PHOTOS_PATH . "/{$p->getFullPath()}");
            // var_dump(THUMBS_PATH . "/{$p->getThumbPath()}");
        }
    }

    protected function _mockFileUpload() {

        $img1 = MY_TEST_FILES . '/test.jpg';
        $img1Size = filesize($img1);

        copy($img1, '/tmp/tempImg1');
        copy($img1, '/tmp/tempImg2');

        $_FILES = array(
            'photo' => array(
                'name' => array(
                    0 => 'test.jpg',
                    1 => 'test2.jpg',
                    2 => ''
                ),
                'type' => array(
                    0 => 'image/jpeg',
                    1 => 'image/jpeg',
                    2 => ''
                ),
                'tmp_name' => array(
                    0 => '/tmp/tempImg1',
                    1 => '/tmp/tempImg2',
                    2 => ''
                ),
                'error' => array(
                    0 => 0,
                    1 => 0,
                    2 => 4
                ),
                'size' => array(
                    0 => $img1Size,
                    1 => $img1Size,
                    2 => 0
                )
            )
        );
    }

}

