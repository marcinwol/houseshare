<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function addAction() {
        // action body
    }

    public function editAction() {
        // action body
    }
    public function createAction() {
        // action body
    }

    public function loginAction() {
        $loginForm = new My_Form_Login();


        if ($this->getRequest()->isPost()) {
            if ($loginForm->isValid($_POST)) {

                var_dump($loginForm->getValues());

            }
        }

        $this->view->form = $loginForm;
    }

    public function logoutAction() {
        // action body
    }

}

