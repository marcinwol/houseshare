<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Test
 *
 * @author marcin
 */
class My_Controller_Action_Helper_RenderStatic extends Zend_Controller_Action_Helper_Abstract {

    protected $_lang = 'en';    
    

     public function __construct() {
         $this->_setLanguage();
        
     }
    
    public function direct() {
        $renderer = $this->_actionController->getHelper('ViewRenderer');
        
        $controllerName = $this->getRequest()->getControllerName();
        
        $actionName = $this->getRequest()->getActionName();                        
        $scriptName = $actionName . "-{$this->_lang}";        
        $viewScript = $renderer->getViewScript($scriptName);
        
        $scriptPath = APPLICATION_PATH . "/views/scripts/$viewScript";
               
        if (file_exists($scriptPath)) {
            $renderer->render($scriptName);
        } else {
             $renderer->render($actionName);
        }        
        
    }

    protected function _setLanguage() {
        /* @var $locale Zend_Locale */
        $locale = Zend_Registry::get('Zend_Locale');
        $this->_lang = $locale->getLanguage();
    }

}

?>
