<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormElements
 *
 * @author marcin
 */
class My_Form_Decorator_FormElements extends Zend_Form_Decorator_FormElements {

    /**
     * Render form elements
     *
     * @param  string $content
     * @return string
     */
    public function render($content) {
        $form = $this->getElement();
        if ((!$form instanceof Zend_Form) && (!$form instanceof Zend_Form_DisplayGroup)) {
            return $content;
        }

        $belongsTo = ($form instanceof Zend_Form) ? $form->getElementsBelongTo() : null;
        $elementContent = '';
        $separator = $this->getSeparator();
        $translator = $form->getTranslator();
        $items = array();
        $view = $form->getView();
        
        $elementContent = '';
        
        foreach ($form as $item) {
            $item->setView($view)
                    ->setTranslator($translator);
            if ($item instanceof Zend_Form_Element) {
                $item->setBelongsTo($belongsTo);
            } elseif (!empty($belongsTo) && ($item instanceof Zend_Form)) {
                if ($item->isArray()) {
                    $name = $this->mergeBelongsTo($belongsTo, $item->getElementsBelongTo());
                    $item->setElementsBelongTo($name, true);
                } else {
                    $item->setElementsBelongTo($belongsTo, true);
                }
            } elseif (!empty($belongsTo) && ($item instanceof Zend_Form_DisplayGroup)) {
                foreach ($item as $element) {
                    $element->setBelongsTo($belongsTo);
                }
            }

            
            if ($item instanceof Zend_Form_Element_Hidden) {
                $elementContent .= $item->render();
            } else {
                $elementContent .= $separator . $item->render();
            }
            
            
            
              

            if (($item instanceof Zend_Form_Element_File)
                    || (($item instanceof Zend_Form)
                    && (Zend_Form::ENCTYPE_MULTIPART == $item->getEnctype()))
                    || (($item instanceof Zend_Form_DisplayGroup)
                    && (Zend_Form::ENCTYPE_MULTIPART == $item->getAttrib('enctype')))
            ) {
                if ($form instanceof Zend_Form) {
                    $form->setEnctype(Zend_Form::ENCTYPE_MULTIPART);
                } elseif ($form instanceof Zend_Form_DisplayGroup) {
                    $form->setAttrib('enctype', Zend_Form::ENCTYPE_MULTIPART);
                }
            }
            
            
            
        }
                
      
        switch ($this->getPlacement()) {
            case self::PREPEND:
                return $elementContent . $separator . $content;
            case self::APPEND:
            default:
                return $content . $separator . $elementContent;
        }
    }

}

?>
