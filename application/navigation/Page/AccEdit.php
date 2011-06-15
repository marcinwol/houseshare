<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user page
 *
 * @author marcin
 */
class My_Navigation_Page_AccEdit extends My_Navigation_Page_Mvc {
   
    /**
     *
     * @var My_Houseshare_Accommodation 
     */
    protected $_acc = null;
    
    public function setAcc(My_Houseshare_Accommodation $acc) {        
        $this->_acc = $acc;   
        
        $tr = Zend_Registry::get('Zend_Translate');
        $genericLabel = $tr->translate($this->getLabel());
        $offer = $tr->translate('offer');
        
        $this->setLabel($genericLabel . " $offer '{$this->_acc->title}'");
        $this->setParentParams();
    }
    
      
    public function setParentParams() {
        $parentPage = $this->getParent();    
        $parentPage->setUser($this->_acc->user);     
    }
  
}

?>
