<?php

class AccommodationControllerTest extends ControllerTestCase {

    public function testIndexAction() {
        $this->dispatch('/accommodation/');
        $this->assertController('accommodation');
        $this->assertAction('index');
    }

}

