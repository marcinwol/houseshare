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
class My_Navigation_Page_UserEdit extends My_Navigation_Page_Mvc {
   
    /**
     *
     * @var My_Houseshare_User 
     */
    protected $_user = null;
    
    public function setUser(My_Houseshare_User $user) {        
        $this->_user = $user;  
        $this->setParentParams();
    }
    
      
    public function setParentParams() {
        $parentPage = $this->getParent();    
        $parentPage->setUser($this->_user);     
    }
  
}

?>
