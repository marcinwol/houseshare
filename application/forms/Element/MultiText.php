<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class My_Form_Element_MultiText extends Zend_Form_Element_Multi
{
    /**
     * Use formMultiCheckbox view helper by default
     * @var string
     */
    public $helper = 'formMultiText';

    /**
     * MultiCheckbox is an array of values by default
     * @var bool
     */
    protected $_isArray = true;
}

?>
