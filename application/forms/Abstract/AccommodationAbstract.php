<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Form_AddAccommodation
 * @todo Make Add Accomodation Abstract and dependant forms.
 * @todo add 'Show property address to everyone'
 * @todo add bond fild
 * @todo add photos
 * @author marcin
 */
abstract class My_Form_Abstract_AccommodationAbstract extends Zend_Form {

    const BASIC_INFO_SUBFORM_NAME = 'basic_info';
    const ADDRESS_SUBFORM_NAME = 'address';
    const ROOMATES_SUBFORM_NAME = 'roomates';
    const PREFERENCES_SUBFORM_NAME = 'preferences';

    public function init() {
        $this->setMethod('post');
    }

    protected function _makeAccBasicDescSubForm() {
        $accInfoSubForm = new Zend_Form_SubForm();
        $accInfoSubForm->setLegend('Basic description');


        // add element
        $accTypeChoice = new Zend_Form_Element_Select('acc_type');
        $accTypeChoice->setLabel('Accommodation type');
        $accTypeChoice->addMultiOptions(
                array(
                    '0' => "Room",
                    '1' => "Bed",
                )
        );
        $accTypeChoice->setRequired(true);
        $accTypeChoice->setValue('0');


        // create new element
        $titleInput = $this->createElement('text', 'name');
        $titleInput->setRequired(true)->setLabel('Title');
        $titleInput->setFilters(array('stripTags', 'stringTrim'));

        // create new element
        $descriptionInput = $this->createElement('textarea', 'description');
        $descriptionInput->setRequired(true)->setLabel('Advertisment description');
        $descriptionInput->setFilters(array('stripTags', 'stringTrim'));
        $descriptionInput->setAttribs(array('cols' => 20, 'rows' => 5));

        // create new element
        $dateAvaliableInput = $this->createElement('text', 'date_avaliable');
        $dateAvaliableInput->setRequired(true);
        $dateAvaliableInput->setLabel('Avaliable from (dd/mm/yyyy)');
        $dateAvaliableInput->setFilters(array('stripTags', 'stringTrim'));
        $dateAvaliableInput->addValidator('date',
                array('format' => 'dd/MM/yyyy')
        );

        // create new element
        $priceInput = $this->createElement('text', 'price');
        $priceInput->setRequired(true);
        $priceInput->setLabel('Price per month (e.g. 300)');
        $priceInput->setFilters(array('stripTags', 'stringTrim'));
        $priceInput->addValidator('int');

        $accInfoSubForm->addElements(array(
            $accTypeChoice, $titleInput, $descriptionInput,
            $dateAvaliableInput, $priceInput)
        );

        return $accInfoSubForm;
    }

    protected function _makeAddressSubForm() {
        $addressForm = new Zend_Form_SubForm();
        $addressForm->setLegend('Address');

        // add element
        $cityChoice = new Zend_Form_Element_Select('city');
        $cityChoice->setLabel('City');
        $cityChoice->addMultiOptions($this->_getCities());
        $cityChoice->setRequired(true);
        $cityChoice->setValue('0');


        // create new element
        $streetNoInput = $this->createElement('text', 'street_no');
        $streetNoInput->setRequired(true)->setLabel('Street number');
        $streetNoInput->setFilters(array('stripTags', 'stringTrim'));

        // create new element
        $streetNameInput = $this->createElement('text', 'street_name');
        $streetNameInput->setRequired(true)->setLabel('Street name');
        $streetNameInput->setFilters(array('stripTags', 'stringTrim'));


        // create new element
        $zipInput = $this->createElement('text', 'zip');
        $zipInput->setRequired(true)->setLabel('Zip code');
        $zipInput->setFilters(array('stripTags', 'stringTrim'));


        $addressForm->addElements(array(
            $streetNoInput, $streetNameInput,
            $zipInput, $cityChoice)
        );

        return $addressForm;
    }

    /**
     *
     * @todo add costum calidator for max and min ages.
     */
    protected function _makeRoomatesSubForm() {
        $aroomatesForm = new Zend_Form_SubForm();
        $aroomatesForm->setLegend('Roomates');

        // create new element
        $noOfRoomatesInput = new Zend_Form_Element_Select('no_of_roomates');
        $noOfRoomatesInput->setLabel(
                'No of roomates already leaving in the property'
        );
        $noOfRoomatesInput->addMultiOptions(
                array(
                    '0' => "0",
                    '1' => "1",
                    '2' => "2",
                    '3' => "3",
                    '4' => "4",
                    '5' => "5 or more",
                )
        );
        $noOfRoomatesInput->setRequired(true);


        // create new element
        $genderOfRoomatesInput = new Zend_Form_Element_Select('gender_of_roomates');
        $genderOfRoomatesInput->setLabel('Gender of roomates');
        $genderOfRoomatesInput->addMultiOptions(
                array(
                    '0' => "male",
                    '1' => "female",
                    '2' => "both male and female",
                )
        );
        $genderOfRoomatesInput->setRequired(true);

        $ageOptions = array();

        for ($i = 10; $i < 65; $i+=5) {
            $ageOptions[$i] = $i;
        }

         // create new element
        $minAgeInput = new Zend_Form_Element_Select('min_age_of_roomates');
        $minAgeInput->setLabel('Approximate min. age of roomates');
        $minAgeInput->addMultiOptions($ageOptions);
        $minAgeInput->setRequired(true);


         // create new element
        $maxAgeInput = new Zend_Form_Element_Select('max_age_of_roomates');
        $maxAgeInput->setLabel('Approximate max. age of roomates');
        $maxAgeInput->addMultiOptions($ageOptions);
        $maxAgeInput->setRequired(true);
        $maxAgeInput->setValue('35');

     

        $aroomatesForm->addElements(array(
            $noOfRoomatesInput, $genderOfRoomatesInput,
            $minAgeInput, $maxAgeInput)
        );

        return $aroomatesForm;
    }

     protected function _makePreferencesSubForm() {
        $preferencesForm = new Zend_Form_SubForm();
        $preferencesForm->setLegend('Preferences');

        $allPreferences = My_Model_DbTable_Preference::getAllPreferences()->toArray();     

        foreach ($allPreferences as $pref ) {
            if ('0' === $pref['binary']) {
                continue;
            }
            $newElem =  $this->createElement('checkbox', $pref['name']);
            $newElem->setRequired(true)->setLabel(ucfirst($pref['name']) . ' accepted');
            $newElem->setChecked(true);
            $preferencesForm->addElement($newElem);         
        }

         // create element for gender as it is not binary.
        $genderPref = new Zend_Form_Element_Select('gender');
        $genderPref->setLabel('Prefered geneder');
        $genderPref->addMultiOptions(
                array(
                    '0' => "male",
                    '1' => "female",
                    '2' => "does not matter",
                )
        );
        $genderPref->setRequired(true)->setValue('2');     
        $preferencesForm->addElement($genderPref);

        return $preferencesForm;
    }



    protected function _getCities() {
        $modelCity = new My_Model_DbTable_City();
        $cities = $modelCity->getCities()->toArray();

        $citiesOptions = array();

        foreach ($cities as $city) {
            $citiesOptions[$city['city_id']] = $city['name'];
        }

        return $citiesOptions;
    }

    /**
     * Set default value of city select form.
     *
     * @param int|string $cityID
     */
    public function setDefultCity($cityID) {

        $cityElement = $this->getSubForm(self::ADDRESS_SUBFORM_NAME)
                        ->getElement('city');

        $cityElement->setValue($cityID);
    }

}

?>
