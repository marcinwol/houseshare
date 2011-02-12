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
class My_Form_MainPage extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        // add what do you want to do radio button
        $mainChoice = new Zend_Form_Element_Radio('rd_what_to_do');
        $mainChoice->addMultiOptions(
                array(
                    '0' => "I need a room in ...",
                    '1' => "I have a room in ...",
                )
        );
        $mainChoice->setRequired(true);
        $mainChoice->setValue('0');
        $this->addElement($mainChoice);


        //create new element
        $cities1 = $this->createElement('text', 'i_city');
        $cities1->setRequired(true)->setLabel('City');
        $cities1->setFilters(array('stripTags', 'stringTrim'));
        $this->addElement($cities1);


        $submit = $this->addElement('submit', 'submit',
                        array('label' => 'Search for an accommodation')
        );
    }

}

?>
