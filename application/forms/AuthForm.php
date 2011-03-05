<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class My_Form_AuthForm extends Zend_Form {

    public function __construct($options = null) {
        parent::__construct($options);
        $this->setName('login');

        $username = new Zend_Form_Element_Text('username', 'username');
        $username->setLabel('Username:')
                ->setRequired(true)
                ->setOptions(array('class' => 'longfield'));

        $password = new Zend_Form_Element_Text('password', 'password');
        $password->setLabel('Password: *')
                ->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit', 'submit');
        $submit->setLabel('Login');

        $this->addElements(array($username, $password, $submit));
    }

}

?>
