<?php

class AccommodationController extends Zend_Controller_Action {

    /**
     *
     * @var Zend_Cache_Core 
     */
    private $_cache;

    public function init() {

        $this->_cache = Zend_Registry::get('genericCache');

        // $this->_helper->cache(array('preview'), array('previewaction'));
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

//                    // get acc object from cache if possible
//                    $cacheId = 'acc_' . $acc_id;
//                    $acc = $this->_cache->load($cacheId);
//                    if (!$acc) {
//                        $acc = My_Houseshare_Factory::accommodation($acc_id);
//                        $this->_cache->save($acc, $cacheId);
//                    }
//                  
                    //$t1 = microtime(true);
                    $acc = My_Houseshare_Factory::accommodation($acc_id);
                    //$t2 = microtime(true);
                    // echo $t2-$t1;exit;
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



        //  $t1 = microtime(true);
        // get acc object from cache if possible
        $cacheId = 'acc_' . $acc_id;
        $acc = $this->_cache->load($cacheId);
        if (!$acc) {
            $acc = My_Houseshare_Factory::accommodation($acc_id);
            $this->_cache->save($acc, $cacheId);
        }


        /* set page for navigatoin */

        /* @var $navigation Zend_Navigation */
        $navigation = $this->view->navigation()->getContainer();
        /* @var $accshowPage My_Navigation_Page_AccShow */
        $accshowPage = $navigation->findBy('Name', 'accshow');
        $accshowPage->setAcc($acc);



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
        $form->prefillMessage($acc);
        $form->acc_id->setValue($acc_id);

        $this->view->acc = $acc;
        $this->view->form = $form;
    }

    public function previewAction() {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $this->_helper->layout->disableLayout();

            $acc_id = $this->getRequest()->getParam('id');

            $acc_id = (int) $acc_id;
            $cacheId = 'acc_' . $acc_id;
            $acc = $this->_cache->load($cacheId);
            if (!$acc) {
                $acc = My_Houseshare_Factory::accommodation($acc_id);
                $this->_cache->save($acc, $cacheId);
            }
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
        $accType = $this->_request->getParam('acctype', null);
        $page = $this->_getParam('page', 1);

        if (empty($city_id)) {
            $this->_helper->FlashMessenger('City must be specified');
            return $this->_redirect('/');
        }

        //@list($cityName, $stateName) = explode(', ', $city);
        //var_dump($cityName);
        // fetch accommodations from database that match a give city

        $cityModel = new My_Model_Table_City();
        $cityRow = $cityModel->find($city_id)->current();


        /* set page for navigatoin */

        /* @var $navigation Zend_Navigation */
        $navigation = $this->view->navigation()->getContainer();
        /* @var $accshowPage My_Navigation_Page_AccShow */
        $acclistPage = $navigation->findBy('Name', 'acclist');
        $acclistPage->setCity($cityRow);




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

        $bed = $room = $appartment = 0;

        // if accType given than show only this type and disable other types
        if (!is_null($accType)) {
            if ($limitForm->getElement('bed')->getCheckedValue() == $accType) {
                $bed = $limitForm->getElement('bed')->getCheckedValue();
                $limitForm->getElement('bed')->setValue($bed);
            } else if ($limitForm->getElement('room')->getCheckedValue() == $accType) {
                $room = $limitForm->getElement('room')->getCheckedValue();
                $limitForm->getElement('room')->setValue($room);
            } else if ($limitForm->getElement('appartment')->getCheckedValue() == $accType) {
                $appartment = $limitForm->getElement('appartment')->getCheckedValue();
                $limitForm->getElement('appartment')->setValue($appartment);
            }
        } else {
            //no accType given, so show all types
            $bed = $limitForm->getElement('bed')->setChecked(true)->getCheckedValue();
            $room = $limitForm->getElement('room')->setChecked(true)->getCheckedValue();
            $appartment = $limitForm->getElement('appartment')->setChecked(true)->getCheckedValue();
        }



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


        // make a list of accommodation that meets the limit criteria
        $conditions = array();

        if ($city_id) {
            $conditions['city_id'] = $city_id;
        }

        if ($limitForm->internet->isChecked()) {
            // whatever value is good here, not only true
            $conditions['internet'] = true;
        }

        if ($maxPrice) {
            $conditions['price'] = $maxPrice;
        }

        $conditions['type_id'] = "($bed, $room, $appartment)";


        // get the select statement
        $accModel = new My_Model_Table_Accommodation();
        $accSelect = $accModel->getListofAccommodations($conditions);


        // get the paginator for the above select statement      
        $accPaginator = $accModel->getAccPaginator($accSelect, $page);

        if ($accPaginator->count() < $page) {
            $page = $accPaginator->count();
        }

        // set variables to be used in a list.phtml
        $this->view->maxPrice = $maxPrice;
        $this->view->cityRow = $cityRow;
        $this->view->city_id = $city_id;
        $this->view->limitForm = $limitForm;
        $this->view->city = $city;
        $this->view->listTitle = $city ? "Avaliable accommodation in $city" : 'Avaliable accommodation';
        $this->view->page = $page;
        $this->view->accs = $accPaginator;
    }

