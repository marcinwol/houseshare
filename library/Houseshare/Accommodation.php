<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accommodation
 *
 * @author marcin
 */
class My_Houseshare_Accommodation {

    protected $_models = array();
    protected $_properties = array();

    public function  __construct($id = null) {
        $this->_models = array('acc'=>new My_Model_Table_Accommodation());

        if (is_null($id)) {
            $this->_getRow($id);
        }

    }

    protected function _getRow($id) {
        
    }

}
?>
