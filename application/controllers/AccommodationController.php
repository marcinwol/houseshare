<?php

class AccommodationController extends Zend_Controller_Action {

    /**
     *
     * @var Zend_Cache_Core 
     */
    private $_cache;

    public function init() {

        $this->_cache = Zend_Controller_Front::getInstance()
                ->getParam('bootstrap')
                ->getResource('cachemanager')
                ->getCache('mycache');

        $this->_helper->cache(array('preview'), array('previewaction'));
        //  $this->_helper->cache(array('show'),array('showaction'));
    }

    public function indexAction() {
        return $this->_forward('list');
    }

    public function queryAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        if ($this->getRequest()->isXmlHttpRequest()) {
            $form = new My_Form_SendEmail();
            if ($this->getRequest()->isPost()) {
                if ($form->isValid($_POST)) {


                    $acc_id = $form->getValue('acc_id');
                    $emailFrom = $form->getValue('email');
                    $message = $form->getValue('message');

                    // get acc object from cache if possible
                    $cacheId = 'acc_' . $acc_id;
                    $acc = $this->_cache->load($cacheId);
                    if (!$acc) {
                        $acc = My_Houseshare_Factory::accommodation($acc_id);
                        $this->_cache->save($acc, $cacheId);
                    }

                    // send email 
                    $emailObj = new My_Mail_AccQuery($acc, $emailFrom, $message);

                    try {
                        $emailObj->send();
                    } catch (Zend_Mail_Exception $e) {
                        echo 'Problem with sending your message. Message not send!';
                    }

                    echo 'Your query was sent.';
                } else {
                    echo 'Form is not valid. Message not send';
                }
            }
        }

