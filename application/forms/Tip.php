<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tip
 *
 * @author marcin
 */
class My_Form_Decorator_Jtip extends Zend_Form_Decorator_Abstract {
    //put your code here
    
    // 
    
    
     /**
     * Translates the title attribute if it is available, if the translator is available
     * and if the translator is not disable on the element being rendered.
     *
     * @param string $content
     * @return string
     */
    public function render($content)
    {
        if (null !== ($title = $this->getElement()->getAttrib('title'))) {
            if (null !== ($translator = $this->getElement()->getTranslator())) {
                $title = $translator->translate($title);
            }
        }

        $html = '<span class="formInfo"><a href="ajax2.htm?width=475" class="jTip" id="two" name="">?</a></span>';        
        return $html;
    }
    
}

?>
