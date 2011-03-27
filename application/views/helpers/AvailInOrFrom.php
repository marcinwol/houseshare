<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AvavaliableInOrFrom
 *
 * @author marcin
 */
class My_View_Helper_AvailInOrFrom extends Zend_View_Helper_Abstract {

    public function availInOrFrom($acc) {
        
        // check if avaliabled date is in the past
        $avaliableTmp = $acc->avaliabletimestamp;

        if ($acc->isAlreadyAvaliable()) {
            return 'from';
        } else {
            return 'in';
        }
    }

}

?>