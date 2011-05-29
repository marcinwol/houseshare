<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PageController
 *
 * @author marcin
 */
class PageController extends Zend_Controller_Action { 
    
   
    
    public function aboutAction() {
        $this->_helper->renderStatic();
    }
    
    public function faqAction() {
        $this->_helper->renderStatic();
    }
    
    public function contactAction() {
        $this->_helper->renderStatic();
    }
    
}

?>
