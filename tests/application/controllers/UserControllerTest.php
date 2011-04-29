<?php

class UserControllerTest extends ControllerTestCase {

        public function setUp() {
        parent::setUp();
        $this->_setupAuthAdapter();
    }

    public function tearDown() {        
        $this->_clearAuth();
        parent::tearDown();
    }

    public function testIfNotLoggedUserGoesToIndex() {
        $this->dispatch('/user/');
        $this->assertAction('login');
    }

    public function testIfLoggedUserGoesToIndex() {

        // authenticate correct user
        $this->_authUser('test@test.com', 'kanako');

        $this->dispatch('/user/');
        $this->assertNotRedirectTo('/user/login');
    }

    public function testIfLoggedUserGoestToLogin() {
        // authenticate correct user
        $this->_authUser('test@test.com', 'test12');

        $this->dispatch('/user/login');
        $this->assertRedirectTo('/index/index');
    }

    public function testIfNotLoggedUserGoestToLogin() {

        $this->dispatch('/user/login');
        $this->assertController('user');
        $this->assertAction('login');
    }

    /**
     *
     * @dataProvider loginUserUsingHouseshareLoginSystemProvider
     */
    public function testLoginUserUsingHouseshareLoginSystem($data) {

        // login attempt
        $this->request->setMethod('POST')->setPost($data['user']);

        $this->dispatch('/user/login');

        // after login there should be zend_auth identity setuped or not
        $auth = Zend_Auth::getInstance();
        $this->assertEquals($data['expectedhasIdentity'], $auth->hasIdentity());

        if ($auth->hasIdentity()) {
            // after good login identity should be OK
            $this->assertEquals($data['expectedUserID'], $auth->getIdentity()->property->user_id);
        }
    }

    public function loginUserUsingHouseshareLoginSystemProvider() {

        $params = array();

        // for correct user
        $params [] = array(
            array(
                'user' => array('email' => 'user1@user.com', 'password' => 'test12'),
                'expectedhasIdentity' => true,
                'expectedUserID' => 3
            )
        );

        // for correct user
        $params [] = array(
            array(
                'user' => array('email' => 'test@test.com', 'password' => 'test12'),
                'expectedhasIdentity' => true,
                'expectedUserID' => 1
            )
        );


        // for INcorrect user
        $params [] = array(
            array(
                'user' => array('email' => 'tdest@test.com', 'password' => 'test12'),
                'expectedhasIdentity' => false,
            // expectedUserID not needed as getIdentity will be NULL;
            )
        );

        return $params;
    }

    public function testIfLoggedUserGoestToCreate() {
        // authenticate correct user
        $this->_authUser('test@test.com', 'test12');

        $this->dispatch('/user/create');
        $this->assertRedirectTo('/index/index');
    }

    public function testIfNotLoggedUserGoestToCreate() {

        $this->dispatch('/user/create');
        $this->assertNotRedirectTo('/index/index');
    }

    /**
     * Test successfull creation of uses account using Houseshare registration system
     *
     * @dataProvider registerUserUsingHouseshareRegSystemProvider
     */
    public function testRegisterUserUsingHouseshareRegSystem($postData, $expected) {

        $this->request->setMethod('POST')->setPost($postData);

        $this->dispatch('/user/create');

        // after successful creation there should be zend_auth identity setup
        $auth = Zend_Auth::getInstance();
        $this->assertEquals(true, $auth->hasIdentity());

        // new user should have next user_id in USER table
        $this->assertEquals($expected['user_id'], $auth->getIdentity()->property->user_id);

        // if everything is OK user should go to successAction
        $this->assertRedirectTo('/user/');
    }

    public function registerUserUsingHouseshareRegSystemProvider() {

        $params [] = array(
            array(
                'about_you' => array(
                    'first_name' => 'marcin',
                    'last_name' => 'wolski',
                    'last_name_public' => 0,
                    'phone_no' => '+234 234 243',
                    'phone_public' => 1,
                    'email' => 'marcin@test.com',
                    'email_public' => 1,
                    'password1' => 'haslo12',
                    'password2' => 'haslo12'
                ),
            ),
            array(// expected results               
                'user_id' => 4
            )
        );


        return $params;
    }

    /**
     * @dataProvider editUserInfoProvider
     */
    public function testEditUserInfo($user, $postData) {
        $this->_authUser($user['email'], $user['password']);

        $auth = Zend_Auth::getInstance();

        // logged OK
        $this->assertTrue($auth->hasIdentity());

        $this->request->setMethod('POST')->setPost($postData);
        $this->dispatch('/user/edit');
      

        // if everything is OK user should go to user/
        $this->assertRedirectTo('/user');

        // check if user data was changed
        $user_id = $auth->getIdentity()->property->user_id;
        $user = My_Houseshare_Factory::user($user_id);

        $this->assertEquals(
                array(
                     $postData['about_you']['phone_no'],
                     $postData['about_you']['email'],
                     $postData['about_you']['phone_public'],
                     $postData['about_you']['nickname']
                ), array(
                     $user->phone,
                     $user->email,
                     $user->phone_public,
                     $user->nickname
                
                )
        );
    }

    public function editUserInfoProvider() {
        return array(
            array(
                array(
                    'email' => 'test@test.com',
                    'password' => 'test12'
                ),
                array(
                    'about_you' => array(
                        'nickname' => 'marcin',
                        'phone_no' => '+234 234 243',
                        'phone_public' => 1,
                        'email' => 'marcin@test.com',
                        'email_public' => 1,
                    ),
                )
            ),
            array(
                array(
                    'email' => 'user1@user.com',
                    'password' => 'test12'
                ),
                array(
                    'about_you' => array(
                        'nickname' => 'marcin',
                        'phone_no' => '+234 234 243',
                        'phone_public' => 1,
                        'email' => 'marcin@test.com',
                        'email_public' => 0,
                    ),
                )
            )
        );
    }

    public function testIfLoggedUserGoesToSuccess() {
        // authenticate correct user
        $this->_authUser('test@test.com', 'test12');

        $this->dispatch('/user/');
       
        $this->assertAction('index');
    }

    public function testIfNotLoggedUserGoesToSuccess() {

        $this->dispatch('/user/success');
        $this->assertAction('login');
    }

    public function testLogout() {

        // authenticate correct user
        $this->_authUser('test@test.com', 'test12');

        $this->dispatch('/user/logout');

        $auth = Zend_Auth::getInstance();

        $this->assertEquals(false, $auth->hasIdentity());
    }

  
}

