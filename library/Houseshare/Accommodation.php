<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Class for working with Accommodation.
 *
 * @todo to finish it
 * @author marcin
 */
class My_Houseshare_Accommodation extends My_Houseshare_Abstract_PropertyAccessor {

      /**
     *
     * @var My_Model_Table_Accommodation
     */
    protected $_model;

    protected $_modelName = 'Accommodation';

    public function  __construct($id = null) {
        $this->_models = array('acc'=>new My_Model_Table_Accommodation());

        if (is_null($id)) {
            $this->_getRow($id);
        }

    }

    public function __construct($id = null) {

        $this->_properties['id'] = null;
        $this->_properties['title'] = null;
        $this->_properties['description'] = null;
        $this->_properties['address'] = null;
        $this->_properties['user'] = null;
        $this->_properties['price'] = null;
        $this->_properties['date_avaliable'] = null;
        $this->_properties['created'] = null;
        $this->_properties['state'] = null;
        $this->_properties['zip'] = null;
        $this->_properties['zip_id'] = null;


        parent::__construct($id);
    }

    /**
     * Fetch data from database.
     *
     * @param int $id
     */
    protected function _populateProperties($id) {

        parent::_populateProperties($id);

        $this->_properties['id'] = $this->_row->acc_id;

    }

}
?>
