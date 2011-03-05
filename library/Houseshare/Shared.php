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
    /**
     *
     * @var My_Model_Table_Row_Shared
     */
    protected $_row;


    public function __construct($id = null) {
        My_Houseshare_Abstract_PropertyAccessor::__construct($id);

        // $_acc should point to the ACCOMMODATION table, not SHARED table.
        $this->_acc = new My_Houseshare_Accommodation($id);

        $this->_mergeProperties();
    }

    /**
     * Set roomates_id
     *
     * @param int $roomates_id
     */
    public function setRoomatesId($roomates_id) {
        $this->_properties['roomates_id'] = $roomates_id;        
    }

    /**
     * Get roomates if exist.
     *
     * @return My_Model_Table_Row_Roomates|NULL
     */
    public function getRoomates() {
        return $this->_row->getRoomates();
    }

    public function save() {
        // first save/update data for the acc table and than accociated shared table.

        $acc_id = parent::save(false);

        $shared_id = $this->_model->setShared($this->_properties, $acc_id);

        // make sure that acc_id is the same as shared_id
        if ($acc_id !== $shared_id) {
            throw new Zend_Exception(
                    "Shared id = $shared_id does not match accommodation id = $acc_id"
            );
        }

        $this->_makeProperties();
        $this->_acc->_populateProperties($acc_id);
        $this->_populateProperties($acc_id);
        $this->_mergeProperties();

        return $acc_id;
    }

}

?>
