<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mvc
 *
 * @author marcin
 */
class My_Navigation_Page_AccList extends My_Navigation_Page_Mvc {
  
    /**
     *
     * @var My_Model_Table_Row_City 
     */
    protected $_city = null;
    
    public function setCity(My_Model_Table_Row_City $city) {
        $this->_city = $city;
        $this->setLabel($this->_city->name);        
    }
    
     /**
     * Sets params to use when assembling URL
     *
     * @see getHref()
     *
     * @param  array|null $params        [optional] page params. Default is null
     *                                   which sets no params.
     * @return Zend_Navigation_Page_Mvc  fluent interface, returns self
     */
    public function setParams(array $params = null)  {                
        
        $cityParams = array(
            'city' => $this->_city->city_id,
            'cityname' => $this->_city->name
        );
        return parent::setParams($cityParams);
    }
    
}

?>
