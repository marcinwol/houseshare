<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResetPassword
 *
 * @author marcin
 */
class My_Form_ChangePassword extends Zend_Form {

    public function init() {
        
        $this->setMethod('post');
        $this->setAttrib('id', 'change-password');

        
        $password0 = $this->createElement('password', 'password0');
        $password0->setLabel('Current password');
        $password0->addValidator('StringLength', false, array(6))
                ->setRequired(true);
        

        $password1 = $this->createElement('password', 'password1');
        $password1->setLabel('New password (minum 6 characters)');
        $password1->addValidator('StringLength', false, array(6))
                ->setRequired(true);


        $password2 = $this->createElement('password', 'password2');
        $password2->setLabel('Repeat password');
        $password2->addValidator('StringLength', false, array(6))
                ->setRequired(true);
        $password2->addValidator(new My_Validate_PasswordConfirmation());
        
        
        $cancel = $this->createElement('submit', 'cancel');
        $cancel->setLabel('Cancel');
        
        $submit = $this->createElement('submit', 'submit');
        $submit->setLabel('Submit');
                     
        
        $this->addElements(array($password0, $password1, $password2, $cancel, $submit));
        
       // $this->addElement('hash', 'hihacker', array('salt' => 'unique value'));          
        
    }
    
    public function addCorrectPassValidator($correctPass) {
        $val = new My_Validate_CorrectPassword($correctPass);
        $this->getElement('password0')->addValidator($val);        
    }
    

}

?>
