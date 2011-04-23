<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accommodation
 *
 * @author marcin
 */
class My_Form_Accommodation extends My_Form_Abstract_AccommodationAbstract {

    //put your code here

    public function init() {
        parent::init();

        $accInfoSubForm = $this->_makeAccBasicDescSubForm();
        $addressSubForm = $this->_makeAddressSubForm();
        $roomatesSubForm = $this->_makeRoomatesSubForm();
        $preferencesSubForm = $this->_makePreferencesSubForm();
        $accFeaturesSubForm = $this->_makeAccFeaturesSubForm();
        $roomFeaturesSubForm = $this->_makeRoomFeaturesSubForm();
        $bedFeaturesSubForm = $this->_makeBedFeaturesSubForm();
        $appartmentDetailsForm = $this->_makeAppartmentDetailsSubForm();
        // $photosSubForm = $this->_makePhotosSubForm();
        $aboutYouSubForm = $this->_makeAboutYouSubForm();
        $newCitySubForm = $this->_makeNewCitySubForm();

        $this->addSubForm($accInfoSubForm, self::BASIC_INFO_SUBFORM_NAME);
        $this->addSubForm($addressSubForm, self::ADDRESS_SUBFORM_NAME);
        //  $this->addSubForm($newCitySubForm, self::NEW_CITY_SUBFORM_NAME);
        $this->addSubForm($roomatesSubForm, self::ROOMATES_SUBFORM_NAME);
        $this->addSubForm($preferencesSubForm, self::PREFERENCES_SUBFORM_NAME);
        $this->addSubForm($accFeaturesSubForm, self::ACC_FEATURES_SUBFORM_NAME);
        $this->addSubForm($roomFeaturesSubForm, self::ROOM_FEATURES_SUBFORM_NAME);
        $this->addSubForm($appartmentDetailsForm, self::APPARTMENT_DETAILS);
        $this->addSubForm($aboutYouSubForm, self::ABOUT_YOU_SUBFORM_NAME);

        if ($bedFeaturesSubForm) {
            $this->addSubForm($bedFeaturesSubForm, self::BED_FEATURES_SUBFORM_NAME);
        }
        
         $this->setAttrib('id', 'accommodation-form');

        //  $this->addSubForm($photosSubForm, self::PHOTOS_SUBFORM_NAME);
        // Create a submit button.
        $this->addElement('submit', 'Submit', array('label'=>'Go to step 2'));
    }

    /**
     * Populate the form with accommodation information.
     * 
     * @param My_Houseshare_Accommodation|array $acc data for population
     * @return My_Form_Accommodation 
     */
    public function populateForm($acc) {
        if (is_array($acc)) {
            return parent::populate($acc);
        } else if ($acc instanceof My_Houseshare_Accommodation) {


            // jquery needs date in a different format than the one in database
            $date = new Zend_Date($acc->date_avaliable,'yyyy-MM-dd');

            
            // populate basinc info
            $baseInfoSubForm = $this->getSubForm(self::BASIC_INFO_SUBFORM_NAME);
            $baseInfoSubForm->populate(array(
                'acc_type' => $acc->type_id,
                'title' => $acc->title,
                'description' => $acc->description,
                'date_avaliable' => $date->toString('dd/MM/yyyy'),
                'short_term' => $acc->short_term_ok,
                'price' => $acc->price,
                'price_info' => $acc->price_info,
                'bond' => $acc->bond,
            ));

            // populate address
            $addressSubForm = $this->getSubForm(self::ADDRESS_SUBFORM_NAME);
            $addressSubForm->populate(array(
                'city' => $acc->getCity(),
               // 'state' => $acc->getState(),
                'unit_no' => $acc->address->unit_no,
                'street_no' => $acc->address->street_no,
                'address_public' => $acc->street_address_public,
                'street_name' => $acc->address->street,
              //  'zip' => $acc->address->zip,
            ));

            
            if (null !== $acc->roomates) {
                // populate roomates
                $roomatesSubForm = $this->getSubForm(self::ROOMATES_SUBFORM_NAME);
                $roomatesSubForm->populate(array(
                    'no_roomates' => $acc->roomates->no_roomates,
                    'min_age' => $acc->roomates->min_age,
                    'max_age' => $acc->roomates->max_age,
                    'gender' => $acc->roomates->gender,
                    'description' =>  $acc->roomates->description
                ));
            }

            // populate preferences
            $prefsSubForm = $this->getSubForm(self::PREFERENCES_SUBFORM_NAME);
            $this->_populateFeatsOrPrefs($prefsSubForm, $acc->preferences);
            $prefsSubForm->description->setValue($acc->preferences_info);


            // populate accommodation features
            $featsSubForm = $this->getSubForm(self::ACC_FEATURES_SUBFORM_NAME);
            $this->_populateFeatsOrPrefs($featsSubForm, $acc->features);
            $featsSubForm->description->setValue($acc->features_info);

            // populate room features in needed
            if ('Room' == $acc->type->name) {
                $roomSubForm = $this->getSubForm(self::ROOM_FEATURES_SUBFORM_NAME);
                $this->_populateFeatsOrPrefs($roomSubForm, $acc->features);
            }     
         
            return $this;
        }
    }

    /**
     * Populates checkboxex and select fields for features and preferences
     * 
     * @param Zend_Form $subForm
     * @param Zend_Db_Table_Rowset $rowset 
     */
    protected function _populateFeatsOrPrefs($subForm, $rowset) {
        foreach ($subForm->getElements() as $elem) {
            /* @var $elem Zend_Form_Element */
            $elemName = $elem->getName();
          //  var_dump($elemName);
            $row = $rowset->getByName($elemName);

            if (null === $row) {
                continue;
            }

            $val = $row->value;

            if ('Zend_Form_Element_Checkbox' == $elem->getType()) {
             //   var_dump($row->getName(), $elem->getName());
                //var_dump($elem->getValue());
                //$elem->setValue($row->value);
                $elem->setChecked(true);
                continue;
            }
                

            $elem->setValue($val);
        }
    }

}

?>
