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

         $aboutYouSubForm = $this->_makeAboutYouSubForm();
         $this->addSubForm($aboutYouSubForm, self::ABOUT_YOU_SUBFORM_NAME);

         $submit = $this->addElement('submit', 'Submit');
    }

}

?>
