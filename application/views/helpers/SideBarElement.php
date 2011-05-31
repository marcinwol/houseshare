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
    const SIDEBAR_DIR = '_sidebars';

    protected $_lang = '';
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


        if (false !== ($bname = $this->_ifFromFile($content))) {
            $this->_setLanguage();
            $localeBname = $bname . '-' . $this->_lang;
            $filePath = self::SIDEBAR_DIR . "/$localeBname.phtml";
            
            $scriptPath = APPLICATION_PATH . "/views/scripts/" . $filePath;            
            
            if (!file_exists($scriptPath)) {
                // if locale sidebar partial don't exist, than use the default 
                // one (i.e. english one).
                $filePath = self::SIDEBAR_DIR . "/$bname.phtml";
            }            
            
            $content = $this->view->partial($filePath);
        }

        // call partial to render side bar box/element
        $html = $this->view->partial(
                        '_partials/side-bar-box.phtml', null, array('title' => $title, 'content' => $content, 'class' => $class)
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

    /**
     * Check if content should be read from file.
     * It is read from file if $str is in the format:
     * "partialfile:name-of-partial" 
     * 
     * Note: name-of-partial is without .phtml extension.
     * 
     * 
     * 
     * @param string|false $str base name of sidebar partial or false
     */
    protected function _ifFromFile($str) {

        $parts = array();

        if (strpos($str, 'partialfile') === 0) {
            $parts = explode(':', $str);
        }

        if (empty($parts)) {
            return false;
        }

        return $parts[1];
    }

    protected function _setLanguage() {
        /* @var $locale Zend_Locale */
        $locale = Zend_Registry::get('Zend_Locale');
        $lang = $locale->getLanguage();
        
        if ($lang != 'en') {
            // if 'en' do not need to change the default settings.
            $this->_lang = $lang;
        }
    }

}

?>
