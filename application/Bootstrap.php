<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

    protected function _initRoutes() {
        $locale = $this->getResource('locale');
        // Create route with language id (lang)
        $routeLang = new Zend_Controller_Router_Route(
                        ':lang',
                        array(
                            'lang' => $locale->getLanguage()
                        ),
                        array('lang' => '[a-z]{2}')
        );
    }

    protected function _initTranslate() {
        // We use the Polish locale as an example
        $this->bootstrap('locale');
        $locale = $this->getResource('locale');

        Zend_Registry::set('Zend_Locale', $locale);
        $langLocale = $locale;
        // Create Session block and save the locale
        //  $session = new Zend_Session_Namespace('session');
        //  $langLocale = isset($session->lang) ? $session->lang : $locale;
        //  var_dump($langLocale);
        // Set up and load the translations (all of them!)
        $translate = new Zend_Translate(
                        array(
                            'adapter' => 'array',
                            'content' => APPLICATION_PATH . '/languages/' . $langLocale . '.php',
                            'locale' => $langLocale)
        );

        //$translate->setLocale($langLocale); // Use this if you only want to load the translation matching current locale, experiment.
        // Save it for later
        $registry = Zend_Registry::getInstance();
        $registry->set('Zend_Translate', $translate);
    }

}

