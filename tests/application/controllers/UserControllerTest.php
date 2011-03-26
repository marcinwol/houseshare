<?php

class UserControllerTest extends ControllerTestCase {
    const ID = "http://marcinwol.myopenid.com/";
    const REAL_ID = "http://marcinwol.myopenid.com/";
    const SERVER = "http://www.myopenid.com/server";
    const VERSION = 2;

    const HANDLE = "{HMAC-SHA256}{4d79af72}{qRY/cA==}";
    const MAC_FUNC = "sha256";
    const SECRET = "\x83\x82\xae\xa9\x22\x56\x0e\xce\x83\x3b\xa5\x5f\xa5\x3b\x7a\x97\x5f\x59\x73\x70";

    public function setUp() {

        parent::setUp();
        $this->_setupAuthAdapter();
    }

    public function tearDown() {
        parent::tearDown();
        $this->_clearAuth();
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
        $this->assertRedirectTo('/user/success');
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
                     $postData['about_you']['last_name_public'],
                     $postData['about_you']['phone_public'],
                     $postData['about_you']['first_name'],
                     $postData['about_you']['last_name']
                ), array(
                     $user->phone,
                     $user->email,
                     $user->last_name_public,
                     $user->phone_public,
                     $user->first_name,
                     $user->last_name
                
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
                        'first_name' => 'marcin',
                        'last_name' => 'wolski',
                        'last_name_public' => 0,
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
                        'first_name' => 'marcin',
                        'last_name' => 'wolski',
                        'last_name_public' => 0,
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

        $this->dispatch('/user/success');

        $this->assertRedirectTo('/');
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

    public function tesstSuccessfulGoogleLogin() {

        $expiresIn = time() + 600;
        $storage = new Zend_OpenId_Consumer_Storage_File(dirname(__FILE__) . "/_tmp");
        $storage->delDiscoveryInfo(self::ID);
        $storage->addDiscoveryInfo(self::ID, self::REAL_ID, self::SERVER, 2, $expiresIn);
        $storage->delAssociation(self::SERVER);
        $storage->addAssociation(self::SERVER, self::HANDLE, self::MAC_FUNC, self::SECRET, $expiresIn);

        Zend_OpenId::$exitOnRedirect = false;

        $response = new Zend_OpenId_ResponseHelper(true);

        $_SERVER['SCRIPT_URI'] = "http://www.zf-test.com/test.php";

        $adapter = new Zend_Auth_Adapter_OpenId(self::ID, $storage);
        $adapter->setResponse($response);

        var_dump('asdfasfd');

        $ret = $adapter->authenticate();
        $this->assertTrue(is_null($ret));

        $headers = $response->getHeaders();
        var_dump($headers);
    }

    public function tessstSuccessfulGoogleLogin() {

        Zend_OpenId::$exitOnRedirect = false;

        $_GET = array(
            'action' => 'verify',
            'openid_username' => 'marcinwol',
            'openid_identifier' => 'http://marcinwol.myopenid.com/'
        );
        $_SERVER['SCRIPT_URI'] = "http://www.zf-test.com/test.php";

        $this->dispatch('/user/login');
        //var_dump($this->getResponse()->getBody());
        // return;
        $this->resetRequest()->resetResponse();

        $this->_mockMyOpenIdAuthResponce();

        $this->dispatch('/user/login');

        //   $response = new Zend_OpenId_ResponseHelper(true);

        var_dump(Zend_Auth::getInstance()->getIdentity());

        var_dump($this->getResponse()->getBody());
    }

    protected function _mockGoogleAuthResponce($success = true) {
        $_GET = unserialize('a:14:{s:9:"openid_ns";s:32:"http://specs.openid.net/auth/2.0";s:11:"openid_mode";s:6:"id_res";s:18:"openid_op_endpoint";s:37:"https://www.google.com/accounts/o8/ud";s:21:"openid_response_nonce";s:34:"2011-03-10T06:21:40ZHovyGLBvMgNTug";s:16:"openid_return_to";s:49:"http://localhost.com/houseshare/public/user/login";s:19:"openid_assoc_handle";s:72:"AOQobUfYZ9P52Tv4hvtmUraGKN-zoNMEGADWtjG2qwfwGXd8kMgS0pls0T7iCQ85BJ2EuvXC";s:13:"openid_signed";s:120:"op_endpoint,claimed_id,identity,return_to,response_nonce,assoc_handle,ns.ext1,ext1.mode,ext1.type.email,ext1.value.email";s:10:"openid_sig";s:44:"MGESVtEwsP7jlOaYYnxb6V4rlJmEORq/dMVgRQdpeNA=";s:15:"openid_identity";s:80:"https://www.google.com/accounts/o8/id?id=AItOawnOWJEgpUUA8geIY8JRWuyIaWz-1FqkjTI";s:17:"openid_claimed_id";s:80:"https://www.google.com/accounts/o8/id?id=AItOawnOWJEgpUUA8geIY8JRWuyIaWz-1FqkjTI";s:14:"openid_ns_ext1";s:28:"http://openid.net/srv/ax/1.0";s:16:"openid_ext1_mode";s:14:"fetch_response";s:22:"openid_ext1_type_email";s:33:"http://axschema.org/contact/email";s:23:"openid_ext1_value_email";s:19:"marcinwol@gmail.com";}');
    }

    protected function _mockMyOpenIdAuthResponce($success = true) {
        $_GET = unserialize('a:12:{s:19:"openid_assoc_handle";s:33:"{HMAC-SHA256}{4d79aa61}{h+tYVQ==}";s:17:"openid_claimed_id";s:30:"http://marcinwol.myopenid.com/";s:15:"openid_identity";s:30:"http://marcinwol.myopenid.com/";s:11:"openid_mode";s:6:"id_res";s:9:"openid_ns";s:32:"http://specs.openid.net/auth/2.0";s:14:"openid_ns_sreg";s:37:"http://openid.net/extensions/sreg/1.1";s:18:"openid_op_endpoint";s:30:"http://www.myopenid.com/server";s:21:"openid_response_nonce";s:26:"2011-03-11T04:51:52ZmS2y0q";s:16:"openid_return_to";s:49:"http://localhost.com/houseshare/public/user/login";s:10:"openid_sig";s:44:"u93gLn2fSG0egY4tJ7N6R7VYvs8zgk0ZIbeyfMJVUPM=";s:13:"openid_signed";s:103:"assoc_handle,claimed_id,identity,mode,ns,ns.sreg,op_endpoint,response_nonce,return_to,signed,sreg.email";s:17:"openid_sreg_email";s:14:"wolskint@o2.pl";}');
    }

}

require_once APPLICATION_PATH . '/../library/Zend/Controller/Response/Abstract.php';

class Zend_OpenId_ResponseHelper extends Zend_Controller_Response_Abstract {

    private $_canSendHeaders;

    public function __construct($canSendHeaders) {
        $this->_canSendHeaders = $canSendHeaders;
    }

    public function canSendHeaders($throw = false) {
        return $this->_canSendHeaders;
    }

    public function sendResponse() {
        
    }

}