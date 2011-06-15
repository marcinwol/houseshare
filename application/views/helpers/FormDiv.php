<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormDiv
 *
 * @author marcin
 */
class My_View_Helper_FormDiv extends Zend_View_Helper_FormElement {

   
    public function formDiv($name, $value = null, $attribs = null) {  

        $class = '';

        if (isset($attribs['class'])) {
             $class = 'class = "'. $attribs['class'] .'"';
        }

        return "<li $class><div>$value</div></li>";
    }

}
?>
