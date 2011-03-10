<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initDoctype() {
        $this->bootstrap('view');
        /* @var $view Zend_View */
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers/', 'My_View_Helper');

        $container = new Zend_Navigation(
                        new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav')
        );

        $view->navigation()->setContainer($container);
    }

    protected function _initAutoload() {
        $autoLoader = Zend_Loader_Autoloader::getInstance();

        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
                    'basePath' => APPLICATION_PATH,
                    'namespace' => '',
                    'resourceTypes' => array(
                        'view' => array(
                            'path' => 'views/helpers/',
                            'namespace' => 'My_View_Helper_'
                        ),
                        'form' => array(
                            'path' => 'forms/',
                            'namespace' => 'My_Form_'
                        ),
                        'model' => array(
                            'path' => 'models/',
                            'namespace' => 'My_Model_'
                        )
                    )
                ));

        $resourceLoader->addResourceType('validate', 'validators/', 'My_Validate_');
        $resourceLoader->addResourceType('loader', 'loaders/', 'My_Loader_');
        $resourceLoader->addResourceType('authAdapter', 'auth/', 'My_Auth_');
        $resourceLoader->addResourceType('controller', 'controllers/', 'My_Controller_');
        $resourceLoader->addResourceType('acl', 'acl/', 'My_');
        $resourceLoader->addResourceType('openidextension', 'openid/extension/', 'My_OpenId_Extension');
        //$resourceLoader->addResourceType('authAdapter', 'auth/Adapter', 'My_Auth_Adapter');


        $autoLoader->pushAutoloader($resourceLoader);
        //  require_once APPLICATION_PATH . '/loaders/Autoloader/PhpThumb.php';
        $autoLoader->pushAutoloader(new My_Loader_Autoloader_PhpThumb());

        //   var_dump($autoLoader->getAutoloaders());
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

        $cache = Zend_Cache::factory(
                        'Core',
                        'File',
                        array('automatic_serialization' => true),
                        array('cache_dir' => APPLICATION_PATH . '/../tmp')
        );

        $locale->setCache($cache);

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
    }

    protected function _initAclControllerPlugin() {
        $this->bootstrap('frontcontroller');
        
        $front = Zend_Controller_Front::getInstance();
        $aclConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/acl.ini');

        $aclPlugin = new My_Controller_Plugin_Acl(new My_Acl($aclConfig));

        $front->registerPlugin($aclPlugin);
    }

    protected function _initImageDirConstants() {
        // define path to directory where photos should be uploaded
        // and the name of thumbs directory
        $imagePaths = $this->getOption('myimages');


        $imBaseDir = $imagePaths['basedir'];

        if ('vfs' !== substr($imBaseDir, 0, 3)) {
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
                || define('THUMBS_PATH', $imBaseDir . '/' . THUMBS_DIR_NAME);
    }

    protected function _initAppKeysToRegistry() {


        $appkeys = null;

        $file = APPLICATION_PATH . '/configs/appkeys.ini';

        if (file_exists($file)) {
            $appkeys = new Zend_Config_Ini($file);
        }

        Zend_Registry::set('keys', $appkeys);
    }

}
