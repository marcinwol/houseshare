<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Houseshare_Appartment
 *
 * @author marcin
 */
class My_Houseshare_Appartment extends My_Houseshare_Accommodation {

    protected $_modelName = 'Table_Appartment';
    /**
     * Model for the APPARTMENT
     *
     * @var My_Model_Table_Appartment
     */
    protected $_model = null;
    /**
     *
     * @var My_Model_Table_Row_Appartment
     */
    protected $_row;


    public function __construct($id = null) {
        My_Houseshare_Abstract_PropertyAccessor::__construct($id);

        // $_acc should point to the ACCOMMODATION table, not APPARTMENT table.
        $this->_acc = new My_Houseshare_Accommodation($id);

        $this->_mergeProperties();
        
       
    }

    /**
     * Set details_id
     *
     * @param int $details_id
     */
    public function setDetailsId($id) {
        $this->_properties['details_id'] = $id;        
    }

    /**
     * Get appartment details.
     *
     * @return My_Model_Table_Row_NonSharedDetails
     */
    public function getDetails() {
        return $this->_row->getDetails();
    }

    public function save() {
        // first save/update data for the acc table and than accociated shared table.

        $acc_id = parent::save(false);

        $appartment_id = $this->_model->setAppartment($this->_properties, $acc_id);

        // make sure that acc_id is the same as shared_id
        if ($acc_id !== $appartment_id) {
            throw new Zend_Exception(
                    "Appartment id = $shared_id does not match accommodation id = $acc_id"
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
