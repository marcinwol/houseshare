<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class My_View_Helper_UrlParams extends Zend_View_Helper_Abstract {

    /**
     * View instance
     *
     * @var  Zend_View_Interface
     */
    public $view;
    
    
    /**
     * Get request parameteter.
     * 
     * @param string|null $key
     * @return string|array  
     */
    public function urlParams($key = null) {
        
          $request = Zend_Controller_Front::getInstance()->getRequest();
          
          if (is_string($key)) {
              return $request->getParam($key);
          }
          
          return $request->getParams();        
    }
    
    
    /**
     * Get Zend_View instance
     *
     * @param Zend_View_Interface $view
     */
    public function setView(Zend_View_Interface $view) {
        $this->view = $view;
    }
    
    
}
?>
