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
class My_Form_MainPageForm extends Zend_Form {

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

      //  $inArrayValidator = new Zend_Validate_InArray(
      //          array( '0', '1') );
      
       // $mainChoice->addValidator($inArrayValidator);
        $mainChoice->setRequired(true);
        $mainChoice->setValue('0');
        $this->addElement($mainChoice);

        // add city select field
        $cities = new Zend_Form_Element_Select('s_city');
        $cities->setLabel('Select a city:');
        $cities->setRequired(true);
        
        $this->addElement($cities);

        $submit = $this->addElement('submit', 'submit',
                        array('label' => 'Search')
        );
    }

    /**
     * Fill select option with cities and their IDs.
     *
     * @param array $cities Array of cities.
     */
    public function setCitySelect(array $cities) {

        $citiesElement = $this->getElement('s_city');
        $citiesOptions = array();

        foreach ($cities as $city) {
            $citiesOptions[$city['city_id']] = $city['name'];
        }
     
        $citiesElement->setMultiOptions($citiesOptions);
     }

}

?>
