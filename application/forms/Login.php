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
        $email = $this->createElement('text', 'email');
        $email->setRequired(true)->setLabel('Your email');
        $email->setFilters(array('stripTags', 'stringTrim'));

        $emailValidator = new Zend_Validate_EmailAddress(
                        array('domain' => false)
        );
        $emailValidator->setMessages(array(
            Zend_Validate_EmailAddress::INVALID_FORMAT => 'Incorrect email format'
        ));
        $email->addValidator($emailValidator);


        $this->addElement($email);

        //create new element
        $upass = $this->createElement('password', 'password');
        $upass->setRequired(true)->setLabel('Password');
        $upass->setFilters(array('stripTags', 'stringTrim'));
         $upass->removeDecorator('DtDdWrapper');
                $upass->removeDecorator('HtmlTag');
         $upass->removeDecorator('Description');
        $this->addElement($upass);
        
       

        $submit = $this->addElement('submit', 'submit', array('label' => 'Sign-in'));
    }

}

?>
