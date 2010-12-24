<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Room
 *
 * @author marcin
 */
class My_Form_Room extends My_Form_Abstract_AccommodationAbstract {
    //put your code here
    
    public function init() {
        $accInfoSubForm = $this->_makeAccBasicDescSubForm();
        $addressSubForm = $this->_makeAddressSubForm();
        $roomatesSubForm = $this->_makeRoomatesSubForm();

        $this->addSubForm($accInfoSubForm, self::BASIC_INFO_SUBFORM_NAME);
        $this->addSubForm($addressSubForm, self::ADDRESS_SUBFORM_NAME);
        $this->addSubForm($roomatesSubForm, self::ROOMATES_SUBFORM_NAME);

        // Create a submit button.
        $this->addElement('submit', 'Submit');

    }

}
?>
