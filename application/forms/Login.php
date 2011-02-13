<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MainPageForm
 *
 * This is the form on the main page that is used for selecting searching
 * accomodation or indicating that you have an accomodation to share.
 *
 * @author marcin
 */
class My_Form_Login extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        //create new element
        $uname = $this->createElement('text', 'username');
        $uname->setRequired(true)->setLabel('Username');
        $uname->setFilters(array('stripTags', 'stringTrim'));
        $this->addElement($uname);

        //create new element
        $upass = $this->createElement('password', 'password');
        $upass->setRequired(true)->setLabel('Password');
        $upass->setFilters(array('stripTags', 'stringTrim'));
        $this->addElement($upass);


        $submit = $this->addElement('submit', 'submit', array('label' => 'Sign-in') );
    }

}

?>
