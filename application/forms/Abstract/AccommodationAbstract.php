<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Form_AccommodationAbstract
 *
 * @author marcin
 */
abstract class My_Form_Abstract_AccommodationAbstract extends Zend_Form {
    const BASIC_INFO_SUBFORM_NAME = 'basic_info';
    const ADDRESS_SUBFORM_NAME = 'address';
    const ROOMATES_SUBFORM_NAME = 'roomates';
    const PREFERENCES_SUBFORM_NAME = 'preferences';
    const ACC_FEATURES_SUBFORM_NAME = 'features';
    const ROOM_FEATURES_SUBFORM_NAME = 'room_features';
    const BED_FEATURES_SUBFORM_NAME = 'bed_features';
    const LEGAL_SUBFORM_NAME = 'legal';
    const ABOUT_YOU_SUBFORM_NAME = 'about_you';
    const PHOTOS_SUBFORM_NAME = 'photos';
    const NEW_CITY_SUBFORM_NAME = 'new_city';
    const APPARTMENT_DETAILS = 'appartment_details';


    protected $_tooltipMessages = array(
        'title' => 'The title of this advertisment',
        'acc_desc' => 'Description of your offer',
        'price' => 'Example values: 400, 800',
        'price_info' => 'Such as electricity, gas, Internet',
        'autocompleter' => 'AUTOCOMPLETER should kick in after two leters',
        'building_no' => 'Building number in which your advertised accommodation is located',
        'app_no' => 'Appartment number in which your advertised accommodation is located'
    );

    protected function _tooltip($key) {
        $tr = $this->getTranslator();
        return $tr->translate($this->_tooltipMessages[$key]);
    }

    public function init() {
        $this->setMethod('post');
        $this->setElementFilters(array('stripTags', 'stringTrim'));
    }

