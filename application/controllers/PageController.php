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

    public function init() {
        
        // change the pages label in breadcrubs to have first
        // letter in upper case.
        $navigation = $this->view->navigation()->getContainer();        
        /*@var $activePage My_Navigation_Page_Mvc */
        $activePage = $this->view->navigation()->findActive($navigation);
        $label = $activePage['page']->getLabel();
        $activePage['page']->setLabel(ucfirst($this->view->translate($label)));
      
    }

    public function aboutAction() {
        $this->_helper->renderStatic();
    }

    public function faqAction() {
        $this->_helper->renderStatic();
    }

    public function contactAction() {
        $this->_helper->renderStatic();
    }

    public function legalAction() {
          /* @var $navigation Zend_Navigation */
   
        
        $this->_helper->renderStatic();
    }

    public function privacyAction() {
        $this->_helper->renderStatic();
    }

}

?>
