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
class My_Form_UserCreate extends My_Form_Abstract_AccommodationAbstract {

    public function init() {

        parent::init();
        
        $this->setAttrib('id', 'register-form');

        $aboutYouSubForm = $this->_makeAboutYouSubForm();
        $this->addSubForm($aboutYouSubForm, self::ABOUT_YOU_SUBFORM_NAME);
        $cancelButton = new Zend_Form_Element_Submit('cancel', 'Cancel');
        $this->addElement($cancelButton);
        $submit = $this->addElement('submit', 'Submit');
    }

    /**
     * Remove password1 and password2 fields.
     */
    public function removePasswordFields() {
        $subform = $this->getSubForm(self::ABOUT_YOU_SUBFORM_NAME);
        $subform->removeElement('password1');
        $subform->removeElement('password2');
        return $this;
    }
    
    public function makeDisplayGroups() {
        
       $subForm = $this->getSubForm(self::ABOUT_YOU_SUBFORM_NAME);
        
       $subForm->addDisplayGroup(
                array('email','email_public','password1','password2'),'essential',
                array('legend' => 'Required fields')
                );
       
       $subForm->addDisplayGroup(
                array('nickname','phone_no','phone_public', 'description'),'nonessential',
                array('legend' => 'Optional fields')
                );
       return $this;
       
    }
    
     public function removeLegend() {
           $subForm = $this->getSubForm(self::ABOUT_YOU_SUBFORM_NAME);
           $subForm->setLegend('');
           return $this;
     }

}

?>
