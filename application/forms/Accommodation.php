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
        $appartmentDetailsForm = $this->_makeAppartmentDetailsSubForm();
        $aboutYouSubForm = $this->_makeAboutYouSubForm();
        $newCitySubForm = $this->_makeNewCitySubForm();

        $this->addSubForm($accInfoSubForm, self::BASIC_INFO_SUBFORM_NAME);
        $this->addSubForm($addressSubForm, self::ADDRESS_SUBFORM_NAME);
        $this->addSubForm($appartmentDetailsForm, self::APPARTMENT_DETAILS);
        
        $this->addSubForm($accFeaturesSubForm, self::ACC_FEATURES_SUBFORM_NAME);
        $this->addSubForm($roomatesSubForm, self::ROOMATES_SUBFORM_NAME);
        $this->addSubForm($preferencesSubForm, self::PREFERENCES_SUBFORM_NAME);        
        $this->addSubForm($aboutYouSubForm, self::ABOUT_YOU_SUBFORM_NAME);

        
         $this->setAttrib('id', 'accommodation-form');

        
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

            try {
                $roomates = $acc->roomates;
            } catch(Exception $e) {
                $roomates = null;
            }
            
            if (null !== $roomates) {
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
            $prefsSubForm->populate($acc->preferences->toArray());
           
            


            // populate accommodation features
            $featsSubForm = $this->getSubForm(self::ACC_FEATURES_SUBFORM_NAME);
            $featsSubForm->populate($acc->features->toArray());
            

            
            // populate appartment details if needed
            if ('Appartment' == $acc->type->name) {               
                
                 $appDetailsSubForm = $this->getSubForm(self::APPARTMENT_DETAILS);
                 $appDetailsSubForm->populate(array(
                     'bedrooms' => $acc->details->bedrooms,
                     'bathrooms' => $acc->details->bathrooms,
                     'parking_spots' => $acc->details->parking_spots,                    
                     'description' => $acc->details->description
                 ));
            }
            
         
            return $this;
        }
    }

   
    
    /**
     * Add cancel button.
     */
    public function addCancel() {
        $cancelButton = new Zend_Form_Element_Submit('cancel', 'Cancel');
        $this->addElement($cancelButton);       
    }

}

?>
