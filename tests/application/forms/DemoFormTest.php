<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * TestCase for MinMaxAgeValidatorTest
 *
 * @author marcin
 */
class DemoFormTest extends FormTestCase {

    public function setUp() {
        parent::setUp();
        $this->_form = new My_Form_Demo();
    }

    public function testCorrectData() {
        $mockInputData = array(
            'username' => 'somename',
            'password' => 'somepass',
            'submit' => 'LOG_INTO'
        );

        $this->assertTrue($this->_form->isValid($mockInputData));
    }
    
     public function testInCorrectData() {
        $mockInputData = array(
            'username' => 'somename',   
            // password not given
            'submit' => 'LOG_INTO'
        );

        $this->assertFalse($this->_form->isValid($mockInputData));
    }
    
    // some other tests
}

?>
