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
 * 
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
            return call_user_func(array($this, $getMethodName));
        }

        if (method_exists($this->_acc, $getMethodName)) {
            return call_user_func(array($this->_acc, $getMethodName));
        }

        throw new Zend_Exception("Invalid property: $propertyName");
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
     * @todo What users should I return?? 
     *
     * @return <type>
     */
    public function getUser() {
        return null;
    }

    /**
     * Get accommodation type.
     *
     * @return  My_Model_Table_Row_Type
     */
    public function getType() {
        return $this->_acc->_row->getType();
    }

    public function save() {

        $id = $this->_acc->_model->setAccommodation(
                        $this->getProperties(), $this->acc_id);

        // before repopulating properties delete all old ones.
        $this->_makeProperties();
        $this->_acc->_populateProperties($id);

        return $id;
    }

}

?>