    public function addAction() {

        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');

        $city = $this->_request->getParam('city', null);
        @list($cityName, $stateName) = explode(', ', $city);


        $addAccForm = new My_Form_Accommodation();
        $addAccForm->setDefaultCity($cityName);
        //   $addAccForm->setDefaultState($stateName);

        if (Zend_Auth::getInstance()->hasIdentity()) {
            // if logged in, no need about_you subform.
            $addAccForm->removeSubForm('about_you');
        }

        $this->view->formInValid = false;
        $this->view->formMessages = array();

        if ($this->getRequest()->isPost()) {
            if ($addAccForm->isValid($_POST)) {

                // get form data
                $formData = $addAccForm->getValues();

                // save form data in a session for later use              
                $addAccInfoNamespace->step[1] = $formData;

                return $this->_redirect('accommodation/map');
            } else {
                $this->view->formInValid = true;
                $this->view->formMessages = $addAccForm->getMessages(null, true);
            }
        } else {
            if (isset($addAccInfoNamespace->step[1])) {
                $addAccForm->populate($addAccInfoNamespace->step[1]);
            }
        }

        $this->view->form = $addAccForm;
    }

    public function mapAction() {


        // retrive created accommodation from session.                  
        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');

        $mapForm = new My_Form_Map();


        if (!isset($addAccInfoNamespace->step)) {
            // no session, so just check if this is a requested from logged user
            // who wishes to edit map for one of his accommodations

            $acc_id = $this->_getParam('id', null);

            $acc = $this->_getAccForEdit($acc_id);

            if (null === $acc) {
                $this->_helper->FlashMessenger("Cannot edit accommodation $acc_id");
                return $this->_redirect('index');
            }

            /* set page for navigatoin */
            /* @var $navigation Zend_Navigation */
            $navigation = $this->view->navigation()->getContainer();
            /* @var $accshowPage My_Navigation_Page_AccShow */
            $accmapeditPage = $navigation->findBy('Name', 'accmapedit');
            $accmapeditPage->setAcc($acc);

            // it seems that user is loged and this accommodation belongs to him            
            $mapForm->populateFromAcc($acc);
            $mapForm->addCancelButton();
            $showSteps = false;
            $mapEdit = true;
            $title = "Map localization";
            $submitButtonText = "Update";
        } else {
            // mark if this marker edition is for logged user 
            // (i.e. he/she updates his localization),
            // or this is adding a new accommodation.       
            $mapForm->populateFromAccArray($addAccInfoNamespace->step[1]['address']);
            $mapEdit = false;
            $showSteps = true;
            $title = "Step 2: Map localization";
            $submitButtonText = "Go to step 3";
        }



        $mapForm->getElement('Submit')->setLabel($submitButtonText);


        if ($this->getRequest()->isPost()) {

            if (true == isset($_POST['cancel'])) {
                return $this->_redirect('/user');
            }

            if ($mapForm->isValid($_POST)) {

                $formData = $mapForm->getValues();

                if (false === $mapEdit) {
                    // this is not mapEdit, but adding new marker
                    // during advertisment adding
                    // if everything went fine save data into session
                    // and go to step 3:
                    $addAccInfoNamespace->step[2] = $formData;
                    return $this->_redirect('accommodation/addphotos');
                }

                // this is mapedit, so perform map marker update
                // save/update the marker 
                /* @var $address My_Houseshare_Address */
                $address = $acc->address;
                $address->lat = $formData['addr_lat'];
                $address->lng = $formData['addr_lng'];
                $addr_id = $address->save(true); // true because we want to do an update.

                if ($addr_id !== $acc->address->id) {
                    $acc->setAddrId($addr_id);

                    if ($acc->save() !== $acc_id) {
                        throw new Zend_Db_Exception("Updated acc_id=$id !== current acc_id=$acc_id");
                    }
                }

                $this->_helper->FlashMessenger('Lokalization on the map was changed');
                return $this->_redirect('user/');
            }
        } else {
            if (isset($addAccInfoNamespace->step[2])) {
                $mapForm->populate($addAccInfoNamespace->step[2]);
            }
        }

        $this->view->showSteps = $showSteps;
        $this->view->title = $title;
        $this->view->form = $mapForm;
    }

