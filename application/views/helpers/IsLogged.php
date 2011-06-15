<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * ProfileLink helper
 *
 * Call as $this->profileLink() in your layout script
 */
class My_View_Helper_IsLogged extends Zend_View_Helper_Abstract {


    public function isLogged()  {

        return Zend_Auth::getInstance()->hasIdentity();
        
    }


}
?>
