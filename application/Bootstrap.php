<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers/', 'My_View_Helper');
    }

    protected function _initAutoload() {
        $autoLoader = Zend_Loader_Autoloader::getInstance();

        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
                    'basePath' => APPLICATION_PATH,
                    'namespace' => '',
                ));

        $resourceLoader->addResourceType(
                'view', 'views/helpers/', 'My_View_Helper_'
        );
        $resourceLoader->addResourceType('form', 'forms/', 'My_Form_');
        $resourceLoader->addResourceType('model', 'models/', 'My_Model_');
        $resourceLoader->addResourceType('validate', 'validators/', 'My_Validate_');
        $resourceLoader->addResourceType('loader', 'loaders/', 'My_Loader_');


        $autoLoader->pushAutoloader($resourceLoader);
        $autoLoader->pushAutoloader(new My_Loader_Autoloader_PhpThumb());


        // add 'My_' namespace for library/houseshare
        $resourceLoader_hs = new Zend_Loader_Autoloader_Resource(array(
                    'basePath' => APPLICATION_PATH . '/../library',
                    'namespace' => 'My_',
                ));

        $resourceLoader_hs->addResourceType('houseshare', 'Houseshare/', 'Houseshare_');
        //var_dump($resourceLoader_cms->getResourceTypes());
        $autoLoader->pushAutoloader($resourceLoader_hs);
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

    protected function _initImageDirConstants() {
        // define path to directory where photos should be uploaded
        // and the name of thumbs directory
        $imagePaths = $this->getOption('myimages');
        
        $imBaseDir = $imagePaths['basedir'];

        if ('vfs' !== substr($imBaseDir,0,3)) {
            // vfs is for vsfStream that is used for testing
            // to mock file system operations
            $imBaseDir = realpath($imBaseDir);
        }

        defined('PHOTOS_PATH')
                || define('PHOTOS_PATH', $imBaseDir);

        defined('THUMBS_DIR_NAME')
                || define('THUMBS_DIR_NAME', $imagePaths['thumbdirname']);

        defined('PHOTO_DIR_NAME')
                || define('PHOTO_DIR_NAME', basename(PHOTOS_PATH));

        defined('THUMBS_PATH')
                || define('THUMBS_PATH', $imBaseDir . '/' .THUMBS_DIR_NAME);

    }

}