    public function fullMapViewAction() {

        $city_id = $cityName = $this->_request->getParam('city', null);
        $maxPrice = $this->_request->getParam('maxprice', null);

        $conditions = array();

        //if city_id is given, than center map in this city and show 
        // accomodations only from this city
        if (!empty($city_id) && is_numeric($city_id)) {

            $cityModel = new My_Model_Table_City();
            $cityRow = $cityModel->find($city_id)->current();

            // set city coordinates that are needed to
            // cetner google map at
            $this->view->cityLat = $cityRow->getMarker()->lat;
            $this->view->cityLng = $cityRow->getMarker()->lng;


            //create instance of LimitForm
            $limitForm = new My_Form_LimitForm();
            $limitForm->city->setValue($city_id);
            $limitForm->setAction($this->view->baseUrl('/accommodation/full-map-view'));
            $this->view->limitForm = $limitForm;

            if (null === $maxPrice) {
                $maxPrice = $limitForm->getElement('maxpricedefault')->getValue();
            } else {
                $limitForm->getElement('maxpricedefault')->setValue($maxPrice);
            }

            $bed = $room = $appartment = 0;


            $bed = $limitForm->getElement('bed')->setChecked(true)->getCheckedValue();
            $room = $limitForm->getElement('room')->setChecked(true)->getCheckedValue();
            $appartment = $limitForm->getElement('appartment')->setChecked(true)->getCheckedValue();


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


            // make a list of accommodation that meets the limit criteria
            $conditions = array();

            if ($city_id) {
                $conditions['city_id'] = $city_id;
            }

            if ($limitForm->internet->isChecked()) {
                // whatever value is good here, not only true
                $conditions['internet'] = true;
            }

            if ($maxPrice) {
                $conditions['price'] = $maxPrice;
            }

            $conditions['type_id'] = "($bed, $room, $appartment)";




            // set the navigation such that it shows city in the breadcrumbs
            // for this purpose navigation_map.xml is used.
            /* @var $navigation Zend_Navigation */
            $container = new Zend_Navigation(
                            new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation_map.xml', 'nav')
            );

            // set the city for AccList page
            $acclistPage = $container->findBy('Name', 'acclist');
            $acclistPage->setCity($cityRow);
            $acclistPage->setParams();

            // use this new container instead of the default one
            // from Bootstrap.php
            $this->view->navigation()->setContainer($container);
        } else {
            // if no city is specified, map will be set tu detault values
            // i.e. to the center of a country
            $this->view->cityLat = '';
            $this->view->cityLng = '';
            $this->view->limitForm = null;
        }

        // fetch accommodations form database
        $accModel = new My_Model_Table_Accommodation();
        $select = $accModel->getListofAccommodations($conditions);
        $models = $accModel->fetchAll($select)->toModels();

        // prepare JSON accData for use in javascript
        $accData = array();

        $noPicUrl = $this->view->baseUrl('/images/thumbs/no_pic.jpg');

        foreach ($models as $acc) {

            $firstThumbPath = $noPicUrl;

            if (count($acc->photos) > 0) {
                $urls = $acc->thumbsurls;
                $firstThumbPath = array_shift($urls);
            }

            $legendType = $this->view->translate('Type');
            $legendCreated = $this->view->translate('Created');
            $legendPrice = $this->view->translate('Price');
            $legendAddress = $this->view->translate('Address');
            $legendReadMore = $this->view->translate('Read more');

            $accData [] = array(
                'title' => $this->view->truncate(ucfirst(strtolower($acc->title)), 0, 35),
                'type' => "$legendType: {$acc->getTypeAsString()}",
                'created' => "$legendCreated: {$this->view->timeSince($acc->creationtimestamp)}",
                'lat' => $acc->address->lat,
                'lng' => $acc->address->lng,
                'price' => "$legendPrice: {$acc->price} PLN/miesiac",
                'internet' => $acc->features->getAsString('internet'),
                'address' => "$legendAddress: {$this->view->address($acc)}",
                'link' => "<a href=\"{$this->view->accUrl($acc)}\">$legendReadMore</a>",
                'thumbLink' => $firstThumbPath
            );
        }

        $this->view->accData = $accData;
    }

