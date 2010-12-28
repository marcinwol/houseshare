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
class MinMaxAgeValidatorTest extends ValidatorTestCase {
    
    private $_validator;

    public function setUp() {
        parent::setUp();
        $this->_validator = new My_Validate_MinMaxAge();
    }

    public function testCorrectMinAndMaxAgeValues() {
        $context = array('min_age_of_roomates' => '20');
        $output = $this->_validator->isValid('30',$context);
        $this->assertTrue($output);
    }

     public function testInCorrectMinAndMaxAgeValues() {
        $context = array('min_age_of_roomates' => '20');
        $output = $this->_validator->isValid('10',$context);
        $this->assertFalse($output);
    }

}
?>
