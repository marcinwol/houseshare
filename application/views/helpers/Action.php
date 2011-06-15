<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * A view helper that returns current action's name.
 *
 * @author marcin
 */
class My_View_Helper_Action extends Zend_View_Helper_Abstract {

    public function action() {
        $request = Zend_Controller_Front::getInstance()->getRequest();
        return $request->getActionName();
    }

}
?>
