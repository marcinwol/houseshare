<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Houseshare_Shared
 *
 * @author marcin
 */
class My_Houseshare_Shared extends My_Houseshare_Accommodation {

    protected $_modelName = 'Table_Shared';
    /**
     * Model for the SHARED
     *
     * @var My_Model_Table_Shared
     */
    protected $_model = null;


    public function __construct($id = null) {
        parent::__construct($id);

        // $_acc should point to the ACCOMMODATION table, not SHARED table.
        $this->_acc = new parent($id);

        $this->_mergeProperties();
        
    }
   

    
    public function save() {

//        // first save/update data for the user table and than accociated roomate table.
//        $user_id = $this->_user->_model->setUser($this->_properties, $this->user_id);
//        $looker_id = $this->_model->setLooker($this->_properties, $user_id);
//
//        // make sure that user_id is the same as roomate_id
//        if ($user_id !== $looker_id) {
//            throw new Zend_Exception(
//                    "Looker id = $looker_id does not match user id = $user_id"
//            );
//        }
//
//        // before re-populating properties delete all old ones.
//        $this->_makeProperties();
//        $this->_user->_populateProperties($user_id);
//        $this->_populateProperties($user_id);
//        $this->_mergeProperties();
//
//        return $user_id;
//
//
    }

}

?>
