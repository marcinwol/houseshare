<?php

/**
 * Custom class for working with Accommodation.
 *
 * @example
 * Retriving a given ACCOMMODATION data:
 * $acc = new My_Houseshare_Accommodation(1); //get accommodation with acc_id = 1
 * $acc->title;
 * $acc->description;
 * $acc->price; // access data in ACCOMMODATION table
 *
 * $acc->features; // fetch rowset of features
 * $acc->preferences; //fetch rowset of preferences
 * $acc->address; // get My_Houseshare_Address
 * $acc->photos; // get rowset of photos
 * 
 * $acc->preferences = array(); // delete all preferences
 *
 * $acc->type; //get Type row.
 * $acc->user; // get My_Houseshare_User or its descendant
 *
 * @author marcin
 */
class My_Houseshare_Accommodation extends My_Houseshare_Abstract_PropertyAccessor {

    
    const COUNT_DUPLICATES = true;
    
    protected $_modelName = 'Table_Accommodation';
    /**
     *  Model for the ACCOMMODATION
     *
     * @var My_Model_Table_Accommodation
     */
    protected $_model = null;
    /**
     *  Object for the ACCOMMODATION model
     *
     * @var My_Houseshare_Accommodation
     */
    protected $_acc = null;
    /**
     *
     * @var My_Model_Table_Row_Accommodation
     */
    protected $_row;
    /**
     * Asociative array keeping properties and their values for
     * data from and for models other than $this->_model
     *
     * @var array
     */
    protected $_newProperties = array();

    public function __construct($id = null) {
        parent::__construct($id);

        $this->_acc = $this;
    }

    /**
     * Merges propertis from the current model and parent accommodation model.
     */
    protected function _mergeProperties() {
        $this->_properties = array_merge($this->_properties, $this->_acc->getProperties());
    }

    public function __get($propertyName) {        
        if (array_key_exists($propertyName, $this->_properties)) {
            return parent::__get($propertyName);
        }
        
        // if not than use getter function to get the rest of data.
        $getMethodName = 'get' . ucfirst($propertyName);

        if (method_exists($this, $getMethodName)) {
            $getterResult = call_user_func(array($this, $getMethodName));
            return $getterResult;
        }

        if (method_exists($this->_acc, $getMethodName)) {
            $getterResult = call_user_func(array($this->_acc, $getMethodName));
            return $getterResult;
        }

        throw new Zend_Exception("Invalid property: $propertyName");
    }

    public function __set($propertyName, $value) {


        if (array_key_exists($propertyName, $this->_acc->_properties)) {
            parent::__set($propertyName, $value);
            return;
        }

        // if not than use getter function to get the rest of data.
        $setMethodName = 'set' . ucfirst($propertyName);

        if (method_exists($this, $setMethodName)) {
            call_user_func(array($this, $setMethodName), $propertyName, $value);
            return;
        }

        if (method_exists($this->_acc, $setMethodName)) {
            call_user_func(array($this->_acc, $setMethodName), $propertyName, $value);
            return;
        }

        throw new Zend_Exception("Invalid property \"$propertyName\" for setting.");
    }
    
    public function setTitle($property, $value) {
        return ucfirst(strtolower($value));
    }

    /**
     * Preferences for this accommodation
     *
     * @return My_Model_Table_Rowset_AccsPreferences
     */
    public function getPreferences() {
        return $this->_acc->_row->getPreferences();
    }

    /**
     * Set new preferences. The format of $value should be such as
     * that returned by $this->getPreferences()->toArray().
     *
     * To remove all preferences set $value = array();
     *
     * @param string $property name
     * @param array $value rowset in array form of new preferences
     */
    public function setPreferences($property, array $value) {
        
        if (is_null($this->_acc->_row)) {
            throw new Zend_Db_Table_Row_Exception(
                    "Cannot set properties if accommodation row is NULL."
            );
        }

        $acc_id = $this->_acc->_row->acc_id;

        $accsPrefsModel = new My_Model_Table_AccsPreferences();

        // set key acc_id for each preference row
        foreach ($value as &$arrayRow) {
            $arrayRow['acc_id'] = $acc_id;
        }
        unset($arrayRow);

        $this->_checkIfColsArePresentInRowset($accsPrefsModel, $value, $property);

        $this->_newProperties['preferences'] = $value;
    }
    
    public function setDate_avaliable($property, $value) {
        
        $value = trim($value);
        
        if (preg_match('/\d\d\d\d-\d\d-\d\d/', $value)) {
            return $value;
        }
        
        // the format below is from jquery ui datepicker
        $date = new Zend_Date($value, 'dd/MM/yyyy');
        
        // change to format acceptable by mysql
        $value = $date->toString('yyyy-MM-dd');    
        
        return $value;
    }

    protected function _savePreferences() {

        $accsPrefsModel = new My_Model_Table_AccsPreferences();

        $noOfDeletes = $this->_acc->_row->detelePreferences();

        $result_ids = array();


        foreach ($this->_newProperties['preferences'] as $preference) {
            $id = array('acc_id' => $preference['acc_id'], 'pref_id' => $preference['pref_id']);
            $data = array('value' => $preference['value']);

            $result_ids [] = $accsPrefsModel->setAccPreference($data, $id);
        }

        return $result_ids;
    }

