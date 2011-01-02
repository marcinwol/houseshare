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

    protected $_user;

    public function __construct($id = null) {
        parent::__construct($id);

        $this->_user = new parent($id);
        
        
    }

    protected function  _populateProperties($id) {
        parent::_populateProperties($id);
        $this->_properties = array_merge($this->_properties, $this->_user->getProperties());

    }

    public function save() {
        
    }

}
?>