        exit;
    }

    public function showAction() {

        $acc_id = $this->getRequest()->getParam('id');

        if (empty($acc_id)) {
            $this->_helper->FlashMessenger('Cannot show accommodation defails');
            return $this->_redirect('/');
        }
        $acc_id = (int) $acc_id;




        // get acc object from cache if possible
        $cacheId = 'acc_' . $acc_id;
        $acc = $this->_cache->load($cacheId);
        if (!$acc) {
            $acc = My_Houseshare_Factory::accommodation($acc_id);
            $this->_cache->save($acc, $cacheId);
        }


        $auth = Zend_Auth::getInstance();


        // do not shown disabled adverts, except to the owner of it.
        if ($auth->hasIdentity()) {
            $user_id = $auth->getIdentity()->property->user_id;
            // check if the accommodation belongs to the registered user
            if ($user_id != $acc->user->user_id && $acc->is_enabled == 0) {
                $this->_helper->FlashMessenger('You cannot see this accommodation');
                return $this->_redirect('/');
            }
        } else {
            if ($acc->is_enabled == 0) {
                return $this->_redirect('/');
            }
        }



        // increase view count
        $acc->addOneView();


        // email sending form to send a question to the author of the advertisment
        $form = new My_Form_SendEmail();
        $form->acc_id->setValue($acc_id);

//        if ($this->getRequest()->isPost()) {
//
//            if ($form->isValid($_POST)) {
//
//                $advertCreaterEmail = $acc->user->email;
//                $returnEmail = $form->getValue('email');
//                $emailBody = $form->getValue('message');
//
//                $emailObj = new My_Mail_AccQuery();
//                $emailObj->setFrom($returnEmail);
//                $emailObj->addTo($advertCreaterEmail);
//                $emailObj->setBodyText($emailBody);
//
//                try {
//                    $emailObj->send();
//                } catch (Zend_Mail_Exception $e) {
//                    $this->_helper->FlashMessenger('There was a problem sending your message: ' . $e->getMessage());
//                    return $this->_redirect('/accommodation/show/id/' . $acc_id);
//                }
//
//                $this->_helper->FlashMessenger('Your message was sent');
//                return $this->_redirect('/accommodation/show/id/' . $acc_id);
//            } else {
//                $form->removeAttrib('style');
//                $this->view->errors = 1;
//            }
//        } else {
//            // this value is used in JS to scroll the window to form 
//            // if there were some errors.
//            $this->view->errors = 0;
//        }

        $this->view->acc = $acc;
        $this->view->form = $form;
    }

    public function previewAction() {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $this->_helper->layout->disableLayout();

            $acc_id = $this->getRequest()->getParam('id');

            $acc_id = (int) $acc_id;
            $acc = My_Houseshare_Factory::accommodation($acc_id);
            // increase view count
            $acc->addOneView();

            $this->view->acc = $acc;
        } else {
            throw new Exception('Not an ajax requrests');
        }
    }

    public function listAction() {

        $city_id = $cityName = $this->_request->getParam('city', null);
        $maxPrice = $this->_request->getParam('maxprice', null);
        $page = $this->_getParam('page', 1);

        if (is_null($city_id)) {
            $this->_helper->FlashMessenger('City must be specified');
            return $this->_redirect('/');
        }

        //@list($cityName, $stateName) = explode(', ', $city);
        //var_dump($cityName);
        // fetch accommodations from database that match a give city

        $cityModel = new My_Model_Table_City();
        $cityRow = $cityModel->find($city_id)->current();

        $city = is_null($cityRow) ? null : $cityRow->name;

        $limitForm = new My_Form_LimitForm();
        $limitForm->page->setValue($page);
        $limitForm->city->setValue($city_id);
        $limitForm->setAction($this->view->baseUrl('/accommodation/list'));



        if (null === $maxPrice) {
            $maxPrice = $limitForm->getElement('maxpricedefault')->getValue();
        } else {
            $limitForm->getElement('maxpricedefault')->setValue($maxPrice);
        }

        $bed = $limitForm->getElement('bed')->getCheckedValue();
        $room = $limitForm->getElement('room')->getCheckedValue();
        $appartment = $limitForm->getElement('appartment')->getCheckedValue();
        $internet = $limitForm->getElement('internet')->getCheckedValue();

        if ($this->getRequest()->isPost()) {
            if ($limitForm->isValid($_POST)) {
                $formData = $limitForm->getValues();

                $maxPrice = $formData['maxprice'];
                $bed = $formData['bed'];
                $room = $formData['room'];
                $appartment = $formData['appartment'];
                $internet = $formData['internet'];

                $limitForm->getElement('maxpricedefault')->setValue($maxPrice);
                $limitForm->getElement('bed')->setValue($bed);
                $limitForm->getElement('room')->setValue($room);
                $limitForm->getElement('internet')->setValue($internet);
            }
        }

        $accModel = new My_Model_Table_Accommodation();
        $accSelect = $accModel->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false);
        $accSelect->joinInner('ADDRESS', 'ACCOMMODATION.addr_id = ADDRESS.addr_id', array())
                ->joinLeft('ACCOMODATION_has_FEATURE', 'ACCOMMODATION.acc_id = ACCOMODATION_has_FEATURE.acc_id', array())
                ->where('ACCOMMODATION.is_enabled = ?', 1);



        if ($city_id) {
            $accSelect->where("ADDRESS.city_id = ?", (int) $city_id);
        }

        if ($limitForm->internet->isChecked()) {
            $accSelect->where("ACCOMODATION_has_FEATURE.feat_id IN ($internet)");
        }

        if ($maxPrice) {
            $accSelect->where("ACCOMMODATION.price < ?", $maxPrice);
        }

        $accSelect->where("ACCOMMODATION.type_id IN ($bed, $room, $appartment)");

        $accSelect->distinct();



        //$accs = $accModel->fetchAll($accSelect);
        $accPaginator = $accModel->getAccPaginator($accSelect, $page);

        if ($accPaginator->count() < $page) {
            $page = $accPaginator->count();
        }

        $this->view->maxPrice = $maxPrice;
        $this->view->cityRow = $cityRow;
        $this->view->limitForm = $limitForm;
        $this->view->listTitle = $city ? "Avaliable accommodation in $city" : 'Avaliable accommodation';
        $this->view->page = $page;
        $this->view->accs = $accPaginator;
    }

    public function addAction() {
        $city = $this->_request->getParam('city', null);
        @list($cityName, $stateName) = explode(', ', $city);


        $addAccForm = new My_Form_Accommodation();
        $addAccForm->setDefaultCity($cityName);
        //   $addAccForm->setDefaultState($stateName);

        if (Zend_Auth::getInstance()->hasIdentity()) {
            // if logged in, no need about_you subform.
            $addAccForm->removeSubForm('about_you');
        }

        if ($this->getRequest()->isPost()) {
            if ($addAccForm->isValid($_POST)) {

                // get form data
                $formData = $addAccForm->getValues();

                // save form data in a session for later use
                $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');
                $addAccInfoNamespace->step = array(1 => $formData);

                return $this->_redirect('accommodation/map');
            }
        }

        $this->view->form = $addAccForm;
    }

    public function mapAction() {


        // retrive created accommodation from session.                  
        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');


        if (!isset($addAccInfoNamespace->step)) {
            // no it is not. So exit from here
            $this->_helper->FlashMessenger('Cannot retrive accommodation info from session');
            return $this->_redirect('index');
        }



        $identity = Zend_Auth::getInstance()->getIdentity();


        // mark if this marker edition is for logged user 
        // (i.e. he/she updates his localization),
        // or this is adding a new accommodation.       
        $mapEdit = false;


//        if (!isset($addAccInfoNamespace->step[2])) {
//            // no session, so just check if this is a requested from logged user
//            // who wishes to edit map for one of his accommodations
//            $acc_id = $this->_getParam('id', null);
//
//            if (null === $acc_id || false === $identity) {
//                // no it is not. So exit from here
//                $this->_helper->FlashMessenger('Cannot retrive accommodation info from session');
//                return $this->_redirect('index');
//            }
//
//            $user_id = null;
//
//            if ($identity) {
//                $user_id = $identity->property->user_id;
//            }
//
//            $acc = My_Houseshare_Factory::accommodation($acc_id);
//
//            if ($user_id !== $acc->user->user_id) {
//                $this->_helper->FlashMessenger('You cannot see this accommodation');
//                return $this->_redirect('/');
//            }
//
//            // user is logged and this is his accommodation.
//            $showSteps = false;
//            $mapEdit = true;
//            $title = "Map localization";
//            $submitButtonText = "Update";
//            
//        } else {
//            //$acc = My_Houseshare_Factory::accommodation($acc_id);
//            $showSteps = true;
//            $title = "Step 2/3: Map localization";
//            $submitButtonText = "Go to step 3";
//        }
//        
        $showSteps = true;
        $title = "Step 2/3: Map localization";
        $submitButtonText = "Go to step 3";

        // var_dump($addAccInfoNamespace->step[1]['address']);
        //   exit;
        $mapForm = new My_Form_Map();
        //$mapForm->populateFromAcc($acc);
        $mapForm->populateFromAccArray($addAccInfoNamespace->step[1]['address']);
        $mapForm->getElement('Submit')->setLabel($submitButtonText);


        if ($this->getRequest()->isPost()) {
            if ($mapForm->isValid($_POST)) {

                $formData = $mapForm->getValues();

                if (false === $mapEdit) {
                    // if everything went fine go to step 3:
                    $addAccInfoNamespace->step[2] = $formData;
                    return $this->_redirect('accommodation/addphotos');
                }
            }
        }

        $this->view->showSteps = $showSteps;
        $this->view->title = $title;
        $this->view->form = $mapForm;
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
        $accForm->addCancel();

        // don't allow for changing accommodation type
        $accForm->basic_info->acc_type->setAttrib('disabled', true);
        $accForm->basic_info->acc_type->setRequired(false);

        // get acc_type from database
        $accTypeID = $acc->type_id;


        if ($this->getRequest()->isPost()) {
            if ($accForm->isValid($_POST)) {


                if ($accForm->cancel->isChecked()) {
                    // if cancel button was clicked                    
                    return $this->_redirect('/user');
                }

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
                    // $newAddress->zip = $formData['address']['zip'];
                    // $newAddress->state = $formData['address']['state'];

                    $addr_id = $newAddress->save();


                    // save accommodation in db
                    if ('3' == $accTypeID) {
                        // appartment
                        $newDetails = new My_Model_Table_NonSharedDetails();
                        $details_id = $newDetails->setDetails($formData['appartment_details'], $acc->details->details_id);

                        if ($acc->details->details_id != $details_id) {
                            $db->rollBack();
                            throw new Zend_Db_Exception('Edited details_id is different then updated');
                        }
                        // $newAcc = My_Houseshare_Factory::appartment();
                        // $newAcc->setDetailsId($details_id);
                    } else {
                        // shared accommodation
                        $newRoomates = new My_Model_Table_Roomates();
                        $roomates_id = $newRoomates->setRoomates($formData['roomates']);

                        $newAcc = My_Houseshare_Factory::shared();
                        $newAcc->setRoomatesId($roomates_id);
                    }


                    $acc->title = $formData['basic_info']['title'];
                    $acc->description = $formData['basic_info']['description'];
                    $acc->date_avaliable = $formData['basic_info']['date_avaliable'];
                    $acc->price = $formData['basic_info']['price'];
                    $acc->price_info = $formData['basic_info']['price_info'];
                    $acc->bond = $formData['basic_info']['bond'];
                    $acc->street_address_public = $formData['address']['address_public'];
                    $acc->short_term_ok = $formData['basic_info']['short_term'];
                    $acc->preferences_info = $formData['preferences']['description'];
                    $acc->features_info = $formData['acc_features']['description'];
                    $acc->setAddrId($addr_id);
                    //$acc->setTypeId($formData['basic_info']['acc_type']);


                    if ($acc->save() != $acc_id) {
                        $db->rollBack();
                        throw new Zend_Db_Exception('Editted acc_id is different then updated');
                    }


                    // set preferences (first binary ones)
                    $accPrefModel = new My_Model_Table_AccsPreferences();
                    // delete all prefes for this acc as new set will be created
                    $n = $accPrefModel->deleteAccPreference(array('acc_id' => $acc_id, 'pref_id' => null));

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
                    // delete all prefes for this acc as new set will be created
                    $accFeatModel->deleteAccFeature(array('acc_id' => $acc_id, 'feat_id' => null));
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
                $this->_helper->FlashMessenger('Accommodation data was changed');
                return $this->_redirect('user/index');
            }
        }

        $accForm->populateForm($acc);

        $accForm->getElement('Submit')->setLabel('Update');
        $this->view->form = $accForm;
    }

    public function addphotosAction() {

        // retrive just creatend accommodation info from session.
        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');

        if (!isset($addAccInfoNamespace->step)) {
            //throw new Zend_Session_Exception('Cannot retrive accommodation info from session');
            $this->_helper->FlashMessenger('Cannot retrive accommodation info from session');
            return $this->_redirect('index');
        }
//
//        $referer = $addAccInfoNamespace->referer;
//
//        $acc_id = $addAccInfoNamespace->acc_id;
//
//        $photoModel = new My_Model_Table_Photo();
//        $noOfcurrentAccPhotos = $photoModel->findAccPhotos($acc_id);
//
//        // determine number of photos that can be added.
//        $noOfPhotosToAdd = PHOTOS_NUMBER - count($noOfcurrentAccPhotos);
//
//        if ($noOfPhotosToAdd <= 0) {
//            $this->_helper->FlashMessenger('Cannot add more photos than 3');
//            return $this->_redirect('index');
//        }

        $photosForm = new My_Form_Photos();
        $photosForm->setNoOfPhotosToAdd(PHOTOS_NUMBER)->init();

        if ($this->getRequest()->isPost()) {
            if ($photosForm->isValid($_POST)) {

                if ($photosForm->skip->isChecked()) {
                    // if skip button was clicked
//                    if ('addphotos' == $referer) {
//                        // this is when a user add photos to existing accommodation
//                        // rather then creates when he/she creates a new accommodation.
//                        // don't need this session namespace anymore
//                        Zend_Session::namespaceUnset('addAccInfo');
//                        return $this->_redirect('accommodation/photochange/id/' . $acc_id);
//                    }
                    $addAccInfoNamespace->step[3] = array();
                    return $this->_redirect('accommodation/create-acc');
                }


                $savedPhotos = $this->_processUploads($photosForm);



                //if ('addphotos' == $referer) {
                // this is when a user add photos to existing accommodation
                // rather then creates when he/she creates a new accommodation.
                // don't need this session namespace anymore
                // Zend_Session::namespaceUnset('addAccInfo');
                // return $this->_redirect('accommodation/photochange/id/' . $acc_id);
                //}

                $addAccInfoNamespace->step[3] = $savedPhotos;

                // everything went fine, so just redirect.
                return $this->_redirect('accommodation/create-acc');
            }
        }

        $this->view->form = $photosForm;
    }

    /**
     * Process uploaded accommodation photos. 
     * 
     * @param type $photosForm
     * @param type $targetUrl
     * @return array 
     */
    private function _processUploads($photosForm, $targetUrl = 'accommodation/create-acc') {

        $photoElem = $photosForm->getElement('photo');
        $adapter = $photoElem->getTransferAdapter();

        $savedPhotos = array();
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


            $savedPhotos[] = array(
                'filename' => basename($imgPath),
                'path' => My_Houseshare_Tools::addDirSeperator($uploadSubDir)
            );
        }

        return $savedPhotos;
    }

    public function createAccAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        // retrive just creatend accommodation info from session.
        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');

        if (null === $addAccInfoNamespace->step || count($addAccInfoNamespace->step) < 3) {
            //throw new Zend_Session_Exception('Cannot retrive accommodation info from session');
            $this->_helper->FlashMessenger('Cannot retrive accommodation info from session');
            return $this->_redirect('index');
        }

        // retrive data from previous steps
        $step1Data = $addAccInfoNamespace->step[1];
        $step2Data = $addAccInfoNamespace->step[2];
        $step3Data = $addAccInfoNamespace->step[3];
        
