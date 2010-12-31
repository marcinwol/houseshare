<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Form_AccommodationAbstract
 *
 * @todo Upload of photos should be separate from this form.
 * @author marcin
 */
abstract class My_Form_Abstract_AccommodationAbstract extends Zend_Form {
    const BASIC_INFO_SUBFORM_NAME = 'basic_info';
    const ADDRESS_SUBFORM_NAME = 'address';
    const ROOMATES_SUBFORM_NAME = 'roomates';
    const PREFERENCES_SUBFORM_NAME = 'preferences';
    const ACC_FEATURES_SUBFORM_NAME = 'acc_features';
    const ROOM_FEATURES_SUBFORM_NAME = 'room_features';
    const BED_FEATURES_SUBFORM_NAME = 'bed_features';
    const ABOUT_YOU_SUBFORM_NAME = 'about_you';
    const PHOTOS_SUBFORM_NAME = 'photos';
    const NEW_CITY_SUBFORM_NAME = 'new_city';

    public function init() {
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
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

        // add element
        $liveChoice = new Zend_Form_Element_Select('live_in_acc');
        $liveChoice->setLabel('Do you live in the property?');
        $liveChoice->addMultiOptions(
                array(
                    '0' => "Yes and I rent it",
                    '1' => "Yes and I own it",
                    '2' => "No but I own it",
                    '3' => "No and I am a Real Estate Agent",
                )
        );
        $liveChoice->setRequired(true);
        $liveChoice->setValue('0');


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
        $dateAvaliableInput->setLabel('Avaliable from');
        $dateAvaliableInput->setFilters(array('stripTags', 'stringTrim'));
        $dateAvaliableInput->addValidator(
                new Zend_Validate_Date(array('format' => 'dd/MM/yyyy'))
        );
        $dateAvaliableInput->setValue(Zend_Date::now()->toString('dd/MM/yyyy'));

        // create new element
        $shortTermChb = $this->createElement('checkbox', 'short_term');
        $shortTermChb->setRequired(true);
        $shortTermChb->setLabel('Is short term OK');
        $shortTermChb->setChecked(true);

        // create new element
        $priceInput = $this->createElement('text', 'price');
        $priceInput->setRequired(true);
        $priceInput->setLabel('Price per month (e.g. 300)');
        $priceInput->setFilters(array('stripTags', 'stringTrim'));
        $priceInput->addValidator('int');

        // create new element
        $bondInput = $this->createElement('text', 'bond');
        $bondInput->setRequired(false);
        $bondInput->setLabel('Bond (e.g. 1200)');
        $bondInput->setFilters(array('stripTags', 'stringTrim'));
        $bondInput->addValidator('int');


        $accInfoSubForm->addElements(array(
            $accTypeChoice, $liveChoice, $titleInput, $descriptionInput,
            $dateAvaliableInput, $shortTermChb, $priceInput, $bondInput)
        );

        return $accInfoSubForm;
    }

    protected function _makeAddressSubForm() {
        $addressForm = new Zend_Form_SubForm();
        $addressForm->setLegend('Address');

        // add element
        /*
          $cityChoice = new Zend_Form_Element_Select('city');
          $cityChoice->setLabel('City');
          $cityChoice->addMultiOptions(
          My_Model_Table_City::getAllCitiesAsArray()
          );
          $cityChoice->setRequired(true);
          $cityChoice->setValue('0');
         */

            //create new element
         $cityInput = $this->createElement('text', 'city');
         $cityInput->setRequired(true)->setLabel('City');
         $cityInput->setFilters(array('stripTags', 'stringTrim'));

         $stateInput = $this->createElement('text', 'state');
         $stateInput->setRequired(true)->setLabel('State');
         $stateInput->setFilters(array('stripTags', 'stringTrim'));

        // create new element
        $streetNoInput = $this->createElement('text', 'street_no');
        $streetNoInput->setRequired(true)->setLabel('Street number');
        $streetNoInput->setFilters(array('stripTags', 'stringTrim'));

        $addressPublicChb = $this->createElement('checkbox', 'address_public');
        $addressPublicChb->setRequired(true);
        $addressPublicChb->setLabel('Street number visible to all');
        $addressPublicChb->setChecked(false);

        // create new element
        $streetNameInput = $this->createElement('text', 'street_name');
        $streetNameInput->setRequired(true)->setLabel('Street name');
        $streetNameInput->setFilters(array('stripTags', 'stringTrim'));


        // create new element
        $zipInput = $this->createElement('text', 'zip');
        $zipInput->setRequired(true)->setLabel('Zip code');
        $zipInput->setFilters(array('stripTags', 'stringTrim'));

        // create new element
        /*
        $newCityChb = $this->createElement('checkbox', 'new_public');
        $newCityChb->setRequired(true);
        $newCityChb->setLabel('My city not in the list');
        $newCityChb->setChecked(false);
        */


        $addressForm->addElements(array(
            $streetNoInput, $addressPublicChb, $streetNameInput,
            $zipInput, $cityInput, $stateInput
                )
        );

        return $addressForm;
    }

