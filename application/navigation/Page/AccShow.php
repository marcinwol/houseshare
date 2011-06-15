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
class My_Navigation_Page_AccShow extends My_Navigation_Page_Mvc {
   
    /**
     *
     * @var My_Houseshare_Accommodation 
     */
    protected $_acc = null;
    
    public function setAcc(My_Houseshare_Accommodation $acc) {        
        $this->_acc = $acc;   
        $this->setLabel($acc->title);
        $this->setParentParams();
    }
    
    public function setParentParams() {
        $parentPage = $this->getParent();    
        $parentPage->setCity($this->_acc->address->getRow()->getCity());
        $parentPage->setParams();
    }
    
  
}

?>
