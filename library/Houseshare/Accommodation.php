<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Class for working with Accommodation.
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
     *  Object for the USER
     *
     * @var My_Houseshare_Accommodation
     */
    protected $_user = null;
    /**
     *
     * @var My_Model_Table_Row_Accommodation
     */
    protected $_row;

    public function __construct($id = null) {
        parent::__construct($id);

        $this->_user = $this;
    }

     /**
     * Merges propertis from the current model and parrent accommodation model.
     */
    protected function _mergeProperties() {
        $this->_properties = array_merge($this->_properties, $this->_user->getProperties());
    }


    public function save() {

        $id = $this->_user->_model->setAccommodation(
                $this->getProperties(), $this->user_id);


        // before repopulating properties delete all old ones.
        $this->_makeProperties();
        $this->_user->_populateProperties($id);

        return $id;
    }


   

}
?>
