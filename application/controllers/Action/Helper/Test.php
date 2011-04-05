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
class My_Controller_Action_Helper_Test extends Zend_Controller_Action_Helper_Abstract {
    
     public function preDispatch()  {
        $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');         
        $redirector->gotoUrl('http://www.google.pl');
    }    
    
}

?>
