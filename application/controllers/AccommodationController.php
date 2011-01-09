<?php

class AccommodationController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function listAction() {
        // action body
    }

    public function addAction() {
        $city = $this->_request->getParam('city', null);
        @list($cityName, $stateName) = explode(', ', $city);

        $addAccForm = new My_Form_Accommodation();
        $addAccForm->setDefaultCity($cityName);
        $addAccForm->setDefaultState($stateName);

        if ($this->getRequest()->isPost()) {
            if ($addAccForm->isValid($_POST)) {

                 // get form data
                $formData = $addAccForm->getValues();

                // start transaction
                $db = Zend_Db_Table::getDefaultAdapter();
                $db->beginTransaction();

                try {

                    // save user in not registered (assume it is roomate)
                    // this is controlled by live_in_acc selecte element
                    // that for now is not used.
                    //@todo Add logic for checking if registered or not.
                    //@todo Add other types of users, not only roomates in the future.
                    $newUser = My_Houseshare_Factory::roomate();
                    $newUser->first_name = $formData['about_you']['first_name'];
                    $newUser->last_name = $formData['about_you']['last_name'];
                    $newUser->last_name_public = $formData['about_you']['last_name_public'];
                    $newUser->email = $formData['about_you']['email'];
                    $newUser->password = md5($formData['about_you']['password1']);
                    $newUser->phone = $formData['about_you']['phone_no'];
                    $newUser->phone_public = $formData['about_you']['phone_public'];
                    $newUser->type = 'ROOMATE';
                    $newUser->is_owner = 0; // at the moment don't use this field

                    $user_id = $newUser->save();

                    // save address in db
                    $newAddress = new My_Houseshare_Address();
                    $newAddress->unit_no = $formData['address']['unit_no'];
                    $newAddress->street_no = $formData['address']['street_no'];
                    $newAddress->street = $formData['address']['street_name'];
                    $newAddress->city = $formData['address']['city'];
                    $newAddress->zip = $formData['address']['zip'];
                    $newAddress->state = $formData['address']['state'];

                    $addr_id = $newAddress->save();

                    // save roomates information
                    $newRoomates = new My_Model_Table_Roomates();
                    $roomates_id = $newRoomates->setRoomates($formData['roomates']);

                    // save accommodation in db
                    $newAcc = My_Houseshare_Factory::shared();
                    $newAcc->title = $formData['basic_info']['title'];
                    $newAcc->description = $formData['basic_info']['description'];
                    $newAcc->date_avaliable = $formData['basic_info']['date_avaliable'];
                    $newAcc->price = $formData['basic_info']['price'];
                    $newAcc->bond = $formData['basic_info']['bond'];
                    $newAcc->street_address_public = $formData['address']['address_public'];
                    $newAcc->short_term_ok = $formData['basic_info']['short_term'];
                    $newAcc->setAddrId($addr_id);
                    $newAcc->setUserId($user_id);
                    $newAcc->setRoomatesId($roomates_id);
                    $newAcc->setTypeId($formData['basic_info']['acc_type']);
                    $acc_id = $newAcc->save();

                    // set preferences (first binary ones)
                    $accPrefModel = new My_Model_Table_AccsPreferences();
                    $binaryPrefs = array();
                    $binaryPrefs ['smokers'] = $formData['preferences']['smokers'];
                    $binaryPrefs ['kids'] = $formData['preferences']['kids'];
                    $binaryPrefs ['couples'] = $formData['preferences']['couples'];
                    $binaryPrefs ['pets'] = $formData['preferences']['pets'];


                    foreach ($binaryPrefs as $name => $pref_id) {
                        if (intval($pref_id) > -1) {
                            // if checked
                            $accPrefModel->setAccPreference(
                                    array('value' => 1),
                                    array('acc_id' => $acc_id, 'pref_id' => $pref_id)
                            );
                        }
                    }

                    // non binary preferences (i.e. gender)
                    $prefModel = new My_Model_Table_Preference();
                    $prefRow = $prefModel->fetchRow(" name = 'gender' ");
                    $accPrefModel->setAccPreference(
                            array('value' => $formData['preferences']['gender']),
                            array('acc_id' => $acc_id, 'pref_id' => $prefRow->pref_id)
                    );


                    // set features (first binary ones)
                    $accFeatModel = new My_Model_Table_AccsFeatures();
                    $binaryFeats = array();
                    $binaryFeats ['internet'] = $formData['acc_features']['internet'];
                    $binaryFeats ['parking'] = $formData['acc_features']['parking'];
                    $binaryFeats ['tv'] = $formData['acc_features']['tv'];
                    $binaryFeats ['airconditioning'] = $formData['acc_features']['airconditioning'];
                    if (isset($formData['room_features'])) {
                        $binaryFeats ['privatebath'] = $formData['room_features']['privatebath'];
                        $binaryFeats ['privatebalcony'] = $formData['room_features']['privatebalcony'];
                    }

                    foreach ($binaryFeats as $name => $feat_id) {
                        if (intval($feat_id) > -1) {
                            // if checked
                            $accFeatModel->setAccFeature(
                                    array('value' => 1),
                                    array('acc_id' => $acc_id, 'feat_id' => $feat_id)
                            );
                        }
                    }

                    // non binary features (i.e. furnished)
                    $featModel = new My_Model_Table_Feature();
                    $featRow = $featModel->fetchRow(" name = 'furnished' ");
                    $accFeatModel->setAccFeature(
                            array('value' => $formData['acc_features']['furnished']),
                            array('acc_id' => $acc_id, 'feat_id' => $featRow->feat_id)
                    );

                    $db->commit();
                } catch (Exception $e) {
                    $db->rollBack();
                    throw $e;
                }

                Zend_Debug::dump($addAccForm->getValues());
                return $this->_redirect('accommodation/success');
            } 
        }

        $this->view->form = $addAccForm;
    }

    public function deleteAction() {
        // action body
    }

    public function editAction() {
        // action body
    }

    public function successAction() {
        
    }

}