    /**
     * Features for this accommodation
     *
     * @return My_Model_Table_Rowset_AccsFeatures
     */
    public function getFeatures() {
        return $this->_acc->_row->getFeatures();
    }

    /**
     * Set new features. The format of $value should be such as
     * that returned by $this->getFeatures()->toArray().
     *
     * To remove all features set $value = array();
     *
     * @param string $property name
     * @param array $value rowset in array form of new features
     */
    public function setFeatures($property, array $value) {

        if (is_null($this->_acc->_row)) {
            throw new Zend_Db_Table_Row_Exception(
                    "Cannot set features if accommodation row is NULL."
            );
        }

        $acc_id = $this->_acc->_row->acc_id;

        $accsFeatsModel = new My_Model_Table_AccsFeatures();

        // set key acc_id for each feature row
        foreach ($value as &$arrayRow) {
            $arrayRow['acc_id'] = $acc_id;
        }
        unset($arrayRow);

        $this->_checkIfColsArePresentInRowset($accsFeatsModel, $value, $property);

        $this->_newProperties['features'] = $value;
    }

    protected function _saveFeatures() {
        $acc_id = $this->_acc->_row->acc_id;
        $accsFeatsModel = new My_Model_Table_AccsFeatures();

        $noOfDeletes = $this->_acc->_row->deteleFeatures();

        $result_ids = array();

        foreach ($this->_newProperties['features'] as $feature) {
            $id = array('acc_id' => $feature['acc_id'], 'feat_id' => $feature['feat_id']);
            $data = array('value' => $feature['value']);

            $result_ids [] = $accsFeatsModel->setAccFeature($data, $id);
        }

        return $result_ids;
    }
    
    public function getCreationtimestamp() {
        $create = $this->created;
       // var_dump($create, strtotime($create));
        return strtotime($create);
    }
    
    public function getAvaliabletimestamp() {
        $avaliableDate = $this->date_avaliable;
       // $date = new DateTime($avaliableDate);
       // var_dump($create, strtotime($create));        
        return strtotime($avaliableDate);
    }
    
    /**
     * Check if an accommodation is already avaliable. 
     * 
     * @return boolean
     */
    public function isAlreadyAvaliable() {
        if ($this->getAvaliabletimestamp() < time()) {
            return true;
        }
        return false;
    }
    
    
    /**
     * Get number of views of the current accommodation
     * 
     * @return int number of views 
     */
    public function getViews_count() {
        $viewsRowset = $this->_acc->_row->getViews();
        return count($viewsRowset);
    }
    
    public function addOneView() {
        $viewCounterModel  = new My_Model_Table_ViewCounter();
        $data = array(
            'acc_id'    => $this->_acc->_row->acc_id,
            'remote_ip' => My_Houseshare_Tools::getIpAddress()
        );
        $viewCounterModel->insertView($data, self::COUNT_DUPLICATES);
    }

    /**
     * Get photos for this accommodation.
     *
     * @return array of My_Houseshare_Photo objects
     */
    public function getPhotos() {
        $photos = $this->_acc->_row->getPhotos();

        $objs = array();

        foreach ($photos as $photo) {
            $objs [] = new My_Houseshare_Photo($photo->photo_id);
        }

        return $objs;
    }
    
    /**
     * Get relative url of photos.
     * 
     * @param boolean $withBaseUrl
     * @return string 
     */
    public function getPhotosurls($withBaseUrl = true) {
       
        $pahts = Array();
        
        $baseUrl = $this->_getBaseUrl();       
        
        /*@var $photo My_Houseshare_Photo */
        foreach ($this->photos as $photo) {
            $paths[$photo->photo_id] = $baseUrl . '/images/' .$photo->getThumbPath();
        }
        
        return $paths;
    }
    
    /**
     * Get relative url of photos.
     * 
     * @param boolean $withBaseUrl
     * @return string 
     */
    public function getThumbsurls($withBaseUrl = true) {
       
        $paths = array();
        
        $baseUrl = $this->_getBaseUrl();       
        
        /*@var $photo My_Houseshare_Photo */
        foreach ($this->photos as $photo) {
            $paths[$photo->photo_id] = $baseUrl . '/images/thumbs/' .$photo->getThumbPath();
        }
        
        return $paths;
    }
    
    
    
    /**
     * Get pahts to photos on filesystem
     *     
     * @return string 
     */
     public function getPhotospaths() {
       
        $pahts = Array();
        
        $baseUrl = $this->_getBaseUrl();       
        
        /*@var $photo My_Houseshare_Photo */
        foreach ($this->photos as $photo) {
            $paths[$photo->photo_id] = PHOTOS_PATH . '/' .$photo->getThumbPath();
        }
        
        return $paths;
    }

    /**
     * Set addr_id
     * 
     * @param int $addr_id
     */
    public function setAddrId($addr_id) {
        $this->_properties['addr_id'] = $addr_id;
    }

