<?php

class UserController extends Zend_Controller_Action {

    /**
     * Application keys from appkeys.ini
     *
     * @var Zend_Config
     */
    protected $_keys;

    public function init() {

        $this->_keys = Zend_Registry::get('keys');
    }

    public function indexAction() {

        // don't need this session namespace here
        Zend_Session::namespaceUnset('addAccInfo');

        $auth = Zend_Auth::getInstance();

        $authData = $auth->getIdentity();

        $user_id = $authData->property->user_id;
        $userType = $authData->property->type;

        /* @var $user  My_Houseshare_User  */
        $user = My_Houseshare_Factory::user($user_id, $userType);


        /* set page for navigatoin */
        /* @var $navigation Zend_Navigation */
        $navigation = $this->view->navigation()->getContainer();
        /* @var $accshowPage My_Navigation_Page_AccShow */
        $userindexPage = $navigation->findBy('Name', 'userindex');
        $userindexPage->setUser($user);

        $accsRowset = $user->getAccommodations();

        $this->view->user = $user->toArray();
        $this->view->accs = count($accsRowset) > 0 ? $accsRowset->toModels() : null;
    }

    public function addAction() {
        // action body
    }

    public function createAction() {

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $this->_helper->FlashMessenger('It seems you are already logged into the system ');
            return $this->_redirect('/index/index');
        }

        $createForm = new My_Form_UserCreate();
        $createForm->makeDisplayGroups()->removeLegend();


        if ($this->getRequest()->isPost()) {

            if (true == isset($_POST['cancel'])) {
                return $this->_redirect('/user');
            }

            if ($createForm->isValid($_POST)) {

                $formData = $createForm->getValues();



                // check if we already have such an email in a database
                // as user could have forgot that he already has
                // an accound with us
                $email = $formData['about_you']['email'];
                $user = My_Model_Table_User::fetchUsingEmail($email);
                if (null !== $user) {
                    $tmpSession = new Zend_Session_Namespace('toStore');
                    $tmpSession->user = $user;
                    return $this->_redirect('user/double-email');
                }


                // Create a user
                $newUser = My_Houseshare_Factory::user();

                $newUser->nickname = $formData['about_you']['nickname'];
                $newUser->email = $formData['about_you']['email'];
                $newUser->email_public = $formData['about_you']['email_public'];
                $newUser->password = $formData['about_you']['password1'];
                $newUser->phone = $formData['about_you']['phone_no'];
                $newUser->phone_public = $formData['about_you']['phone_public'];
                $newUser->description = $formData['about_you']['description'];
                $newUser->type = 'USER';

                $user_id = $newUser->save();

                if (is_numeric($user_id)) {

                    // immidiately authenticate the new user,
                    // so that he is logged in to the system.

                    $this->_writeAuthData($newUser, true);
                    #Zend_Session::rememberMe();

                    $this->_helper->FlashMessenger('Welcom to sharehouse');
                    return $this->_redirect('user/');
                }

                // normally, if everything went OK, user should be already 
                // redirected tu sussess.
                $this->_helper->FlashMessenger(
                        'There was a problem during account creating and or authentication'
                );
                return $this->_redirect('index');
            }
        }

