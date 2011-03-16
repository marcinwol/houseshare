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
class My_Form_SendEmail extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        $this->setAttrib('style','display:none');
        $this->setAttrib('id','email-form');

        // add an email field
        $email = $this->createElement('text', 'email');
        $email->setLabel('Email');
        $email->setRequired()->addValidator('EmailAddress');

        // ad a textarea with a body of the email
        $body = $this->createElement('textarea', 'message');
        $body->setLabel('Your query about the advertisment');
        $body->setRequired();
        $body->addValidator('StringLength', array('min' => 30, 'max' => 256));
        
        $send = $this->createElement('submit', 'send');
        $send->setLabel('Send');
        
        $this->addElements(array($email, $body, $send));
        
    }

}

?>
