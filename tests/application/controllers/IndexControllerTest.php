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
            'rd_what_to_do' => '0',
            's_city' => '1'
        );

        $this->request->setMethod('POST')->setPost($search);
        $this->dispatch('/index/index');        
        $this->assertRedirectTo('/accommodation/list/city_id/1');
    }

    public function testRedirectToAccAdd() {
        $search = array(
            'rd_what_to_do' => '1',
            's_city' => '1'
        );

        $this->request->setMethod('POST')->setPost($search);
        $this->dispatch('/index/index');
        $this->assertRedirectTo('/accommodation/add/city_id/1');
    }

}

?>
