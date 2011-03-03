<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Captcha
 *
 * @author marcin
 */
class My_Form_Decorator_Captcha extends Zend_Form_Decorator_Captcha {

    /**
     * Render captcha
     *
     * @param  string $content
     * @return string
     */
    public function render($content) {
        $element = $this->getElement();
        if (!method_exists($element, 'getCaptcha')) {
            return $content;
        }

        $view = $element->getView();
        if (null === $view) {
            return $content;
        }


        $name = $element->getFullyQualifiedName();

        $hiddenName = $name . '[id]';
        $textName = $name . '[input]';

        $label = $element->getDecorator("Label");
        if ($label) {
            $label->setOption("id", $element->getId() . "-input");
        }

        $placement = $this->getPlacement();
        $separator = $this->getSeparator();

        $captcha = $element->getCaptcha();
        $markup = $captcha->render($view, $element);
        $hidden = $view->formHidden($hiddenName, $element->getValue(), $element->getAttribs());
        $text = $view->formText($textName, '', $element->getAttribs());

        switch ($placement) {
            case 'PREPEND':
                $content = '<div><span>' . $text . '</div></span>' .
                        '<div><span>' . $markup . $hidden . '</div></span>' .
                        $separator . $content;
                break;
            case 'APPEND':
            default:
                $content = $content . $separator .
                        '<div><span>' . $text . '</div></span>' .
                        '<div><span>' . $markup . $hidden . '</div></span>';
        }

        return $content;
    }

}

?>