    /**
     * Delete current accommodation.
     *
     * Note: This will also delete corresponding shared
     * accommodation row. 
     *
     * @return int|null number of rows deleted
     */
    public function delete() {
        if ($this->_acc->_row instanceof My_Model_Table_Row_Accommodation) {
            return $this->_acc->_row->delete();
        }
        return null;
    }

    /**
     * Delete accommodation of given id.
     *
     * Note: This will also delete corresponding shared
     * accommodation row. 
     *
     * @param int $id
     * @return int|null number of rows deleted
     */
    static public function deleteAcc($id) {
        $model = new My_Model_Table_Accommodation();
        $accRow = $model->find($id)->current();
        if (null !== $accRow) {
            return $accRow->delete();
        }
        return null;
    }

    /**
     * Set user_id
     *
     * @param int $user_id
     */
    public function setUserId($user_id) {
        $this->_properties['user_id'] = $user_id;
    }

    /**
     * Set type_id
     *
     * @param int $user_id
     */
    public function setTypeId($type_id) {
        $this->_properties['type_id'] = $type_id;
    }
    
    /**
     * Set new photos. The format of $value should be
     * array of My_Houseshare_Photo objects.
     *
     * To remove all photos set $value = array();
     *
     * @param string $property name
     * @param array $value array of My_Houseshare_Photo objects
     */
    public function setPhotos($property, array $value) {

       // $photoModel = new My_Model_Table_Photo();
        //$this->_checkIfColsArePresentInRow($photoModel, $value, $property);

        $this->_newProperties['photos'] = $value;
    }

    /**
     * Save photos (only records in db, not actual files)
     *
     * @return array array of photo ids
     */
    protected function _savePhotos() {
        $acc_id = $this->_acc->_row->acc_id;

        /* @var $photos array of My_Houseshare_Photo objects */
        $photos = $this->_newProperties['photos'];

        $photos_ids = array();

        foreach ($photos as $photo) {
            $photo->setAccId($acc_id);
            $photo_ids [] = $photo->save();
        }

        return $photo_ids;
    }
    
    /**
     * Get an array of photo ids.
     * 
     * @return array array of photos ids.
     */
    public function getPhotosids() {
        return $this->_acc->_row->getPhotos()->getPhotosIDs();
    }
    
    /**
     * Delete given photos of $this accommodation
     * 
     * @param array $photosIDs
     * @return int $noOfDeletedPhotos
     */
    public function deletePhotos(array $photosIDs) {
        
        // first check if the photos belong to a given acc
        $accPhotosIDs = $this->getPhotosids();
        
        $noOfDeletedPhotos = 0;
        
        foreach ($photosIDs as $photo_id) {
            
            if (!in_array($photo_id, $accPhotosIDs)) {
                // if the photo_id does not belong to current accommodation
                continue;
            }
            
            $photo = new My_Houseshare_Photo($photo_id);
            if ($photo->delete()) {
                $noOfDeletedPhotos++;
            }
        }
        
        return $noOfDeletedPhotos;
    }

    /**
     * Get address for this accommodation
     *
     * @return My_Houseshare_Address
     */
    public function getAddress() {
        return new My_Houseshare_Address($this->_acc->_row->addr_id);
    }

    /**
     * Get Houseshare_User object of this accommodation.
     *
     * @return My_Houseshare_User
     */
    public function getUser() {

        $user_id = $this->_acc->_row->user_id;

        return My_Houseshare_Factory::user($user_id);
    }
    
    public function getCity() {
        return $this->getAddress()->city;
    }
        
    
    public function getState() {
        return $this->getAddress()->state;
    }
    
    /**
     * Get accommodation type.
     *
     * @return  My_Model_Table_Row_Type
     */
    public function getType() {
        return $this->_acc->_row->getType();
    }
    
    /**
     * Get userfriendly accommodation type .
     *
     * @return  My_Model_Table_Row_Type
     */
    public function getTypeAsString() {
        $type = $this->type->name;
        $typeAsString = $type;
        
        if ('Bed' == $type) {
            $typeAsString = 'A pace in a room';
        }
        return $typeAsString;
    }

    public function getNewProperties() {
        return (array) $this->_newProperties;
    }

    /**
     * Save data in database. 
     *
     * @return int acc_id
     */
    public function save($rePopulate = true) {

        $prefs_ids = array();

        if (array_key_exists('preferences', $this->getNewProperties())) {
            $prefs_ids = $this->_savePreferences();
        }

        $feat_ids = array();

        if (array_key_exists('features', $this->getNewProperties())) {
            $feat_ids = $this->_saveFeatures();
        }

        $photos_ids = array();

        if (array_key_exists('photos', $this->getNewProperties())) {
            $photos_ids = $this->_savePhotos();
        }

        $acc_id = $this->_properties['acc_id'];
        if (!empty($this->_changedProperties)) {
            $acc_id = $this->_acc->_model->setAccommodation(
                            $this->getProperties(), $this->acc_id);
        }

        if (true === $rePopulate) {
            // before repopulating properties delete all old ones .
            $this->_makeProperties();
            $this->_acc->_populateProperties($acc_id);
        }

        return $acc_id;
    }

}

?>
