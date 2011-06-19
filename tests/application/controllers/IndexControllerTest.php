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
        
       
        // construct url using route
        $urlParams = array('city' => 3, 'cityname' => 'Wroclaw', 'maxprice' => 1000);
        $router = $this->getFrontController()->getRouter();
        $url    = $router->assemble($urlParams, 'listacc');
                      
        $this->assertRedirectTo($url);        
    }

   
}

?>
