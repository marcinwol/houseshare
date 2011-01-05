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
 * $acc->type; //get Type row.
 * $acc->user; // get My_Houseshare_User or its descendant
 *
 * @author marcin
 */
class My_Houseshare_Accommodation extends My_Houseshare_Abstract_PropertyAccessor {

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
        if (array_key_exists($propertyName, $this->_acc->_properties)) {
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
     * @param string $property name
     * @param array $value array of new preferences
     */
    public function setPreferences($property, array $value) {
       $this->_newProperties['preferences'] = $value;
    }

    protected function savePreferences() {
        $acc_id = $this->_acc->_row->acc_id;
        $accsPreferencesModel = new My_Model_Table_AccsPreferences();
        
        $noOfDeletes = $this->_acc->_row->detelePreferences();

        $result_ids = array();

        foreach ($this->_newProperties['preferences'] as $preference ) {
            $id = array('acc_id' => $acc_id, 'pref_id' => $preference['pref_id']);
            $data = array('value' => $preference['value']);
            $result_ids []= $accsPreferencesModel->setAccPreference($data, $id);
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
     * Get photos for this accommodation.
     *
     * @return My_Model_Table_Rowset_Photos
     */
    public function getPhotos() {
        return $this->_acc->_row->getPhotos();
    }

    /**
     * Get address for this accommodation
     *
     * @return My_Houseshare_Address
     */
    public function getAddress() {
        return new My_Houseshare_Address($this->_acc->_row->acc_id);
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

    /**
     * Get accommodation type.
     *
     * @return  My_Model_Table_Row_Type
     */
    public function getType() {
        return $this->_acc->_row->getType();
    }

    public function getNewProperties() {
        return (array) $this->_newProperties;
    }



    public function save() {

        // start transaction

        var_dump($this->savePreferences());

        return true;

        $id = $this->_acc->_model->setAccommodation(
                        $this->getProperties(), $this->acc_id);

        // before repopulating properties delete all old ones.
        $this->_makeProperties();
        $this->_acc->_populateProperties($id);

        return $id;
    }

}

?>
