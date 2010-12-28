<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }


    protected function _initAutoload() {
        $autoLoader = Zend_Loader_Autoloader::getInstance();

        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
                    'basePath' => APPLICATION_PATH,
                    'namespace' => '',
                ));

        $resourceLoader->addResourceType('view', 'views/helpers/',
                   'My_View_Helper_');
        $resourceLoader->addResourceType('form', 'forms/', 'My_Form_');
        $resourceLoader->addResourceType('model', 'models/', 'My_Model_');
        $resourceLoader->addResourceType('validate', 'validators/', 'My_Validate_');


        $autoLoader->pushAutoloader($resourceLoader);


        // add 'My_' namespace for library/CSM
        $resourceLoader_cms = new Zend_Loader_Autoloader_Resource(array(
                    'basePath' => APPLICATION_PATH . '/../library',
                    'namespace' => 'My_',
                ));

        //$resourceLoader_cms->addResourceType('cms', 'CMS/', 'CMS_');
        //var_dump($resourceLoader_cms->getResourceTypes());
        $autoLoader->pushAutoloader($resourceLoader_cms);

    }


    protected function _initLocale() {
        // define locale
        $locale = new Zend_Locale('en');
      
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

         Zend_Form::setDefaultTranslator($translate);
        // Save it for later
        Zend_Registry::set('Zend_Translate', $translate);
    }

}