        $this->view->form = $createForm;
    }

    public function successAction() {

        $auth = Zend_Auth::getInstance();

        if (!$auth->hasIdentity()) {
            $this->_helper->FlashMessenger('Cannot retrive user creation info from session');
            return $this->_redirect('/');
        }

        $authData = $auth->getIdentity();

        // if users is NOT the first time here, than redirect him.
        if (!isset($authData->just_created) || false == $authData->just_created) {
            return $this->_redirect('/');
        }


        // mark that already user visited the success action.
        $authData->just_created = false;
        $auth->getStorage()->write($authData);

        // get just regisered user id
        $user_id = (int) $authData->property->user_id;

        if (null !== $user_id) {
            $user = My_Houseshare_Factory::user($user_id);
        }

        $this->view->user = $user;
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_helper->FlashMessenger('You were logged out');
        return $this->_redirect('/');
    }

    public function loginAction() {


        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $this->_helper->FlashMessenger('It seems you are already logged into the system ');
            return $this->_redirect('/');
        }

        // if the user is not logged, the do the logging
        // $openid_identifier will be set when users 'clicks' on the account provider
        $openid_identifier = $this->getRequest()->getParam('openid_identifier', null);

        // $openid_mode will be set after first query to the openid provider
        $openid_mode = $this->getRequest()->getParam('openid_mode', null);

        // this one will be set by facebook connect
        $code = $this->getRequest()->getParam('code', null);

        // while this one will be set by twitter
        $oauth_token = $this->getRequest()->getParam('oauth_token', null);


        // do the first query to the openid provider
        if ($openid_identifier) {

            if ('https://www.twitter.com' == $openid_identifier) {
                $adapter = $this->_getTwitterAdapter();
            } else if ('https://www.facebook.com' == $openid_identifier) {
                $adapter = $this->_getFacebookAdapter();
            } else {
                // for openid
                $adapter = $this->_getOpenIdAdapter($openid_identifier);

                // specify what to grab from the provider and what extension to use
                // for this purpose
                $toFetch = $this->_keys->openid->tofetch->toArray();

                // for google and yahoo use AtributeExchange Extension
                if ('https://www.google.com/accounts/o8/id' == $openid_identifier || 'http://me.yahoo.com/' == $openid_identifier) {
                    $ext = $this->_getOpenIdExt('ax', $toFetch);
                } else {
                    $ext = $this->_getOpenIdExt('sreg', $toFetch);
                }

                $adapter->setExtensions($ext);
            }

            // save $openid_identifier in a 10 minute cookie that will be writen
            // when we return from the auth provider.                        
            if (!setcookie('auth_identifier', $openid_identifier, time() + 600)) {
                throw new Zend_Auth_Exception('A cookie with an idnetfier cound not be set');
            }

            // here a user is redirect to the provider for loging
            $result = $auth->authenticate($adapter);

            // the following two lines should never be executed unless the redirection faild.
            $this->_helper->FlashMessenger('Redirection faild');
            return $this->_redirect('/');
        } else if ($openid_mode || $code || $oauth_token) {
            // this will be exectued after provider redirected the user back to us
            //echo serialize($_GET);return;
            // retrive the auth idnetifier provider name from cookie set above
            $auth_provider = 'Unknown';
            if (isset($_COOKIE['auth_identifier'])) {
                $auth_provider = My_Model_Table_AuthProvider::getProvider($_COOKIE['auth_identifier']);
                // remove the cookie as we do not need it now
                setcookie("auth_identifier", "", time() - 3600);
            }


            if ($code) {
                // for facebook
                $adapter = $this->_getFacebookAdapter();
            } else if ($oauth_token) {
                // for twitter
                $adapter = $this->_getTwitterAdapter()->setQueryData($_GET);
            } else {
                // for openid
                $adapter = $this->_getOpenIdAdapter(null);

                // specify what to grab from the provider and what extension to use
                // for this purpose
                $ext = null;

                $toFetch = $this->_keys->openid->tofetch->toArray();

                // for google and yahoo use AtributeExchange Extension
                if (isset($_GET['openid_ns_ext1']) || isset($_GET['openid_ns_ax'])) {
                    $ext = $this->_getOpenIdExt('ax', $toFetch);
                } else if (isset($_GET['openid_ns_sreg'])) {
                    $ext = $this->_getOpenIdExt('sreg', $toFetch);
                }

                if ($ext) {
                    $ext->parseResponse($_GET);
                    $adapter->setExtensions($ext);
                }
            }


            $result = $auth->authenticate($adapter);

            if ($result->isValid()) {

                // make an stdObj to sture user info fetched
                $toStore = (object) array('identity' => $auth->getIdentity());


                if (isset($ext)) {
                    // for openId
                    $toStore->property = (object) $ext->getProperties();
                } else if ($code) {
                    // for facebook
                    $msgs = $result->getMessages();
                    $toStore->property = $msgs['user'];
                } else if ($oauth_token) {
                    // for twitter
                    $identity = $result->getIdentity();
                    // get user info
                    $twitterUserData = $adapter->verifyCredentials();

                    $toStore = (object) array('identity' => $identity['user_id']);
                    $toStore->property = $twitterUserData;
                }

                // save the providers name. Useful in account recovery.
                $toStore->provider = $auth_provider;

                // set temprorary default privilage 
                $toStore->property->privilage = 'BASIC';

                // create this auth as soon a proper one should be created
                $auth->clearIdentity();

                //  $auth->getStorage()->write($toStore);
                // query our database to check if a user already exists
                // or if the user is a new one.                                                                                
                $row = My_Model_Table_AuthProvider::fetchUsingKey($toStore->identity);

                if (null === $row) {
                    // no user key found in db, so it is a new user.                    
                    // For this reason go to registration completion page.
                    // But first check the email.
                    // 
                    // UPDATE 04 Jun 2011: 
                    // There is no reason to go to completion page.
                    // just create an account at this stage
                    // with just an email                    


                    $tmpSession = new Zend_Session_Namespace('toStore');
                    $tmpSession->toStore = $toStore;

                    if (isset($toStore->property->email)) {
                        // check if we already have such an email in a database
                        // as user could have forgot that he already has
                        // an accound with us
                        $email = $toStore->property->email;
                        $user = My_Model_Table_User::fetchUsingEmail($email);
                        if (null !== $user) {
                            $tmpSession->user = $user;
                            return $this->_redirect('user/double-email');
                        }
                    }

                    //verify that we have email of a correct formagt!
                    $email = $toStore->property->email;
                    $emailValidator = new Zend_Validate_EmailAddress();

                    if (!$emailValidator->isValid($email)) {
                        //Zend_Session::namespaceUnset('toStore');
                        $this->_helper->FlashMessenger(
                                'Incorret email (or no email) was returned form OpenID provider'
                        );
                        return $this->_redirect('/user/complete');
                        //return $this->_redirect('/');
                    }

                    // email is OK, so try to create a user
                    $newUser = My_Houseshare_Factory::user();

                    $newUser->nickname = '';
                    $newUser->email = $email;
                    $newUser->phone = '';
                    $newUser->phone_public = 0;
                    $newUser->email_public = 0;
                    $newUser->description = '';
                    $newUser->type = 'USER';

                    $user_id = $newUser->save();

                    if (is_numeric($user_id)) {

                        // if user was saved than save his providers info                    
                        $authProvModel = new My_Model_Table_AuthProvider();
                        $newRow = $authProvModel->createRow(
                                        array(
                                            'key' => $toStore->identity,
                                            'provider_type' => $toStore->provider,
                                            'user_id' => $user_id
                                        )
                        );

                        $newId = $newRow->save();


                        // immidiately authenticate the new user,
                        // so that he is logged in to the system.                                           
                        $this->_writeAuthData($newUser, true);

                        // don't need this session namespace anymore
                        Zend_Session::namespaceUnset('toStore');

                        $this->_helper->FlashMessenger('Welcom to ShareHouse');
                        return $this->_redirect('user/');
                    }

                    // normally, if everything went OK, user should be already 
                    // redirected tu sussess.
                    $this->_helper->FlashMessenger(
                            'There was a problem during account creating and or authentication'
                    );
                    return $this->_redirect('index');


                    #return $this->_redirect('/user/complete');
                } else {
                    // key was found in database so read a user record
                    // and authenticate this user
                    $user_id = $row->getUser()->user_id;
                    $userType = $authData->property->type;
                    $user = My_Houseshare_Factory::user($user_id, $userType);

                    // immidiately authenticate the new user,                    
                    $this->_writeAuthData($user);
                    #Zend_Session::rememberMe();
                    return $this->_redirect('user/index');
                }

                return $this->_redirect('/user/index');
            } else {
                //$this->_helper->FlashMessenger('Failed authentication');
                $this->_helper->FlashMessenger($result->getMessages());
                return $this->_redirect('/');
            }
        }

        // this is for normal authentication

        $loginForm = new My_Form_Login();

        $this->view->failedLoginAttempt = false;

        if ($this->getRequest()->isPost() && null == $openid_identifier) {
            if ($loginForm->isValid($_POST)) {

                $formData = $loginForm->getValues();

                $authAdapter = new My_Auth_Adapter_DbTable();
                $authAdapter->setIdentity($formData['email']);
                $authAdapter->setCredential($formData['password']);


                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {

                    $userData = $authAdapter->getResultRowObject(null, 'password');

                    $user_id = $userData->user_id;
                    $userType = $userData->type;
                    $user = My_Houseshare_Factory::user($user_id, $userType);

                    // immidiately authenticate the new user,
                    // so that he is logged in to the system.                                           
                    $this->_writeAuthData($user);
                    #Zend_Session::rememberMe();
                    return $this->_redirect('user/');
                }

                // normally, if everything went OK, user should be already
                // redirected.
                $this->view->failedLoginAttempt = true;
            }
        }

        $this->view->form = $loginForm;
    }

    public function editAction() {

        $auth = Zend_Auth::getInstance();

        $authData = $auth->getIdentity();

        if (null === $authData) {
            $this->_helper->FlashMessenger('You were logged out. Please login.');
            return $this->_redirect('/');
        }

        $user_id = $authData->property->user_id;
        $userType = $authData->property->type;

        $user = My_Houseshare_Factory::user($user_id, $userType);


        /* set page for navigatoin */
        /* @var $navigation Zend_Navigation */
        $navigation = $this->view->navigation()->getContainer();
        /* @var $accshowPage My_Navigation_Page_AccShow */
        $userindexPage = $navigation->findBy('Name', 'useredit');
        $userindexPage->setUser($user);


        $userForm = new My_Form_UserCreate();
        $userForm->removePasswordFields();


        if ($this->getRequest()->isPost()) {

            if (true == isset($_POST['cancel'])) {
                return $this->_redirect('/user');
            }

            if ($userForm->isValid($_POST)) {

                $formData = $userForm->getValues();

                $user->nickname = $formData['about_you']['nickname'];
                $user->email = $formData['about_you']['email'];
                $user->email_public = $formData['about_you']['email_public'];
                $user->description = $formData['about_you']['description'];
                $user->phone = $formData['about_you']['phone_no'];
                $user->phone_public = $formData['about_you']['phone_public'];

                $id = $user->save();

                if ($id !== $user_id) {
                    throw new Zend_Db_Exception("User id $user_id and retun value from update ($id) don't match");
                }

                $authData->property->nickname = $formData['about_you']['nickname'];

                $this->_helper->FlashMessenger('Your data was changed');
                return $this->_redirect('/user');
            }
        } else {

            // populate form with user data
            $userData = $user->toArray();

            // phone input field name is different than in $user
            $userData['phone_no'] = $user->phone;
            $userForm->populate(array('about_you' => $userData));
        }

        $userForm->getElement('Submit')->setLabel('Update');
        $this->view->form = $userForm;
    }

    public function completeAction() {


        $tmpSession = new Zend_Session_Namespace('toStore');
        $authData = $tmpSession->toStore;

        if (null === $authData) {
            $this->_helper->FlashMessenger('Cannot retrive authentication data');
            return $this->_redirect('/index/index');
        }


        $createForm = new My_Form_UserCreate();
        $createForm->removePasswordFields();
        $createForm->makeDisplayGroups()->removeLegend();
        //$createForm->removeElement('cancel');
        //$createForm->cancel->setLabel('Cancel');
        // pupulate with email grabbed from the provieder
        if (isset($authData->property->email)) {
            $createForm->populate(
                    array('email' => $authData->property->email)
            );
        } 

        if ($this->getRequest()->isPost()) {

            if (true == isset($_POST['cancel'])) {
                // don't need this session namespace anymore
                Zend_Session::namespaceUnset('toStore');
                return $this->_redirect('/login');
            }

            if ($createForm->isValid($_POST)) {

                $formData = $createForm->getValues();

                // Create a user
                $newUser = My_Houseshare_Factory::user();

                $newUser->nickname = $formData['about_you']['nickname'];
                $newUser->email = $formData['about_you']['email'];
                $newUser->phone = $formData['about_you']['phone_no'];
                $newUser->phone_public = $formData['about_you']['phone_public'];
                $newUser->email_public = $formData['about_you']['email_public'];
                $newUser->description = $formData['about_you']['description'];
                $newUser->type = 'USER';

                $user_id = $newUser->save();

                if (is_numeric($user_id)) {

                    // if user was saved than save his providers info                    
                    $authProvModel = new My_Model_Table_AuthProvider();
                    $newRow = $authProvModel->createRow(
                                    array(
                                        'key' => $authData->identity,
                                        'provider_type' => $authData->provider,
                                        'user_id' => $user_id
                                    )
                    );

                    $newId = $newRow->save();


                    // immidiately authenticate the new user,
                    // so that he is logged in to the system.                                           
                    $this->_writeAuthData($newUser, true);

                    // don't need this session namespace anymore
                    Zend_Session::namespaceUnset('toStore');

                    $this->_helper->FlashMessenger('Welcom to ShareHouse');
                    return $this->_redirect('user/');
                }

                // normally, if everything went OK, user should be already 
                // redirected tu sussess.
                $this->_helper->FlashMessenger(
                        'There was a problem during account creating and or authentication'
                );
                return $this->_redirect('index');
            }
        }
        $createForm->getElement('Submit')->setLabel('Save');
        $this->view->form = $createForm;
    }

    public function doubleEmailAction() {

        $tmpSession = new Zend_Session_Namespace('toStore');

        /* @var $user My_Model_Table_Row_User  */
        $user = $tmpSession->user;


        if (null === $user) {
            $this->_helper->FlashMessenger('Cannot retrive user data');
            return $this->_redirect('/');
        }

        $user->setTable(new My_Model_Table_User());

        $authProvider = $user->getAuthProvider();


        $this->view->user = (object) $user->toArray();

        if (null !== $authProvider) {
            $this->view->authProvider = (object) $authProvider->toArray();
        }


        // don't need this session namespace anymore
        Zend_Session::namespaceUnset('toStore');
    }

    public function accountRecoveryAction() {


        $emailForm = new My_Form_Email();

        if ($this->getRequest()->isPost()) {


            if (true == isset($_POST['cancel'])) {
                return $this->_redirect('/login');
            }

            if ($emailForm->isValid($_POST)) {

                $email = $emailForm->getValue('email');

                $userModel = new My_Model_Table_User();

                $user = $userModel->findByEmail($email);

                if (null === $user) {
                    $emailForm->setErrorMessages(array('Unfortunately, there is no such email in our database'));
                } else {

                    $emailObj = new My_Mail_AccRecovery();
                    $emailObj->setFrom('mwol@born2die.eu');
                    $emailObj->addTo($email);
                    $emailObj->setBodyText('Body of recovery email for ' . $email);

                    try {
                        $emailObj->send();
                    } catch (Zend_Mail_Exception $e) {
                        $this->_helper->FlashMessenger('There was a problem sending an email: ' . $e->getMessage());
                        return $this->_redirect('/');
                    }

                    $this->_helper->FlashMessenger('A account recovery email was sent');
                    return $this->_redirect('/');
                }
            }
        }
        $this->view->form = $emailForm;
    }

    /**
     * Get My_Auth_Adapter_Facebook adapter
     *
     * @return My_Auth_Adapter_Facebook
     */
    protected function _getFacebookAdapter() {
        extract($this->_keys->facebook->toArray());
        return new My_Auth_Adapter_Facebook($appid, $secret, $redirecturi, $scope);
    }

    /**
     * Get My_Auth_Adapter_Oauth_Twitter adapter
     *
     * @return My_Auth_Adapter_Oauth_Twitter
     */
    protected function _getTwitterAdapter() {
        extract($this->_keys->twitter->toArray());
        return new My_Auth_Adapter_Oauth_Twitter(array(), $appid, $secret, $redirecturi);
    }

    /**
     * Get Zend_Auth_Adapter_OpenId adapter
     *
     * @param string $openid_identifier
     * @return Zend_Auth_Adapter_OpenId
     */
    protected function _getOpenIdAdapter($openid_identifier = null) {
        $adapter = new Zend_Auth_Adapter_OpenId($openid_identifier);
        $dir = APPLICATION_PATH . '/../tmp';

        if (!file_exists($dir)) {
            if (!mkdir($dir)) {
                throw new Zend_Exception("Cannot create $dir to store tmp auth data.");
            }
        }

        $adapter->setStorage(new Zend_OpenId_Consumer_Storage_File($dir));

        return $adapter;
    }

    /**
     * Get Zend_OpenId_Extension. Sreg or Ax.
     *
     * @param string $extType Possible values: 'sreg' or 'ax'
     * @param array $propertiesToRequest
     * @return Zend_OpenId_Extension|null
     */
    protected function _getOpenIdExt($extType, array $propertiesToRequest) {

        $ext = null;

        if ('ax' == $extType) {
            $ext = new My_OpenId_Extension_AttributeExchange($propertiesToRequest);
        } elseif ('sreg' == $extType) {
            $ext = new Zend_OpenId_Extension_Sreg($propertiesToRequest);
        }

        return $ext;
    }

    protected function _writeAuthData(My_Houseshare_User $user, $justCreate = false) {
        $auth = Zend_Auth::getInstance();
        $toStore = (object) array('identity' => $user->user_id);
        $toStore->property = (object) $user->toArray();
        $toStore->just_created = $justCreate;
        $auth->getStorage()->write($toStore);
    }

}