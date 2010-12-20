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
        $addAccForm = new My_Form_Room();
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









