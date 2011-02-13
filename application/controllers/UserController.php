<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
         $auth = Zend_Auth::getInstance();

        if (!$auth->hasIdentity()) {
          //  $this->_helper->FlashMessenger('You ');
            return $this->_redirect('user/login');
        }
    }

    public function addAction() {
        // action body
    }

    public function editAction() {
        // action body
    }

    public function createAction() {

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $this->_helper->FlashMessenger('It seems you are already logged into the system ');
            return $this->_redirect('index');
        }

        $createForm = new My_Form_UserCreate();

        if ($this->getRequest()->isPost()) {
            if ($createForm->isValid($_POST)) {

                $formData = $createForm->getValues();

                // Create a user
                $newUser = My_Houseshare_Factory::user();

                $newUser->first_name = $formData['about_you']['first_name'];
                $newUser->last_name = $formData['about_you']['last_name'];
                $newUser->last_name_public = $formData['about_you']['last_name_public'];
                $newUser->email = $formData['about_you']['email'];
                $newUser->password = md5($formData['about_you']['password1']);
                $newUser->phone = $formData['about_you']['phone_no'];
                $newUser->phone_public = $formData['about_you']['phone_public'];
                $newUser->type = 'USER';

                $user_id = $newUser->save();

                if (is_numeric($user_id)) {

                    // immidiately authenticate the new user,
                    // so that he is logged in to the system.

                    $authAdapter = new My_Auth_Adapter_DbTable();
                    $authAdapter->setIdentity($formData['about_you']['email']);
                    $authAdapter->setCredential($formData['about_you']['password1']);

                    $auth = Zend_Auth::getInstance();
                    $result = $auth->authenticate($authAdapter);

                    if ($result->isValid()) {
                        $userData = $authAdapter->getResultRowObject(null, 'password');
                        $auth->getStorage()->write($userData);
                        return $this->_redirect('user/success');
                    }
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
            return $this->_redirect('index');
        }

        $user_id = (int) $auth->getIdentity()->user_id;

        if (null !== $user_id) {
            $user = My_Houseshare_Factory::user($user_id);
        }

        $this->view->user = $user;
    }

    public function logoutAction() {
        $authAdapter = Zend_Auth::getInstance();
        $authAdapter->clearIdentity();
    }

    public function loginAction() {

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $this->_helper->FlashMessenger('It seems you are already logged into the system ');
            return $this->_redirect('index');
        }

        $loginForm = new My_Form_Login();
        
        $this->view->failedLoginAttempt = false;

        if ($this->getRequest()->isPost()) {
            if ($loginForm->isValid($_POST)) {

                $formData = $loginForm->getValues();

                $authAdapter = new My_Auth_Adapter_DbTable();
                $authAdapter->setIdentity($formData['email']);
                $authAdapter->setCredential($formData['password']);

                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $userData = $authAdapter->getResultRowObject(null, 'password');
                    $auth->getStorage()->write($userData);
                    return $this->_redirect('user/index');
                }

                 // normally, if everything went OK, user should be already
                // redirected.
               $this->view->failedLoginAttempt = true;
                
            }
        }

        $this->view->form = $loginForm;
    }

}

