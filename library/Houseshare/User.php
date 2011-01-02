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

    protected $_modelName = 'Table_User';
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

    public function __construct($id = null) {
        parent::__construct($id);

        $this->_user = $this;
    }

    public function getAccommodations() {
        return $this->_user->_row->getAccommodations();
    }


    public function save() {

       $id = $this->_user->_model->setUser($this->getProperties(), $this->user_id);

       $this->_user->_populateProperties($id);

       return $id;
    }

}

?>