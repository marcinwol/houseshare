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
        $this->addSubForm($aboutYouSubForm, self::ABOUT_YOU_SUBFORM_NAME);

        if ($bedFeaturesSubForm) {
            $this->addSubForm($bedFeaturesSubForm, self::BED_FEATURES_SUBFORM_NAME);
        }

        //  $this->addSubForm($photosSubForm, self::PHOTOS_SUBFORM_NAME);
        // Create a submit button.
        $this->addElement('submit', 'Submit');
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
            $baseInfoSubForm = $this->getSubForm(self::BASIC_INFO_SUBFORM_NAME);
            $baseInfoSubForm->populate(array(
                'acc_type' => $acc->type_id,
                'title'    => $acc->title,
                'description' => $acc->description,
                'date_avaliable' => $acc->date_avaliable,
                'short_term' => $acc->short_term_ok,
                'price' => $acc->price,
                'bond' => $acc->bond,
            )); 
            return $this;
        }
    }

}

?>
