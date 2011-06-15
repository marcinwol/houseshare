<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * A view helper that returns current controller's name.
 *
 * @author marcin
 */
class My_View_Helper_Controller extends Zend_View_Helper_Abstract {

    public function controller() {
        $request = Zend_Controller_Front::getInstance()->getRequest();
        return $request->getControllerName();
    }

}
?>
