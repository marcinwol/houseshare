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

        // $_user should point to the USER table, not ROOMATE table.
        $this->_user = new parent($id);

        $this->_mergeProperties();
        
    }

    
    
    public function save() {

        // first save/update data for the user table and than accociated roomate table.
        $user_id = $this->_user->_model->setUser($this->_properties, $this->user_id);
        $roomate_id = $this->_model->setRoomate($this->_properties, $user_id);

        // make sure that user_id is the same as roomate_id
        if ($user_id !== $roomate_id) {
            throw new Zend_Exception(
                    "Roomated id = $roomate_id does not match user id = $user_id"
            );
        }

        // before re-populating properties delete all old ones.
        $this->_makeProperties();
        $this->_user->_populateProperties($user_id);        
        $this->_populateProperties($user_id);
        $this->_mergeProperties();

        return $user_id;
    }

}

?>