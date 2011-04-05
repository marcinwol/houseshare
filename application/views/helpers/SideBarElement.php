<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SideBarElement
 *
 * @author marcin
 */
class My_View_Helper_SideBarElement extends Zend_View_Helper_Abstract {
    
    const PLACEHOLDER_KEY = 'side-bar';

    /**
     * View instance
     *
     * @var  Zend_View_Interface
     */
    public $view;

    public function sideBarElement($title = '', $content = '', array $options = array()) {

        // get options if given
        $place = isset($options['place']) ? $options['place'] : 'prepend';
        $class = isset($options['class']) ? $options['class'] : '';
        $addBreak = isset($options['break']) ? true : false;
        
        // call partial to render side bar box/element
        $html = $this->view->partial(
                        '_partials/side-bar-box.phtml', null, 
                         array('title' => $title, 'content' => $content, 'class' => $class)
        );
        
        // put it into placeholder
        $placeHolder = $this->getPlaceHolder();
        
        if (true === $addBreak) {
            $html .= '<div>&nbsp</div>';
        }
        
        if ('prepend' == $place) {            
            $placeHolder->prepend($html);
            
        } else if ('append' == $place) {            
            $placeHolder->captureStart();
            echo $html;
            $placeHolder->captureEnd();            
        }
        
    }

    /**
     * Get the sidebar placeholder 
     * 
     * @return type Zend_View_Helper_Placeholder_Container
     */
    public function getPlaceHolder() {
        return $this->view->placeholder(self::PLACEHOLDER_KEY);
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