    public function migrateAction() {

        $acc_id = $this->getRequest()->getParam('id', null);

        if (false === ($acc = $this->_ifAccBelongsToLoggedUser($acc_id))) {
            return $this->_redirect('/');
        }

        $this->_helper->viewRenderer->setNoRender(true);

        // this var will keep acc data that will be used to populate 
        // acc/add form.
        $accData = array();

        // jquery needs date in a different format than the one in database
        $date = new Zend_Date($acc->date_avaliable, 'yyyy-MM-dd');


        $accData['basic_info'] = array(
            'acc_type' => $acc->type_id,
            'title' => $acc->title,
            'description' => $acc->description,
            'date_avaliable' => $date->toString('dd/MM/yyyy'),
            /* 'short_term' => $acc->short_term_ok, */
            'price' => $acc->price,
            'price_info' => $acc->price_info,
            'bond' => $acc->bond
        );

        $accData['address'] = array(
            'unit_no' => $acc->address->unit_no,
            'street_no' => $acc->address->street_no,
            'street_name' => $acc->address->street,
            'city' => $acc->getCity(),
            'address_public' => $acc->street_address_public
        );

        try {
            $roomates = $acc->roomates;
        } catch (Exception $e) {
            $roomates = null;
        }

        if (null !== $roomates) {
            // populate roomates
            $accData['roomates'] = array(
                'no_roomates' => $acc->roomates->no_roomates,
                'min_age' => $acc->roomates->min_age,
                'max_age' => $acc->roomates->max_age,
                'gender' => $acc->roomates->gender,
                'description' => $acc->roomates->description
            );
        }

        $accData['preferences'] = $acc->preferences->toArray();
        $accData['features'] = $acc->features->toArray();

        // populate appartment details if needed
        if ('Appartment' == $acc->type->name) {

            $accData['appartment_details'] = array(
                'bedrooms' => $acc->details->bedrooms,
                'bathrooms' => $acc->details->bathrooms,
                'parking_spots' => $acc->details->parking_spots,
                'description' => $acc->details->description
            );
        }


        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');
        $addAccInfoNamespace->step[1] = $accData;

        return $this->_redirect('accommodation/add');
    }

