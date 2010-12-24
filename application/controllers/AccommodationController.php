<?php

class AccommodationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
        // action body
    }

    public function addAction()
    {
        $cityID = $this->_request->getParam('city_id', null);

        if (!ctype_digit($cityID)) {
            throw new Zend_Exception('Provided value is not integer');
        }

        $addAccForm = new My_Form_Room();
        $addAccForm->setDefultCity($cityID);

        if ($this->getRequest()->isPost()) {
            if ($addAccForm->isValid($_POST)) {
                echo "Data is valid";
                Zend_Debug::dump($addAccForm->getValues());
            } else {
                echo "Data is NOT valid";
                Zend_Debug::dump($addAccForm->getValues());
            }

        }

        $this->view->form = $addAccForm;
    }

    public function deleteAction()
    {
        // action body
    }

    public function editAction()
    {
        // action body
    }


}









