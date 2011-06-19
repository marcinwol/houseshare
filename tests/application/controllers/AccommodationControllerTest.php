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

        // add accommodation and a 
        // session variable step1 should be created
        $this->dispatch('/accommodation/add');

        // var_dump($this->getResponse()->getBody());
        // check if this session exist        
        $session = new Zend_Session_Namespace('addAccInfo');
        $this->assertFalse(is_null($session));

        //check if session variable step1 is field
        $this->assertTrue(isset($session->step[1]));


        // finally check if user is redirected to google map
        $this->assertRedirectTo('/accommodation/map');
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
                        'price_info' => '',
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
                        'max_age' => 35,
                        'description' => 'We are studetets looking for another student'
                    ),
                    'preferences' => array(
                        'smokers' => 1,
                        'kids' => 0,
                        'couples' => 0,
                        'pets' => 1,
                        'gender' => 1,
                        'min_tenancy' => 3,
                        'description' => 'Everyone is welcome'
                    ),
                    'acc_features' => array(
                        'internet' => 1,
                        'parking' => 1,
                        'tv' => 0,
                        'airconditioning' => 1,
                        'furnished' => 1,
                        'description' => 'Next to pwr'
                    ),
                    'about_you' => array(
                        'nickname' => 'marcin',
                        'phone_no' => '+234 234 243',
                        'phone_public' => 1,
                        'email' => 'marcin@test.com',
                        'password1' => 'haslo12',
                        'password2' => 'haslo12',
                        'description' => 'I\m the owner of this appartment'
                    ),
                    'legal' => array(
                        'accept' => '1'
                    )
                )
            )
        );
    }

    /**
     *
     * @dataProvider editAccommodationProvider
     * @param array $postData
     */
    public function testEditAccommodationSuccessfull($postData) {

        // first authenticate correct user
        $this->request->setMethod('POST')->setPost(
                array('email' => 'test@test.com', 'password' => 'test12')
        );
        $this->dispatch('/user/login');

        $this->resetRequest()->resetResponse();

        //this is also needed for test to work.
        $_SERVER['SERVER_NAME'] = 'test';

        $this->request->setPost($postData)->setMethod('POST')->setParam('id', '2');
        $this->dispatch('/accommodation/edit');



        //var_dump($this->getResponse()->getBody());
        //        var_dump($acc->preferences->asArray());
        // at the very end check if successful redirection
        $this->assertRedirectTo('/user/');
    }

    public function editAccommodationProvider() {
        return array(
            array(
                array(// correct form data
                    'basic_info' => array(
                        'acc_type' => 2,
                        'title' => 'Great room for rent in quite place',
                        'description' => "Description of the accommodation",
                        'date_avaliable' => "13/01/2011",
                        'short_term' => 1,
                        'price' => 323,
                        'price_info' => '',
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
                        'max_age' => 35,
                        'description' => 'We are studetets looking for another student'
                    ),
                    'preferences' => array(
                        'smokers' => 1,
                        'kids' => 0,
                        'couples' => 0,
                        'pets' => 1,
                        'gender' => 1,
                        'min_tenancy' => 3,
                        'description' => 'Everyone is welcome'
                    ),
                    'acc_features' => array(
                        'internet' => 1,
                        'parking' => 1,
                        'tv' => 0,
                        'airconditioning' => 1,
                        'furnished' => 1,
                        'description' => 'Next to pwr'
                    ),
                    'about_you' => array(
                        'nickname' => 'marcin',
                        'phone_no' => '+234 234 243',
                        'phone_public' => 1,
                        'email' => 'marcin@test.com',
                        'password1' => 'haslo12',
                        'password2' => 'haslo12',
                        'description' => 'I\m the owner of this appartment'
                    )
                )
            )
        );
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

        
        $this->assertRedirectTo('/');
        
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
        
        //var_dump($this->getBody());

        $this->assertRedirectTo('/accommodation/create-acc');
    }

    /**
     * This session is needed for uploading photos
     *
     * @param int $acc_id
     */
    protected function _setAddAccInfoSession($acc_id) {
        Zend_Session_Namespace::unlockAll();
        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');
        $addAccInfoNamespace->step[1] = array();
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

        $this->assertRedirectTo('/accommodation/create-acc');

        
        //if OK, paths to photos should be in session variable
        $session = new Zend_Session_Namespace('addAccInfo');                
        $photos = $session->step[3];

        // acc 1 should have now 2 photos
        $this->assertEquals(2, count($photos));

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

