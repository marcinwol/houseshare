<?php

class AccommodationController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function listAction() {
        // action body
    }

    public function addAction() {

        $city = $this->_request->getParam('city', null);
        @list($cityName, $stateName) = explode(', ', $city);

        $addAccForm = new My_Form_Accommodation();
        $addAccForm->setDefaultCity($cityName);
        $addAccForm->setDefaultState($stateName);



        $addressModel = new My_Houseshare_Address();
        $addressModel->unit_no = "12";
        $addressModel->street_no = '13A';
        $addressModel->street = "Nowa ulica";
        $addressModel->city = "Nowe miasto";
        $addressModel->zip = "34-455";
        $addressModel->state = "Mazowieckie";
        $addressModel->save();
        //  var_dump($addressModel->city);


        if ($this->getRequest()->isPost()) {
            if ($addAccForm->isValid($_POST)) {

                echo "Data is valid";
                $formData = $addAccForm->getValues();
                var_dump($formData['address']['state']);

                Zend_Debug::dump($addAccForm->getValues());
            } else {
                echo "Data is NOT valid";
                Zend_Debug::dump($addAccForm->getValues());
            }
        }

        $this->view->form = $addAccForm;
    }

    public function deleteAction() {
        // action body
    }

    public function editAction() {
        // action body
    }

}

