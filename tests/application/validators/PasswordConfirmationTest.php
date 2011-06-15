<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * TestCase for PasswordConfirmationValidatorTest
 *
 * @author marcin
 */
class PasswordConfirmationValidatorTest extends ValidatorTestCase {
    
    private $_validator;

    public function setUp() {
        parent::setUp();
        $this->_validator = new My_Validate_PasswordConfirmation();
    }

    public function testCorrectPasswords() {
        $context = array('password2' => 'some_password');
        $output = $this->_validator->isValid('some_password',$context);
        $this->assertTrue($output);
    }

     public function testInCorrectPasswords() {
        $context = array('password2' => 'some_passworD');
        $output = $this->_validator->isValid('some_password',$context);
        $this->assertFalse($output);
    }

}
?>
