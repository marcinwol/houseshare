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
class My_View_Helper_Avaliable extends Zend_View_Helper_Abstract {

    protected $_acc;
    public $view;

    public function avaliable($acc) {
        $this->_acc = $acc;
        return $this;
    }

    public function inOrFrom() {

        // check if avaliabled date is in the past
        $avaliableTmp = $this->_acc->avaliabletimestamp;

        if ($this->_acc->isAlreadyAvaliable()) {
            return $this->view->translate('from');
        } else {
            return $this->view->translate('in');
        }
    }
    
    public function time() {
        return $this->view->timeTill($this->_acc->avaliabletimestamp) . ' ('.$this->_acc->date_avaliable.')';
    }

    /**
     * Get Zend_View instance
     *
     * @param Zend_View_Interface $view
     */
    public function setView(Zend_View_Interface $view) {
        $this->view = $view;
    }

}

?>