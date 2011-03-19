<?php

class AccommodationController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        return $this->_forward('list');
    }

    public function showAction() {

        $acc_id = $this->getRequest()->getParam('id');

        if (empty($acc_id)) {
            $this->_helper->FlashMessenger('Cannot show accommodation defails');
            return $this->_redirect('/');
        }
        $acc_id = (int) $acc_id;
        $acc = My_Houseshare_Factory::accommodation($acc_id);


        // email sending form to send a question to the author of the advertisment
        $form = new My_Form_SendEmail();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {

                $advertCreaterEmail = $acc->user->email;
                $returnEmail = $form->getValue('email');
                $emailBody = $form->getValue('message');

                $emailObj = new My_Mail_AccQuery();
                $emailObj->setFrom($returnEmail);
                $emailObj->addTo($advertCreaterEmail);
                $emailObj->setBodyText($emailBody);

                try {
                    $emailObj->send();
                } catch (Zend_Mail_Exception $e) {
                    $this->_helper->FlashMessenger('There was a problem sending your message: ' . $e->getMessage());
                    return $this->_redirect('/accommodation/show/id/' . $acc_id);
                }

                $this->_helper->FlashMessenger('Your message was sent');
                return $this->_redirect('/accommodation/show/id/' . $acc_id);
            } else {
                $form->removeAttrib('style');
                $this->view->errors = 1;
            }
        } else {
            // this value is used in JS to scroll the window to form 
            // if there were some errors.
            $this->view->errors = 0;
        }

        $this->view->acc = $acc;
        $this->view->form = $form;
    }

    public function listAction() {

        $city = $this->_request->getParam('city', null);
        @list($cityName, $stateName) = explode(', ', $city);

        // fetch accommodations from database that match a give city

        $cityModel = new My_Model_Table_City();
        $cityRow = $cityModel->fetchRow("name = '$cityName'");

        $city_id = (is_null($cityRow)) ? null : $cityRow->city_id;


        $accModel = new My_Model_Table_Accommodation();
        $accSelect = $accModel->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);

        if (null !== $city_id) {
            $accSelect->joinInner('ADDRESS', 'ACCOMMODATION.addr_id = ADDRESS.addr_id')
                    ->where("ADDRESS.city_id = ?", $city_id);
        }


        $accs = $accModel->fetchAll($accSelect);

        $accHouseshareArray = array();
        foreach ($accs as $acc) {
            $accHouseshareArray [] = array('acc' => My_Houseshare_Factory::shared($acc->acc_id));
        }

        $this->view->accs = $accHouseshareArray;
    }

    public function addAction() {
        $city = $this->_request->getParam('city', null);
        @list($cityName, $stateName) = explode(', ', $city);

        $addAccForm = new My_Form_Accommodation();
        $addAccForm->setDefaultCity($cityName);
        $addAccForm->setDefaultState($stateName);

        if (Zend_Auth::getInstance()->hasIdentity()) {
            // if logged in, no need about_you subform.
            $addAccForm->removeSubForm('about_you');
        }

        if ($this->getRequest()->isPost()) {
            if ($addAccForm->isValid($_POST)) {

                // get form data
                $formData = $addAccForm->getValues();

                // start transaction
                $db = Zend_Db_Table::getDefaultAdapter();
                $db->beginTransaction();

                try {



                    if (Zend_Auth::getInstance()->hasIdentity()) {
                        // if logged in, no need about_you subform.
                        // just use logged user info.
                        $user_id = Zend_Auth::getInstance()->getIdentity()->property->user_id;
                    } else {
                        // otherise need to create a user.
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
                    }

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
                                    array('value' => 1), array('acc_id' => $acc_id, 'pref_id' => $pref_id)
                            );
                        }
                    }

                    // non binary preferences (i.e. gender)
                    $prefModel = new My_Model_Table_Preference();
                    $prefRow = $prefModel->fetchRow(" name = 'gender' ");
                    $accPrefModel->setAccPreference(
                            array('value' => $formData['preferences']['gender']), array('acc_id' => $acc_id, 'pref_id' => $prefRow->pref_id)
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
                                    array('value' => 1), array('acc_id' => $acc_id, 'feat_id' => $feat_id)
                            );
                        }
                    }

                    // non binary features (i.e. furnished)
                    $featModel = new My_Model_Table_Feature();
                    $featRow = $featModel->fetchRow(" name = 'furnished' ");
                    $accFeatModel->setAccFeature(
                            array('value' => $formData['acc_features']['furnished']), array('acc_id' => $acc_id, 'feat_id' => $featRow->feat_id)
                    );

                    $db->commit();
                } catch (Exception $e) {
                    $db->rollBack();
                    throw $e;
                }

                $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');
                $addAccInfoNamespace->acc_id = intval($acc_id);
                $addAccInfoNamespace->lock();


                return $this->_redirect('accommodation/addphotos');
                //return $this->_forward('addphotos');
            }
            //Zend_Debug::dump($addAccForm->getValues());
        }

        $this->view->form = $addAccForm;
    }

    public function deleteAction() {
        // action body
    }

    public function editAction() {
        $acc_id = $this->getRequest()->getParam('id', null);

        if (empty($acc_id)) {
            $this->_helper->FlashMessenger('Cannot edit accommodation defails');
            return $this->_redirect('/');
        }

        $acc_id = (int) $acc_id;

        $acc = My_Houseshare_Factory::accommodation($acc_id);

        $user_id = Zend_Auth::getInstance()->getIdentity()->property->user_id;

        // check if the accommodation belongs to the registered user
        if ($user_id != $acc->user->user_id) {
            $this->_helper->FlashMessenger('You cannot edit this accommodation');
            return $this->_redirect('/');
        }


        $accForm = new My_Form_Accommodation();
        $accForm->removeSubForm('about_you');


        $accForm->populateForm($acc);

        if ($this->getRequest()->isPost()) {
            if ($accForm->isValid($_POST)) {

                // get form data
                $formData = $accForm->getValues();

                // start transaction
                $db = Zend_Db_Table::getDefaultAdapter();
                $db->beginTransaction();

                try {

                    // save address in db
                    $newAddress = new My_Houseshare_Address($acc->addr_id);
                    $newAddress->unit_no = $formData['address']['unit_no'];
                    $newAddress->street_no = $formData['address']['street_no'];
                    $newAddress->street = $formData['address']['street_name'];
                    $newAddress->city = $formData['address']['city'];
                    $newAddress->zip = $formData['address']['zip'];
                    $newAddress->state = $formData['address']['state'];

                    $addr_id = $newAddress->save();

                    // save roomates information
                    $newRoomates = new My_Model_Table_Roomates();
                    $roomates_id = $newRoomates->setRoomates($formData['roomates'], $acc->roomates_id);

                    $acc->title = $formData['basic_info']['title'];
                    $acc->description = $formData['basic_info']['description'];
                    $acc->date_avaliable = $formData['basic_info']['date_avaliable'];
                    $acc->price = $formData['basic_info']['price'];
                    $acc->bond = $formData['basic_info']['bond'];
                    $acc->street_address_public = $formData['address']['address_public'];
                    $acc->short_term_ok = $formData['basic_info']['short_term'];
                    $acc->setAddrId($addr_id);
                    $acc->setRoomatesId($roomates_id);
                    $acc->setTypeId($formData['basic_info']['acc_type']);


                    if ($acc->save() != $acc_id) {
                        $db->rollBack();
                        throw new Zend_Db_Exception('Editted acc_id is different then updated');
                    }


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
                                    array('value' => 1), array('acc_id' => $acc_id, 'pref_id' => $pref_id)
                            );
                        }
                    }

                    // non binary preferences (i.e. gender)
                    $prefModel = new My_Model_Table_Preference();
                    $prefRow = $prefModel->fetchRow(" name = 'gender' ");
                    $accPrefModel->setAccPreference(
                            array('value' => $formData['preferences']['gender']), array('acc_id' => $acc_id, 'pref_id' => $prefRow->pref_id)
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
                                    array('value' => 1), array('acc_id' => $acc_id, 'feat_id' => $feat_id)
                            );
                        }
                    }

                    // non binary features (i.e. furnished)
                    $featModel = new My_Model_Table_Feature();
                    $featRow = $featModel->fetchRow(" name = 'furnished' ");
                    $accFeatModel->setAccFeature(
                            array('value' => $formData['acc_features']['furnished']), array('acc_id' => $acc_id, 'feat_id' => $featRow->feat_id)
                    );

                    $db->commit();
                } catch (Exception $e) {
                    $db->rollBack();
                    throw $e;
                }

                return $this->_redirect('accommodation/show/id/' . $acc_id);
            }
        }

        $accForm->getElement('Submit')->setLabel('Update');
        $this->view->form = $accForm;
    }

    public function addphotosAction() {

        // retrive just creatend accommodation info (e.g. acc_id) from session.
        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');

        if (null === $addAccInfoNamespace->acc_id) {
            //throw new Zend_Session_Exception('Cannot retrive accommodation info from session');
            $this->_helper->FlashMessenger('Cannot retrive accommodation info from session');
            return $this->_redirect('index');
        }

        $acc_id = $addAccInfoNamespace->acc_id;

        $photosForm = new My_Form_Photos();

        if ($this->getRequest()->isPost()) {
            if ($photosForm->isValid($_POST)) {

                if ($photosForm->skip->isChecked()) {
                    // if skip button was clicked
                    return $this->_redirect('accommodation/success');
                }

                $photoElem = $photosForm->getElement('photo');
                $adapter = $photoElem->getTransferAdapter();

                $i = 0;
                foreach ($adapter->getFileInfo() as $filename => $info) {
                    if (empty($info['tmp_name'])) {
                        continue;
                    }

                    $dateprefix = date("YmdHms") . '_';
                    $outBaseName = $dateprefix . ($i++);


                    // if there will be other accommodetions (e.g. for sell)
                    // photos can be uploaded to 'forsell' directory.
                    $uploadSubDir = 'forrent';



                    // manually receive the uploaded file, resize it and save it.
                    // files will be saved in dir PHOTOS_PATH/$uploaddir/.
                    $imgPath = My_Houseshare_Photo::resizeAndSave(
                                    $info['tmp_name'], PHOTOS_PATH, $outBaseName, $uploadSubDir
                    );



                    if (!file_exists($imgPath)) {
                        throw new Exception("Could not make file: $imgPath");
                    }
                    if (!is_readable($imgPath)) {
                        throw new Exception("File \"$imgPath\" is not readable");
                    }



                    // make a thumbnail of the image uploaded.
                    $thumbImgPath = My_Houseshare_Photo::makeThumb($imgPath);


                    if (!file_exists($thumbImgPath)) {
                        throw new Exception("Cound not make file: $thumbImgPath");
                    }
                    if (!is_readable($thumbImgPath)) {
                        throw new Exception("File \"$thumbImgPath\" is not readable");
                    }



                    // write the path and filename in PHOTO table.
                    // filepath is relative to PHOTOS_PATH constant.
                    // Thus full paths will be PHOTOS_PATH/$photo->path/$photo->filename
                    $photo = My_Houseshare_Factory::photo();
                    $photo->filename = basename($imgPath);
                    $photo->path = My_Houseshare_Tools::addDirSeperator($uploadSubDir);
                    $photo->setAccId($acc_id);

                    $photo_id = $photo->save();
                    if (!is_numeric($photo_id)) {
                        throw new Exception("Information about \"$imgPath\" was not saved in the database");
                    }
                }
                // everything went fine, so just redirect.
                return $this->_redirect('accommodation/success');
            }
        }

        $this->view->form = $photosForm;
    }

    public function photochangeAction() {
        $acc_id = $this->getRequest()->getParam('id', null);

        if (empty($acc_id)) {
            $this->_helper->FlashMessenger('Cannot edit accommodation defails');
            return $this->_redirect('/');
        }

        $acc_id = (int) $acc_id;

        $acc = My_Houseshare_Factory::accommodation($acc_id);

        $user_id = Zend_Auth::getInstance()->getIdentity()->property->user_id;

        // check if the accommodation belongs to the registered user
        if ($user_id != $acc->user->user_id) {
            $this->_helper->FlashMessenger('You cannot edit this accommodation');
            return $this->_redirect('/');
        }
    }

    public function successAction() {
        // retrive just creatend accommodation info (e.g. acc_id) from session.
        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');
        $acc_id = $addAccInfoNamespace->acc_id;
        $acc = null;

        if (null !== $acc_id) {
            $acc = My_Houseshare_Factory::accommodation($acc_id);
        } else {
            $this->_helper->FlashMessenger('Cannot retrive accommodation info from session');
            return $this->_redirect('index');
        }

        // don't need this session namespace anymore
        Zend_Session::namespaceUnset('addAccInfo');
        $this->view->acc = $acc;
    }

}

