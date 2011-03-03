<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Div
 *
 * @author marcin
 */
class My_Form_Element_Div extends Zend_Form_Element {
     /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $helper = 'formDiv';


    public function __construct($spec, $options = null) {
        parent::__construct($spec, $options);
        $this->removeDecorator('label');
        $this->removeDecorator('htmlTag');        
    }

}
?>
