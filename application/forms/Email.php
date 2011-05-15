<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SendEmail
 *
 * @author marcin
 */
class My_Form_Email extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        $this->setAttrib('id','acc-recovery');
        
        // add an email field
        $email = $this->createElement('text', 'email');
        $email->setLabel('Email');
        $email->setRequired()->addValidator('EmailAddress');

        $cancelButton = new Zend_Form_Element_Submit('cancel', 'Cancel');
     
        
        $send = $this->createElement('submit', 'send');
        $send->setLabel('Send an account recovery email');

        $this->addElements(array($email, $cancelButton, $send));
    }
}

?>
