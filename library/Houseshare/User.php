<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author marcin
 */
class My_Houseshare_User extends My_Houseshare_Abstract_PropertyAccessor {


    /**
     *  Model for the USER
     *
     * @var My_Model_Table_User
     */
    protected $_model = null;
    /**
     *  Object for the USER
     *
     * @var My_Houseshare_User
     */
    protected $_user = null;
    /**
     *
     * @var My_Model_Table_Row_User
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
        
        $this->_modelName = 'Table_User';
        
        parent::__construct($id);

        $this->_user = $this;
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

        if (method_exists($this, $getMethodName)) {
            $getterResult = call_user_func(array($this, $getMethodName));
            return $getterResult;
        }

        throw new Zend_Exception("Invalid property: $propertyName");
    }

    public function __set($propertyName, $value) {

        if (array_key_exists($propertyName, $this->_properties)) {
            parent::__set($propertyName, $value);
            return;
        }

        // if not than use getter function to get the rest of data.
        $setMethodName = 'set' . ucfirst($propertyName);

        if (method_exists($this, $setMethodName)) {
            call_user_func(array($this, $setMethodName), $propertyName, $value);
            return;
        }

        if (method_exists($this, $setMethodName)) {
            call_user_func(array($this, $setMethodName), $propertyName, $value);
            return;
        }

        throw new Zend_Exception("Invalid property \"$propertyName\" for setting.");
    }

    /**
     * Merges propertis from the current model and parrent user model.
     */
    protected function _mergeProperties() {
        $this->_properties = array_merge($this->_properties, $this->_user->getProperties());
    }

    /**
     * Get Accommodations of current user
     *
     * @return Zend_Db_Table_Rowset
     */
    public function getAccommodations() {
        return $this->_user->_row->getAccommodations();
    }

    /**
     * Get password of current user
     *
     * @return string password as md5 hash
     */
    public function getPassword() {
        return $this->_user->_row->getPassword()->password;
    }

    /**
     * Save password as a md5 hash.
     * 
     * @param string $property name
     * @param string $value  password to be saved (md5)
     */
    public function setPassword($property, $value) {
        $this->_newProperties['password'] = md5($value);
    }
    
    public function setNickname($property, $value) {
         // make defualt nickname if needed
        if (!empty($value) ) {
            $nickname = $value;
        } else {
            $nickname = 'User' .mt_rand(1000, 99999);                   
        }
        
        
        return  $nickname;
    }
    
    /**
     * Check if phone is avaliable and if phone and email are public
     * 
     * @return boolean
     */
    public function contactDetailsAvaliable() {
        if ((empty($this->phone) || $this->phone_public == false) && ($this->email_public == false) ) {
            return false;
        }
        return true;
    }

    /**
     * Save the password in the PASSWORD table.       
     * 
     * @return int id of new row
     */
    protected function _savePassword($userId) {
        $passModel = new My_Model_Table_Password();

        $row = $passModel->find($userId)->current();
        
        if (empty($row)){            
            $row = $passModel->createRow();
        }        
        
        $row->user_id = $userId;
        $row->password = $this->_newProperties['password'];

        return $row->save();
    }

    public function getNewProperties() {
        return (array) $this->_newProperties;
    }
    
    public function getName() {
        $firstName = $this->first_name;
        $name = $firstName ? $firstName : 'User' . $this->user_id;
        return $name;
    }
    
    


    public function save() {

        $id = $this->_user->_model->setUser($this->getProperties(), $this->user_id);
      


        if (array_key_exists('password', $this->getNewProperties())) {
            $new_row_id = $this->_savePassword($id);            
            if ($new_row_id != $id) {
                throw new Zend_Db_Exception("Password's id and user id don't metch");
            }
            
        }

        // before repopulating properties delete all old ones.
        $this->_makeProperties();
        $this->_user->_populateProperties($id);

        return $id;
    }

}

?>