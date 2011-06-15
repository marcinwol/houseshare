<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnyHtml
 *
 * @author marcin
 */
class My_Form_Decorator_AnyMarkup extends Zend_Form_Decorator_Abstract {
 
    public function render($content) {
        
        $placement = $this->getPlacement();
        $separator = $this->getSeparator();
        
        switch ($placement) {
            case self::PREPEND:
                return $this->_options['markup'] . $separator . $content;
            case self::APPEND:
            default:
                return $content . $separator . $this->_options['markup'];
        }
    }
 
}

?>
