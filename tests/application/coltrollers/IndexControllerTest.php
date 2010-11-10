<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexControllerTest
 *
 * @author marcin
 */
class IndexControllerTest extends ControllerTestCase {


    public function testIndexAction() {
        $this->dispatch('/');
        $this->assertController('index');
        $this->assertAction('index');         
    }


    public function testErrorURL() {
        $this->dispatch('/foo');        
        $this->assertController('error');
        $this->assertAction('error');        
    }

}

?>
