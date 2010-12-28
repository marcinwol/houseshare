<?php


class UserControllerTest extends ControllerTestCase
{

    public function testIndexAction() {
        $this->dispatch('/user/');
        $this->assertController('user');
        $this->assertAction('index');
    }


}