    public function editAction() {

        $acc_id = $this->getRequest()->getParam('id', null);

        if (false === ($acc = $this->_ifAccBelongsToLoggedUser($acc_id))) {
            return $this->_redirect('/');
        }


        /* set page for navigatoin */
        /* @var $navigation Zend_Navigation */
        $navigation = $this->view->navigation()->getContainer();
        /* @var $accshowPage My_Navigation_Page_AccShow */
        $userindexPage = $navigation->findBy('Name', 'accedit');
        $userindexPage->setAcc($acc);


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

                    $addr_id = $newAddress->save();


                    // set preferences 
                    $prefModel = new My_Model_Table_Preferences();
                    $noOfRowUpdated = $prefModel->update(
                                    $formData['preferences'], 'preferences_id = ' . $acc->preferences->preferences_id
                    );


                    // set features 
                    $featModel = new My_Model_Table_Features();
                    $noOfRowUpdated = $featModel->update(
                                    $formData['features'], 'features_id = ' . $acc->features->features_id
                    );



                    // save accommodation in db
                    if ('3' == $accTypeID) {
                        // set appartment details 
                        $appartmentDetailsModel = new My_Model_Table_NonSharedDetails();
                        $noOfRowUpdated = $appartmentDetailsModel->update(
                                        $formData['appartment_details'], array('details_id ', $acc->details->details_id)
                        );
                    } else {
                        // shared accommodation
                        $acc->roomates->save($formData['roomates']);
                        $newRoomates = new My_Model_Table_Roomates();
                        $roomates_id = $newRoomates->setRoomates($formData['roomates']);
                    }

                    // if changing accommodation type, e.g. from room to appartment
                    // need to create/delete rows in APPARTMENT/SHARED tabels
                    // to reflect this this
//                    if ($acc->type_id != $formData['basic_info']['acc_type']) {
//                        $oldType = $acc->type_id;
//                        $newTypeId = $formData['basic_info']['acc_type'];
//                        
//                        
//
//                        // if changing from room or place in a room into apprtment
//                        // delete SHARED and create APPARTMENT row
//                        if ($newTypeId == 3 && ($oldType == 2 || $oldType == 2)) {
//
//
//                            // set appartment details for this 'new' appartment
//                            $appDetailsModel = new My_Model_Table_NonSharedDetails();
//                            $details_id = $appDetailsModel->insert($formData['appartment_details']);
//
//                            // make APPARTMENT row
//                            $appartmentModel = new My_Model_Table_Appartment();
//                            $app_id = $appartmentModel->insert(
//                                            array(
//                                                'acc_id' => $acc_id,
//                                                'details_id' => $details_id
//                                            )
//                            );
//
//                            if ($app_id != $acc_id) {
//                                 $db->rollBack();
//                                throw new Zend_Db_Exception('Inserted appartment id != of acc_id');
//                            }
//
//                            // since APPARTMENT row was created, remove 
//                            // SHARED row and associated ROOMATES details
//                            $sharedModel = new My_Model_Table_Shared();
//                            $sharedRow = $sharedModel->fetchRow("acc_id = $acc_id");
//                            $roomatesRow = $sharedRow->getRoomates();                           
//                            $noOfDeleted = $sharedRow->delete();
//                            $roomatesRow->delete();
//                           // var_dump($noOfDeleted);exit;
//                            
//                            // generate new accommodation model
//                            $acc = new My_Houseshare_Appartment($acc_id);
//                            
//                            
//                        } elseif (($newTypeId == 2 || $newTypeId == 1) && $oldType == 3) {
//                            // if changing from appartment to shared do the oposite to above
//                            
//                            
//                            // set roomates for this 'new' shared acc
//                            $newRoomates = new My_Model_Table_Roomates();
//                            $roomates_id = $newRoomates->setRoomates($formData['roomates']);
//                            
//                            
//                             // make SHARED row
//                            $sharedModel = new My_Model_Table_Shared();
//                            $shared_id = $sharedModel->insert(
//                                            array(
//                                                'acc_id' => $acc_id,
//                                                'roomates_id' => $roomates_id
//                                            )
//                            );
//
//                            if ($shared_id != $acc_id) {
//                                throw new Zend_Db_Exception('Inserted appartment id != of acc_id');
//                            }
//                            
//                            // since SHARED row was created, remove 
//                            // APPARTMENT row and associated NONSHARE_ACC_DETAILS
//                            $appModel = new My_Model_Table_Appartment();
//                            $appRow = $appModel->fetchRow("acc_id = $acc_id");
//                            $detailsRow = $appRow->getDetails();                          
//                            $noOfDeleted = $appRow->delete(); 
//                            $detailsRow->delete();          
//                            
//                            // generate new accommodation model
//                            $acc =  $acc = new My_Houseshare_Shared($acc_id);;
//                            
//                        }
//                    }


                    $acc->title = $formData['basic_info']['title'];
                    $acc->description = $formData['basic_info']['description'];
                    $acc->date_avaliable = $formData['basic_info']['date_avaliable'];
                    $acc->price = $formData['basic_info']['price'];
                    $acc->price_info = $formData['basic_info']['price_info'];
                    $acc->bond = $formData['basic_info']['bond'];
                    $acc->street_address_public = $formData['address']['address_public'];
                    /* $acc->short_term_ok = $formData['basic_info']['short_term']; */
                    $acc->setAddrId($addr_id);
                    // $acc->setTypeId($formData['basic_info']['acc_type']);


                    if ($acc->save() != $acc_id) {
                        $db->rollBack();
                        throw new Zend_Db_Exception('Editted acc_id is different then updated');
                    }

                    //clean this acc's cache
                    $this->_cache->remove('acc_' . $acc_id);
                    // clean output cache for this acc
                    $this->view->viewCache()->remove('acc' . $acc_id);


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
            // no session, so just check if this is a requested from logged user
            // who wishes to edit map for one of his accommodations

            $acc_id = $this->_getParam('id', null);


            $acc = $this->_getAccForEdit($acc_id);

            if (null === $acc) {
                $this->_helper->FlashMessenger("Cannot edit accommodation $acc_id");
                return $this->_redirect('index');
            }

            // it seems that user is loged and this accommodation belongs to him            
            // determine number of photos that can be added.
            $noOfPhotosToAdd = PHOTOS_NUMBER - count($acc->photos);

            if ($noOfPhotosToAdd <= 0) {
                $this->_helper->FlashMessenger('Cannot add more photos than ' . PHOTOS_NUMBER . 'photos');
                return $this->_redirect('index');
            }

            $photoEdit = true;
            $showSteps = false;
            $title = "Photos";
        } else {
            // mark if this photos adding is for logged user 
            // (i.e. he/she updates his photos),
            // or this is adding a new accommodation.    
            $noOfPhotosToAdd = PHOTOS_NUMBER;
            $photoEdit = false;
            $showSteps = true;
            $title = "Step 3: Photos";
        }