//        var_dump($step2Data);
//        exit;

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
                $newUser->nickname = $step1Data['about_you']['nickname'];
                $newUser->description = $step1Data['about_you']['description'];
                $newUser->email = $step1Data['about_you']['email'];
                $newUser->email_public = $step1Data['about_you']['email_public'];
                $newUser->password = $step1Data['about_you']['password1'];
                $newUser->phone = $step1Data['about_you']['phone_no'];
                $newUser->phone_public = $step1Data['about_you']['phone_public'];
                $newUser->type = 'ROOMATE';
                $newUser->is_owner = 0; // at the moment don't use this field

                $user_id = $newUser->save();
            }

            
            
            // create marker
            $markerModel = new My_Model_Table_Marker();
            $marker_id = $markerModel->insertMarker(array(
                'lat' => $step2Data['addr_lat'],
                'lng' => $step2Data['addr_lng'],
            ));

            // save address in db
            $newAddress = new My_Houseshare_Address();
            $newAddress->unit_no = $step1Data['address']['unit_no'];
            $newAddress->street_no = $step1Data['address']['street_no'];
            $newAddress->street = $step1Data['address']['street_name'];
            $newAddress->city = $step1Data['address']['city'];

            $addr_id = $newAddress->save();
            
            // set the marker for this address
            $addressModel = new My_Model_Table_Address();
            $addressRow = $addressModel->find($addr_id)->current();
            
            if (null === $addressRow) {
                throw new Exception("Cannot get address of id $addr_id");
            }
            
            $addressRow->marker_id = $marker_id;
            if ($addr_id != $addressRow->save()) {
                throw new Exception("Cannot save marker for address of id $addr_id");
            }

            // save accommodation in db
            if ('3' == $step1Data['basic_info']['acc_type']) {
                // appartment
                $newDetails = new My_Model_Table_NonSharedDetails();
                $details_id = $newDetails->setDetails($step1Data['appartment_details']);
                $newAcc = My_Houseshare_Factory::appartment();
                $newAcc->setDetailsId($details_id);
            } else {
                // shared accommodation
                $newRoomates = new My_Model_Table_Roomates();
                $roomates_id = $newRoomates->setRoomates($step1Data['roomates']);

                $newAcc = My_Houseshare_Factory::shared();
                $newAcc->setRoomatesId($roomates_id);
            }

            $newAcc->title = $step1Data['basic_info']['title'];
            $newAcc->description = $step1Data['basic_info']['description'];
            $newAcc->date_avaliable = $step1Data['basic_info']['date_avaliable'];
            $newAcc->price = $step1Data['basic_info']['price'];
            $newAcc->price_info = $step1Data['basic_info']['price_info'];
            $newAcc->bond = $step1Data['basic_info']['bond'];
            $newAcc->street_address_public = $step1Data['address']['address_public'];
            $newAcc->short_term_ok = $step1Data['basic_info']['short_term'];
            $newAcc->preferences_info = $step1Data['preferences']['description'];
            $newAcc->features_info = $step1Data['acc_features']['description'];
            $newAcc->setAddrId($addr_id);
            $newAcc->setUserId($user_id);
            $newAcc->setTypeId($step1Data['basic_info']['acc_type']);

            $acc_id = $newAcc->save();

            // set preferences (first binary ones)
            $accPrefModel = new My_Model_Table_AccsPreferences();
            $binaryPrefs = array();
            $binaryPrefs ['smokers'] = $step1Data['preferences']['smokers'];
            $binaryPrefs ['kids'] = $step1Data['preferences']['kids'];
            $binaryPrefs ['couples'] = $step1Data['preferences']['couples'];
            $binaryPrefs ['pets'] = $step1Data['preferences']['pets'];

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
                    array('value' => $step1Data['preferences']['gender']), array('acc_id' => $acc_id, 'pref_id' => $prefRow->pref_id)
            );

            // set features (first binary ones)
            $accFeatModel = new My_Model_Table_AccsFeatures();
            $binaryFeats = array();
            $binaryFeats ['internet'] = $step1Data['acc_features']['internet'];
            $binaryFeats ['parking'] = $step1Data['acc_features']['parking'];
            $binaryFeats ['tv'] = $step1Data['acc_features']['tv'];
            $binaryFeats ['airconditioning'] = $step1Data['acc_features']['airconditioning'];
            if (isset($formData['room_features'])) {
                $binaryFeats ['privatebath'] = $step1Data['room_features']['privatebath'];
                $binaryFeats ['privatebalcony'] = $step1Data['room_features']['privatebalcony'];
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
                    array('value' => $step1Data['acc_features']['furnished']), array('acc_id' => $acc_id, 'feat_id' => $featRow->feat_id)
            );


            // if photos were uploaded
            if (count($step3Data)) {
                // write the path and filename in PHOTO table.
                // filepath is relative to PHOTOS_PATH constant.
                // Thus full paths will be PHOTOS_PATH/$photo->path/$photo->filename


                foreach ($step3Data as $photoData) {

                    $photo = My_Houseshare_Factory::photo();
                    $photo->filename = $photoData['filename'];
                    $photo->path = $photoData['path'];
                    $photo->setAccId($acc_id);


                    $photo_id = $photo->save();
                    if (!is_numeric($photo_id)) {
                        throw new Exception("Information about \"{$photoData['filename']}\" was not saved in the database");
                    }
                }
            }

            $db->commit();

            // save new acc_id in session
            $addAccInfoNamespace->acc_id = $acc_id;

            // everything went fine, so just redirect.
            return $this->_redirect('accommodation/success');
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }

    public function addphotosAction_old() {

        // retrive just creatend accommodation info from session.
        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');

        if (null === $addAccInfoNamespace->step) {
            //throw new Zend_Session_Exception('Cannot retrive accommodation info from session');
            $this->_helper->FlashMessenger('Cannot retrive accommodation info from session');
            return $this->_redirect('index');
        }

        $photosForm = new My_Form_Photos();
        $photosForm->setNoOfPhotosToAdd($noOfPhotosToAdd)->init();

        if ($this->getRequest()->isPost()) {
            if ($photosForm->isValid($_POST)) {

                if ($photosForm->skip->isChecked()) {
                    // if skip button was clicked

                    if ('addphotos' == $referer) {
                        // this is when a user add photos to existing accommodation
                        // rather then creates when he/she creates a new accommodation.
                        // don't need this session namespace anymore
                        Zend_Session::namespaceUnset('addAccInfo');
                        return $this->_redirect('accommodation/photochange/id/' . $acc_id);
                    }

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

                if ('addphotos' == $referer) {
                    // this is when a user add photos to existing accommodation
                    // rather then creates when he/she creates a new accommodation.
                    // don't need this session namespace anymore
                    Zend_Session::namespaceUnset('addAccInfo');
                    return $this->_redirect('accommodation/photochange/id/' . $acc_id);
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

        $form = new My_Form_ChangeImages();

        // show checkboxes for each image
        $form->setImages($acc->thumbsurls);
        $form->init2();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {

                if ($form->cancel->isChecked()) {
                    // if cancel button was clicked
                    return $this->_redirect('/');
                }

                $imagesToChange = $form->getValue('images');

                $delete = $form->getElement('delete');

                if ($delete && $delete->isChecked() && is_array($imagesToChange)) {
                    // if delete was pressed then delete selected photos

                    $noOfDeletedPhotos = $acc->deletePhotos($imagesToChange);

                    if (count($imagesToChange) != $noOfDeletedPhotos) {
                        throw new Zend_Db_Exception('Problem when deleting photos');
                    }
                    $this->_helper->FlashMessenger("$noOfDeletedPhotos photos were deleted");
                    return $this->_redirect('accommodation/photochange/id/' . $acc_id);
                }

                $add = $form->getElement('add');

                if ($add && $add->isChecked()) {
                    // if add was pressed then go to adding photos page

                    $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');
                    $addAccInfoNamespace->acc_id = intval($acc_id);
                    //$addAccInfoNamespace->setExpirationSeconds(60 * 5);
                    $addAccInfoNamespace->referer = 'addphotos';
                    $addAccInfoNamespace->lock();

                    return $this->_redirect('accommodation/addphotos');
                }


                var_dump($imagesToChange);
            }
        }

        $this->view->form = $form;
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
        $this->view->preview = true;
        $this->_helper->viewRenderer('show');
    }

    public function disableAction() {

        $this->_helper->viewRenderer->setNoRender(true);

        $acc_id = $this->getRequest()->getParam('id', null);

        if (empty($acc_id)) {
            $this->_helper->FlashMessenger('Cannot dissiable accommodation');
            return $this->_redirect('/');
        }

        $acc_id = (int) $acc_id;

        $acc = My_Houseshare_Factory::accommodation($acc_id);

        $user_id = Zend_Auth::getInstance()->getIdentity()->property->user_id;

        // check if the accommodation belongs to the registered user
        if ($user_id != $acc->user->user_id) {
            $this->_helper->FlashMessenger('You cannot disable this accommodation');
            return $this->_redirect('/');
        }

        $acc->is_enabled = 0;


        if ($acc->save() != $acc_id) {
            $db->rollBack();
            throw new Zend_Db_Exception('Returned acc_id is different then updated one');
        }

        $this->_helper->FlashMessenger('Accommodation was disabled');
        return $this->_redirect('/user/');
    }

    public function enableAction() {

        $this->_helper->viewRenderer->setNoRender(true);

        $acc_id = $this->getRequest()->getParam('id', null);

        if (empty($acc_id)) {
            $this->_helper->FlashMessenger('Cannot enable accommodation');
            return $this->_redirect('/');
        }

        $acc_id = (int) $acc_id;

        $acc = My_Houseshare_Factory::accommodation($acc_id);

        $user_id = Zend_Auth::getInstance()->getIdentity()->property->user_id;

        // check if the accommodation belongs to the registered user
        if ($user_id != $acc->user->user_id) {
            $this->_helper->FlashMessenger('You cannot enable this accommodation');
            return $this->_redirect('/');
        }

        $acc->is_enabled = 1;


        if ($acc->save() != $acc_id) {
            $db->rollBack();
            throw new Zend_Db_Exception('Returned acc_id is different then updated one');
        }

        $this->_helper->FlashMessenger('Accommodation was enabled');
        return $this->_redirect('/user/');
    }

}

