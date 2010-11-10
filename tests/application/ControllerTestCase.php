<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('Zend/Application.php');

require_once('Zend/Test/PHPUnit/ControllerTestCase.php');

/**
 * Description of ControllerTestCase
 *
 * @author marcin
 */
class ControllerTestCase extends Zend_Test_PHPUnit_ControllerTestCase {

    //put your code here

    public $application;

    public function setUp() {

 
        $this->application = new Zend_Application(
                        APPLICATION_ENV,
                        APPLICATION_PATH . '/configs/application.ini'
        );


        $this->bootstrap = array($this, 'appBootstrap');
        parent::setUp();
    }

    public function tearDown() {
        Zend_Controller_Front::getInstance()->resetInstance();
        $this->resetRequest();
        $this->resetResponse();

        $this->request->setPost(array());
        $this->request->setQuery(array());
    }

    public function appBootstrap() {
        $this->application->bootstrap();
    }

    //put your code here
}

?>
