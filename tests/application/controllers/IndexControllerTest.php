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

    public function testRedirectToAccList() {
        $search = array(        
            'i_city' => '3',
            'maxprice' => '1000'
        );

        $this->request->setMethod('POST')->setPost($search);
        $this->dispatch('/index/index');       
        
        var_dump($this->getResponse()->getBody());
        
        $this->assertRedirectTo('/list/city/3/maxprice/1000');
    }

   
}

?>