    public function _makeNewCitySubForm($display_none = true) {
        $newCityForm = new Zend_Form_SubForm();
        $newCityForm->setLegend('Add a new city');

        if ($display_none) {
            $newCityForm->setAttrib('style', 'display:none');
        }

        // create elements in case new city is needed
        $newCityNameInput = $this->createElement('text', 'new_city_name');
        $newCityNameInput->setRequired(false)->setLabel('City name');
        $newCityNameInput->setFilters(array('stripTags', 'stringTrim'));

        // add select element to indicate state for the new city
        $stateChoice = new Zend_Form_Element_Select('state_for_new_city');
        $stateChoice->setLabel('Select state in which a new city is');
        $stateChoice->addMultiOptions(
                My_Model_Table_State::getAllStatesAsArray()
        );
        $stateChoice->setRequired(true);
        $stateChoice->setValue('0');

        $newCityForm->addElements(array($newCityNameInput, $stateChoice));

        return $newCityForm;
    }

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
        $maxAgeInput->addValidator(new My_Validate_MinMaxAge());


        $aroomatesForm->addElements(array(
            $noOfRoomatesInput, $genderOfRoomatesInput,
            $minAgeInput, $maxAgeInput)
        );

        return $aroomatesForm;
    }

    protected function _makePreferencesSubForm() {
        $preferencesForm = new Zend_Form_SubForm();
        $preferencesForm->setLegend('Preferences');

        $allPreferences = My_Model_Table_Preference::getAllPreferences()->toArray();

        foreach ($allPreferences as $pref) {
            if ('0' === $pref['binary']) {
                continue;
            }
            $newElem = $this->createElement('checkbox', $pref['name']);
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

    protected function _makeAccFeaturesSubForm() {
        $featuresForm = new Zend_Form_SubForm();
        $featuresForm->setLegend('Accommodation features');

        $accFeatures = My_Model_Table_AccFeature::getAllFeatures()->toArray();

        foreach ($accFeatures as $feature) {
            if ('0' === $feature['binary']) {
                continue;
            }
            $newElem = $this->createElement('checkbox', $feature['name']);
            $newElem->setRequired(true)->setLabel(ucfirst($feature['name']));
            $newElem->setChecked(false);
            $featuresForm->addElement($newElem);
        }

        // create element for furnishead as it is not binary.
        $furniture = new Zend_Form_Element_Select('furniture');
        $furniture->setLabel('Furniture');
        $furniture->addMultiOptions(
                array(
                    '0' => "Unfurnished",
                    '1' => "Partially furnished",
                    '2' => "Fully furnished"
                )
        );
        $furniture->setRequired(true)->setValue('0');
        $featuresForm->addElement($furniture);

        return $featuresForm;
    }

    protected function _makeRoomFeaturesSubForm() {
        $featuresForm = new Zend_Form_SubForm();
        $featuresForm->setLegend('Room features');

        $roomFeatures = My_Model_Table_RoomFeature::getAllFeatures()->toArray();

        foreach ($roomFeatures as $feature) {
            if ('0' === $feature['binary']) {
                continue;
            }
            $newElem = $this->createElement('checkbox', $feature['name']);
            $newElem->setRequired(true)->setLabel(ucfirst($feature['name']));
            $newElem->setChecked(false);
            $featuresForm->addElement($newElem);
        }

        return $featuresForm;
    }

    protected function _makeBedFeaturesSubForm() {
        $featuresForm = new Zend_Form_SubForm();
        $featuresForm->setLegend('Bed features');

        $bedFeatures = My_Model_Table_BedFeature::getAllFeatures()->toArray();

        if (count($bedFeatures) == 0) {
            return null;
        }

        foreach ($bedFeatures as $feature) {
            if ('0' === $feature['binary']) {
                continue;
            }
            $newElem = $this->createElement('checkbox', $feature['name']);
            $newElem->setRequired(true)->setLabel(ucfirst($feature['name']));
            $newElem->setChecked(false);
            $featuresForm->addElement($newElem);
        }

        return $featuresForm;
    }

    protected function _makeAboutYouSubForm() {
        $aboutYouForm = new Zend_Form_SubForm();
        $aboutYouForm->setLegend('About you');

        // create new element
        $fnameInput = $this->createElement('text', 'first_name');
        $fnameInput->setRequired(true)->setLabel('First name');
        $fnameInput->setFilters(array('stripTags', 'stringTrim'));

        // create new element
        $lnameInput = $this->createElement('text', 'last_name');
        $lnameInput->setRequired(true)->setLabel('Last name');
        $lnameInput->setFilters(array('stripTags', 'stringTrim'));

        // create new element
        $lnamePublicChb = $this->createElement('checkbox', 'last_name_public');
        $lnamePublicChb->setRequired(true);
        $lnamePublicChb->setLabel('Last name visible to all');
        $lnamePublicChb->setChecked(true);

        // create new element
        $phoneInput = $this->createElement('text', 'phone_no');
        $phoneInput->setRequired(true)->setLabel('Phone');
        $phoneInput->setFilters(array('stripTags', 'stringTrim'));


        // create new element
        $phonePublicChb = $this->createElement('checkbox', 'phone_public');
        $phonePublicChb->setRequired(true);
        $phonePublicChb->setLabel('Phone visible to all');
        $phonePublicChb->setChecked(true);

        // create new element
        $emailInput = $this->createElement('text', 'email');
        $emailInput->setRequired(true)->setLabel('Email');
        $emailInput->setFilters(array('stripTags', 'stringTrim'));
        $emailValidator = new Zend_Validate_EmailAddress(
                        array('domain' => false)
        );
        $emailValidator->setMessages(array(
            Zend_Validate_EmailAddress::INVALID_FORMAT => 'Incorrect email format'
        ));
        $emailInput->addValidator($emailValidator);

        $password1 = $this->createElement('password', 'password1');
        $password1->setLabel('Password (minum 6 characters)');
        $password1->addValidator('StringLength', false, array(6))
                ->setRequired(true);


        $password2 = $this->createElement('password', 'password2');
        $password2->setLabel('Repeat password');
        $password2->addValidator('StringLength', false, array(6))
                ->setRequired(true);
        $password2->addValidator(new My_Validate_PasswordConfirmation());

        $aboutYouForm->addElements(array(
            $fnameInput, $lnameInput,
            $lnamePublicChb, $phoneInput, $phonePublicChb, $emailInput,
            $password1, $password2
        ));




        return $aboutYouForm;
    }

    protected function _makePhotosSubForm($noOfPhotos = 3) {
        $photosForm = new Zend_Form_SubForm();
        $photosForm->setLegend('Accommodation photos');

        for ($i = 1; $i <= $noOfPhotos; $i++) {
            $photoElem = $this->_makeImageElement('photo_' . $i);
            $photosForm->addElement($photoElem);
        }

        return $photosForm;
    }

    protected function _makeImageElement($name) {
        // create new element
        $imageElement = $this->createElement('file', $name);
        // element options
        $imageElement->setLabel('Photo: ');
        $imageElement->setRequired(false);
        // DON’T FORGET TO CREATE THIS FOLsDER
        $imageElement->setDestination(APPLICATION_PATH . '/../public/images/upload');
        // ensure only 1 file
        $imageElement->addValidator('Count', false, 1);
        // limit to 100K
        $imageElement->addValidator('Size', false, 102400);
        // only JPEG, PNG, and GIFs
        $imageElement->addValidator('Extension', false, 'jpg,png,gif');

        return $imageElement;
    }

    /**
     * Set default value of city input text field.
     *
     * @param string $city city name
     */
    public function setDefaultCity($city) {

        $cityElement = $this->getSubForm(self::ADDRESS_SUBFORM_NAME)
                        ->getElement('city');

        $cityElement->setValue($city);
    }

     /**
     * Set default value of state input text field.
     *
     * @param string $state state name
     */
    public function setDefaultState($state) {

        $stateElement = $this->getSubForm(self::ADDRESS_SUBFORM_NAME)
                        ->getElement('state');

        $stateElement->setValue($state);
    }

}

?>