        $photosForm = new My_Form_Photos();
        $photosForm->setNoOfPhotosToAdd($noOfPhotosToAdd)->init();

        if ($this->getRequest()->isPost()) {
            if ($photosForm->isValid($_POST)) {



                if ($photosForm->skip->isChecked()) {
                    // if skip button was clicked
                    if (true == $photoEdit) {
                        // this is when a user add photos to existing accommodation
                        // rather then creates when he/she creates a new accommodation.
                        // don't need this session namespace anymore
                        return $this->_redirect('accommodation/photochange/id/' . $acc_id);
                    }

                    $addAccInfoNamespace->step[3] = array();
                    return $this->_redirect('accommodation/create-acc');
                }


                $savedPhotos = $this->_processUploads($photosForm);

                if (false == $photoEdit) {
                    // if this addition of photos for a new acc
                    // than save photos data in a session and 
                    // go to next step.
                    $addAccInfoNamespace->step[3] = $savedPhotos;

                    // everything went fine, so just redirect.
                    return $this->_redirect('accommodation/create-acc');
                }

                // this is addition of photos for an existing acc
                // so add the new photos now.

                foreach ($savedPhotos as $photoData) {

                    $photo = My_Houseshare_Factory::photo();
                    $photo->filename = $photoData['filename'];
                    $photo->path = $photoData['path'];
                    $photo->setAccId($acc_id);


                    $photo_id = $photo->save();
                    if (!is_numeric($photo_id)) {
                        throw new Exception("Information about \"{$photoData['filename']}\" was not saved in the database");
                    }
                }

                $cache = Zend_Registry::get('genericCache');
                $cacheId = 'photos' . $acc->acc_id;
                $cache->remove($cacheId);


                return $this->_redirect('accommodation/photochange/id/' . $acc_id);
            }
        }

