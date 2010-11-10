<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

    protected function _initLocale() {
        // define locale
        $locale = new Zend_Locale('pl');
      
        // register it so that it can be used all over the website
        Zend_Registry::set('Zend_Locale', $locale);
    }

    protected function _initTranslate() {
        // get Locale
        $locale = Zend_Registry::get('Zend_Locale');

       
        // Set up and load the translations 
        $translate = new Zend_Translate(
                        array(
                            'adapter' => 'array',
                            'content' => APPLICATION_PATH . '/languages/' . $locale . '.php',
                            'locale' => $locale)
        );

        // Save it for later
        Zend_Registry::set('Zend_Translate', $translate);
    }

}

