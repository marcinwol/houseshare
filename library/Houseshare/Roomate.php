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
class My_Houseshare_Roomate extends My_Houseshare_User {

    protected $_modelName = 'Table_Roomate';
    /**
     *  Model for the ROOMATE
     *
     * @var My_Model_Table_Roomate
     */
    protected $_model = null;


    public function __construct($id = null) {
        parent::__construct($id);

        $this->_user = new parent($id);

        $this->_mergeProperties();
        
    }

    protected function _mergeProperties() {
        $this->_properties = array_merge($this->_properties, $this->_user->getProperties());
    }

    
    public function save() {

        $user_id = $this->_user->_model->setUser($this->_properties, $this->user_id);
        $roomate_id = $this->_model->setRoomate($this->_properties, $user_id);
        
        if ($user_id !== $roomate_id) {
            throw new Zend_Exception(
                    "Roomated id = $roomate_id does not match user id = $user_id"
            );
        }

        $this->_user->_populateProperties($user_id);
        $this->_makeProperties();
        $this->_populateProperties($user_id);
        $this->_mergeProperties();

        return $user_id;
    }

}

?>