    protected function _makeAccBasicDescSubForm() {
        $accInfoSubForm = new Zend_Form_SubForm();
        $accInfoSubForm->setLegend('Accommodation description');

        //@todo  $accTypeChoice shoudl be field using type model.
        $typeModel = new My_Model_Table_Type();

        // add element
        $accTypeChoice = new Zend_Form_Element_Select('acc_type');
        $accTypeChoice->setLabel('Type');
        $accTypeChoice->addMultiOptions(
                array(
                    '1' => "A place in a room",
                    '2' => "Entire room",
                    '3' => "Appartment",
                )
        );
        //$accTypeChoice->setRequired(true);
        $accTypeChoice->setValue('2');

     
        // create new element
        $titleInput = $this->createElement('text', 'title');
        $titleInput->setRequired(true)->setLabel('Title');
        $titleInput->setFilters(array('stripTags', 'stringTrim'));
        $titleInput->setAttribs(array('tooltip' => $this->_tooltip('title')));
        $titleInput->addValidator($this->_StringLength(81));       

        // create new element
        $descriptionInput = $this->createElement('textarea', 'description');
        $descriptionInput->setRequired(true)->setLabel('Description');
        $descriptionInput->setFilters(array('stripTags', 'stringTrim'));
        $descriptionInput->addValidator($this->_StringLength(701));
        $descriptionInput->setAttribs(array('cols' => 20, 'rows' => 5));
        $descriptionInput->setAttribs(array('tooltip' => $this->_tooltip('acc_desc')));

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
        //$shortTermChb->setRequired(true);
        $shortTermChb->setLabel('Is short term OK (less than 2 months)');
        $shortTermChb->setChecked(true);

        // create new element
        $priceInput = $this->createElement('text', 'price');
        $priceInput->setAttribs(array('tooltip' => $this->_tooltip('price')));
        $priceInput->setRequired(true);
        $priceInput->setLabel('Price per month [$]');
        $priceInput->setFilters(array('stripTags', 'stringTrim'));
        $priceInput->addValidator('int');

        // create new element
        $priceInfo = $this->createElement('textarea', 'price_info');
        $priceInfo->setRequired(false)->setLabel('Any addition expenses/price information');
        $priceInfo->setAttribs(array('tooltip' => $this->_tooltip('price_info')));

        $priceInfo->setAttribs(
                array(
                    'cols' => 20,
                    'rows' => 5,
                // 'style'=>'display: none;'                    
                )
        );
        $priceInfo->setFilters(array('stripTags', 'stringTrim'));
        $priceInfo->addValidator($this->_StringLength(61));

        // create new element
        $bondInput = $this->createElement('text', 'bond');
        $bondInput->setAttribs(array('toottip' => 'E.g. 400, 800'));
        $bondInput->setRequired(false);
        $bondInput->setLabel('Bond');
        $bondInput->setFilters(array('stripTags', 'stringTrim'));
        $bondInput->addValidator('int');


        $accInfoSubForm->addElements(array(
            $accTypeChoice, /* $liveChoice */ $titleInput, $descriptionInput,
            $dateAvaliableInput, /*  $shortTermChb  */ $priceInput, $priceInfo,
            $bondInput)
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
        $cityInput->setAttribs(array('tooltip' => $this->_tooltip('autocompleter')));


        $cities = My_Model_Table_City::getAllCitiesAsArray();
        $inArrayVal = new Zend_Validate_InArray($cities);

        $cityInput->addValidator($inArrayVal);


        $stateInput = $this->createElement('text', 'state');
        $stateInput->setRequired(true)->setLabel('State');
        $stateInput->setFilters(array('stripTags', 'stringTrim'));

        // create new element
        $unitNoInput = $this->createElement('text', 'unit_no');
        $unitNoInput->setRequired(false)->setLabel('Unit number');
        $unitNoInput->setFilters(array('stripTags', 'stringTrim'));
        $unitNoInput->setAttribs(array('tooltip' => $this->_tooltip('building_no')));

        // create new element
        $streetNoInput = $this->createElement('text', 'street_no');
        $streetNoInput->setRequired(true)->setLabel('Street number');
        $streetNoInput->setFilters(array('stripTags', 'stringTrim'));
        $streetNoInput->setAttribs(array('tooltip' => $this->_tooltip('app_no')));

        $addressPublicChb = $this->createElement('checkbox', 'address_public');
        //$addressPublicChb->setRequired(true);
        $addressPublicChb->setLabel('Unit and street numbers visible to all');
        $addressPublicChb->setChecked(false);


        // create new element
        $streetNameInput = $this->createElement('text', 'street_name');
        $streetNameInput->setRequired(true)->setLabel('Street name');
        $streetNameInput->setFilters(array('stripTags', 'stringTrim'));
        $streetNameInput->setAttribs(array('tooltip' => $this->_tooltip('autocompleter')));


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
            $cityInput, $streetNameInput, $streetNoInput, $unitNoInput, $addressPublicChb,
                /* $zipInput */ /* $stateInput */
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
        $aroomatesForm->setLegend('Current tenats');

        // create new element
        $noOfRoomatesInput = new Zend_Form_Element_Select('no_roomates');
        $noOfRoomatesInput->setLabel(
                'No of tenants already leaving in the property'
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


        $ageOptions = array();

        for ($i = 10; $i < 65; $i+=5) {
            $ageOptions[$i] = $i;
        }

        // create new element
        $minAgeInput = new Zend_Form_Element_Select('min_age');
        $minAgeInput->setLabel('Approximate min. age of the tenants');
        $minAgeInput->addMultiOptions($ageOptions);
        $minAgeInput->setValue('20');

        // $minAgeInput->setRequired(true);
        // create new element
        $maxAgeInput = new Zend_Form_Element_Select('max_age');
        $maxAgeInput->setLabel('Approximate max. age of the tenants');
        $maxAgeInput->addMultiOptions($ageOptions);
        //$maxAgeInput->setRequired(true);
        $maxAgeInput->setValue('35');
        $maxAgeInput->addValidator(new My_Validate_MinMaxAge());


        $aroomatesForm->addElements(array($noOfRoomatesInput, $minAgeInput, $maxAgeInput));



        $labels = My_Model_Table_Roomates::$labels;

        foreach ($labels as $name => $options) {
            if (isset($options['value'])) {
                $elem = $this->_addSelectElem($name, $options['value'], $options['label'], $options['default']);
                $aroomatesForm->addElement($elem);
            }
        }


        $descriptionInput = $this->createElement('textarea', 'description');
        $descriptionInput->setFilters(array('stripTags', 'stringTrim'));
        $descriptionInput->addValidator($this->_StringLength(101));
        $descriptionInput->setRequired(false)->setLabel('Few words about tenants');
        $descriptionInput->setAttribs(array('cols' => 20, 'rows' => 5));

        $aroomatesForm->addElements(array($descriptionInput));

        return $aroomatesForm;
    }

    protected function _makePreferencesSubForm() {
        $preferencesForm = new Zend_Form_SubForm();
        $preferencesForm->setLegend('Preferences');

        $labels = My_Model_Table_Preferences::$labels;

        foreach ($labels as $name => $options) {
            if (isset($options['value'])) {
                $elem = $this->_addSelectElem($name, $options['value'], $options['label'], $options['default']);
                $preferencesForm->addElement($elem);
            }
        }

        $descriptionInput = $this->createElement('textarea', 'description');
        $descriptionInput->setFilters(array('stripTags', 'stringTrim'));
        $descriptionInput->setRequired(false)->setLabel('Any other preferences');
        $descriptionInput->addValidator($this->_StringLength(101));
        $descriptionInput->setAttribs(array('cols' => 20, 'rows' => 5));

        $preferencesForm->addElement($descriptionInput);

        return $preferencesForm;
    }

    protected function _makeAccFeaturesSubForm() {
        $featuresForm = new Zend_Form_SubForm();
        $featuresForm->setLegend('Accommodation features');

        $labels = My_Model_Table_Features::$labels;

        foreach ($labels as $name => $options) {
            if (isset($options['value'])) {
                $elem = $this->_addSelectElem($name, $options['value'], $options['label'], $options['default']);
                $featuresForm->addElement($elem);
            }
        }


        $descriptionInput = $this->createElement('textarea', 'description');
        $descriptionInput->setFilters(array('stripTags', 'stringTrim'));
        $descriptionInput->addValidator($this->_StringLength(101));
        $descriptionInput->setRequired(false)->setLabel('Any other features');
        $descriptionInput->setAttribs(array('cols' => 20, 'rows' => 5));

        $featuresForm->addElement($descriptionInput);

        return $featuresForm;
    }

    protected function _addSelectElem($name, $options, $label='', $default = 0) {
        $elem = new Zend_Form_Element_Select($name);

        if (empty($label)) {
            $label = ucfirst($name);
        }

        $elem->setLabel($label);
        $elem->addMultiOptions($options);
        $elem->setRequired(false)->setValue($default);
        return $elem;
    }

//    protected function _makeRoomFeaturesSubForm() {
//        $featuresForm = new Zend_Form_SubForm();
//        $featuresForm->setLegend('Room features');
//
//        $roomTypeID = My_Model_Table_Type::getByName('Room');
//
//        $roomFeatures = My_Model_Table_Feature::getAllByType($roomTypeID->type_id)->toArray();
//
//        foreach ($roomFeatures as $feature) {
//            if ('0' === $feature['binary']) {
//                continue;
//            }
//            $newElem = $this->createElement('checkbox', $feature['name']);
//            //$newElem->setRequired(true);
//            $newElem->setLabel(ucfirst($feature['name']));
//            $newElem->setCheckedValue("{$feature['feat_id']}");
//            $newElem->setUnCheckedValue('-1');
//            $newElem->setChecked(false);
//            $featuresForm->addElement($newElem);
//        }
//
//        return $featuresForm;
//    }

    protected function _makeAppartmentDetailsSubForm() {

        $appartmentDetailsForm = new Zend_Form_SubForm();
        $appartmentDetailsForm->setLegend('Appartment details');
        // $appartmentDetailsForm->removeDecorator('HtmlTag');
        //  var_dump($appartmentDetailsForm->getDecorators());


        $noOfBedrooms = new Zend_Form_Element_Select('bedrooms');
        $noOfBedrooms->setLabel('Number of bedrooms');
        $noOfBedrooms->addMultiOptions(
                array(
                    '1' => "1",
                    '2' => "2",
                    '3' => "3",
                    '4' => "4",
                )
        );
        $noOfBedrooms->setRequired(false)->setValue('1');
        $appartmentDetailsForm->addElement($noOfBedrooms);



        $noOfBathrooms = new Zend_Form_Element_Select('bathrooms');
        $noOfBathrooms->setLabel('Number of bathrooms');
        $noOfBathrooms->addMultiOptions(
                array(
                    '1' => "1",
                    '2' => "2",
                    '3' => "3",
                    '4' => "4",
                )
        );
        $noOfBathrooms->setRequired(false)->setValue('1');
        $appartmentDetailsForm->addElement($noOfBathrooms);

        $noOfParkingSpots = new Zend_Form_Element_Select('parking_spots');
        $noOfParkingSpots->setLabel('Number of parking spots');
        $noOfParkingSpots->addMultiOptions(
                array(
                    '0' => "0",
                    '1' => "1",
                    '2' => "2",
                    '3' => "3",
                    '4' => "4",
                )
        );
        $noOfParkingSpots->setRequired(false)->setValue('0');
        $appartmentDetailsForm->addElement($noOfParkingSpots);


        // create new element
        $descriptionInput = $this->createElement('textarea', 'description');
        $descriptionInput->setFilters(array('stripTags', 'stringTrim'));
        $descriptionInput->addValidator($this->_StringLength(101));
        $descriptionInput->setRequired(false)->setLabel('Any other details');
        $descriptionInput->setAttribs(array('cols' => 20, 'rows' => 5));
        $appartmentDetailsForm->addElement($descriptionInput);


        return $appartmentDetailsForm;
    }

    protected function _makeLegalSubForm() {
        $subForm = new Zend_Form_SubForm();
        $subForm->setLegend('Regulations and privacy policy');

        $legalUrl = $this->getView()->url(array(), 'legalpage');
        $privacyUrl = $this->getView()->url(array(), 'privacypage');

        
        $tr = $this->getTranslator();
        
        $label = 'Do you accept our regulations (%link1%) and privacy policy (%link2%)?';
        $label = $tr->_($label);
        $label = str_replace(
                array('%link1%', '%link2%'), 
                array(
                    "<a href=\"$legalUrl\" target=\"_blank\">{$tr->_('read here')}</a>",
                    "<a href=\"$privacyUrl\" target=\"_blank\">{$tr->_('read here')}</a>"
                    ), 
                $label
        );



        $legalChoice = new Zend_Form_Element_Select('accept');
        $legalChoice->setLabel($label);
        $legalChoice->getDecorator('Label')->setOption('escape', false);
        $legalChoice->addMultiOptions(
                array(
                    '0' => "No",
                    '1' => "Yes"
                )
        );
        $legalChoice->setRequired(true);
        $legalChoice->setValue('0');


        // make sure legal is accepted.
        $validator = new Zend_Validate_Identical("1");
        $validator->setMessage(
                "You cannot proceed if you don't agree with out regulations or privacy policy", Zend_Validate_Identical::NOT_SAME
        );
        $legalChoice->addValidator($validator);


        $subForm->addElement($legalChoice);


        return $subForm;
    }

    protected function _makeAboutYouSubForm() {
        $aboutYouForm = new Zend_Form_SubForm();
        $aboutYouForm->setLegend('About you');


        // create new element
        $nickName = $this->createElement('text', 'nickname');
        $nickName->setRequired(false)->setLabel('Name or nickname');
        $nickName->setFilters(array('stripTags', 'stringTrim'));

        // create new element
        $phoneInput = $this->createElement('text', 'phone_no');
        $phoneInput->setRequired(false)->setLabel('Phone');
        $phoneInput->setFilters(array('stripTags', 'stringTrim'));


        // create new element
        $phonePublicChb = $this->createElement('checkbox', 'phone_public');
        $phonePublicChb->setRequired(false);
        $phonePublicChb->setLabel('Phone visible to all');
        $phonePublicChb->setChecked(false);

        // create new element
        $emailInput = $this->createElement('text', 'email');
        $emailInput->setRequired(true)->setLabel('Email');
        $emailInput->setFilters(array('stripTags', 'stringTrim'));
        $emailValidator = new Zend_Validate_EmailAddress(
                        array('domain' => true)
        );
        $emailValidator->setMessages(array(
            Zend_Validate_EmailAddress::INVALID_FORMAT => 'Incorrect email format'
        ));
        $emailInput->addValidator($emailValidator);
        $emailInput->addValidator(new My_Validate_UniqueEmail());
        $emailInput->setAttribs(
                array(
                    'tooltip' => 'Email that can be used to contact you'
                )
        );



        // create new element
        $emailPublicChb = $this->createElement('checkbox', 'email_public');
        $emailPublicChb->setRequired(false);
        $emailPublicChb->setLabel('Email visible to all');
        $emailPublicChb->setChecked(false);

        $password1 = $this->createElement('password', 'password1');
        $password1->setLabel('Password (minum 6 characters)');
        $password1->addValidator('StringLength', false, array(6))
                ->setRequired(true);


        $password2 = $this->createElement('password', 'password2');
        $password2->setLabel('Repeat password');
        $password2->addValidator('StringLength', false, array(6))
                ->setRequired(true);
        $password2->addValidator(new My_Validate_PasswordConfirmation());

        // create new element
        $descriptionInput = $this->createElement('textarea', 'description');
        $descriptionInput->setFilters(array('stripTags', 'stringTrim'));
        $descriptionInput->setRequired(false)->setLabel('Few words about you');
        $descriptionInput->setAttribs(array('cols' => 20, 'rows' => 5));        
        $descriptionInput->addValidator($this->_StringLength(101));

        $aboutYouForm->addElements(array(
            /* $fnameInput, $lnameInput, $lnamePublicChb */
            $nickName,
            $phoneInput, $phonePublicChb, $emailInput,
            $emailPublicChb, $descriptionInput,
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

    /**
     * StringLengthValidator with some pre-set options.
     * 
     * @param type $max max length of string
     * @return Zend_Validate_StringLength 
     */
    protected function _StringLength($max = 200) {

        $val = new Zend_Validate_StringLength(array('max' => $max));
        $val->setMessage('Field value is more than %max% characters long', Zend_Validate_StringLength::TOO_LONG);

        return $val;
    }

}

?>