        $this->view->showSteps = $showSteps;
        $this->view->title = $title;
        $this->view->form = $photosForm;
    }

    /**
     * Check if we have everything that is needed for editing accommodation
     * info (e.g. marker and photos). 
     * 
     * Basically what we need is an acc_id, user_id, and we need to make
     * sure that acc_id belongs to a user identified by user_id.
     * 
     * @return My_Houseshare_Accommodation|null 
     */
    private function _getAccForEdit($acc_id) {

        $identity = Zend_Auth::getInstance()->getIdentity();


        // make sure we have $acc_id and $identity
        if (null === $acc_id || null === $identity) {
            // no it is not. So exit from here            
            return null;
        }


        // get user's id
        $user_id = null;

        if ($identity) {
            $user_id = $identity->property->user_id;
        }

        // check if a given accommodation belongs to this user
        $acc = My_Houseshare_Factory::accommodation($acc_id);

        if ($user_id !== $acc->user->user_id) {
            return null;
        }

        return $acc;
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


            // set preferences 
            $prefModel = new My_Model_Table_Preferences();
            $pref_id = $prefModel->insert($step1Data['preferences']);


            // set features 
            $featModel = new My_Model_Table_Features();
            $feat_id = $featModel->insert($step1Data['features']);



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
            /* $newAcc->short_term_ok = $step1Data['basic_info']['short_term']; */
            $newAcc->setAddrId($addr_id);
            $newAcc->setUserId($user_id);
            $newAcc->setTypeId($step1Data['basic_info']['acc_type']);
            $newAcc->setFeaturesId($feat_id);
            $newAcc->setPreferencesId($pref_id);

            $acc_id = $newAcc->save();

            // create and save tinyUrl for this acc
            $tinyUrl = $newAcc->createTinyUrl();
            $accModel = new My_Model_Table_Accommodation();
            $accRow = $accModel->find($acc_id)->current();
            $accRow->tinyurl = $tinyUrl;
            if ($acc_id != $accRow->save()) {
                throw new Exception("Cannot save tinyUrl for acc $acc_id");
            }



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

    /**
     * Checks if acc_id is not empty and if given acc_id belongs
     * to currently logged user. 
     *     
     * @param type $acc_id
     * @return My_Houseshare_Accommodation false if acc_id is empty or acc_id does not belong to current user
     */
    protected function _ifAccBelongsToLoggedUser($acc_id = null) {

        if (empty($acc_id)) {
            $this->_helper->FlashMessenger('Cannot edit accommodation defails');
            return false;
        }

        $acc_id = (int) $acc_id;

        $acc = My_Houseshare_Factory::accommodation($acc_id);

        $user_id = Zend_Auth::getInstance()->getIdentity()->property->user_id;

        // check if the accommodation belongs to the registered user
        if ($user_id != $acc->user->user_id) {
            $this->_helper->FlashMessenger('You cannot edit this accommodation');
            return false;
        }

        return $acc;
    }

    public function photochangeAction() {
        $acc_id = $this->getRequest()->getParam('id', null);


        if (false === ($acc = $this->_ifAccBelongsToLoggedUser($acc_id))) {
            return $this->_redirect('/');
        }

        /* set page for navigatoin */
        /* @var $navigation Zend_Navigation */
        $navigation = $this->view->navigation()->getContainer();
        /* @var $accshowPage My_Navigation_Page_AccShow */
        $accphotoeditPage = $navigation->findBy('Name', 'accphotoedit');
        $accphotoeditPage->setAcc($acc);

        $form = new My_Form_ChangeImages();

        // show checkboxes for each image
        $form->setImages($acc->thumbsurls);
        $form->init2();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {

                if ($form->cancel->isChecked()) {
                    // if cancel button was clicked
                    return $this->_redirect('user/');
                }

                $cache = Zend_Registry::get('genericCache');
                $cacheId = 'photos' . $acc->acc_id;
                $cache->remove($cacheId);

                $imagesToChange = $form->getValue('images');

                $delete = $form->getElement('delete');

                if ($delete && $delete->isChecked() && is_array($imagesToChange)) {
                    // if delete was pressed then delete selected photos

                    $noOfDeletedPhotos = $acc->deletePhotos($imagesToChange);

                    if (count($imagesToChange) != $noOfDeletedPhotos) {
                        throw new Zend_Db_Exception('Problem when deleting photos');
                    }
                    // $this->_helper->FlashMessenger("$noOfDeletedPhotos photos were deleted");
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

                    return $this->_redirect('accommodation/addphotos/id/' . $acc_id);
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
            
            // if user is logged go to user/index.
            if (Zend_Auth::getInstance()->hasIdentity()) {                
                return $this->_redirect('user/');
            }
            
            // otherwise go to home page. 
            $this->_helper->FlashMessenger('Please login to make further changes');
            return $this->_redirect('/');
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

        if (false === ($acc = $this->_ifAccBelongsToLoggedUser($acc_id))) {
            return $this->_redirect('/');
        }

        $acc->is_enabled = 0;


        if ($acc->save() != $acc_id) {
            throw new Zend_Db_Exception('Returned acc_id is different then updated one');
        }

        //when an accommodation is disabled
        //clean recentAdvertsCache
        $cache = Zend_Registry::get('recentAdvertsCache');
        $cache->clean(Zend_Cache::CLEANING_MODE_ALL);

        //$this->_helper->FlashMessenger('Accommodation was disabled');
        return $this->_redirect('/user/');
    }

    public function enableAction() {

        $this->_helper->viewRenderer->setNoRender(true);

        $acc_id = $this->getRequest()->getParam('id', null);

        if (false === ($acc = $this->_ifAccBelongsToLoggedUser($acc_id))) {
            return $this->_redirect('/');
        }

        $acc->is_enabled = 1;


        if ($acc->save() != $acc_id) {
            throw new Zend_Db_Exception('Returned acc_id is different then updated one');
        }

        //when an accommodation is enabled
        //clean recentAdvertsCache
        $cache = Zend_Registry::get('recentAdvertsCache');
        $cache->clean(Zend_Cache::CLEANING_MODE_ALL);

        //$this->_helper->FlashMessenger('Accommodation was enabled');
        return $this->_redirect('/user/');
    }

}

