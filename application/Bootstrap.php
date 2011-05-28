<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    function _initViewHelpers() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML4_STRICT');
        $view->setHelperPath(APPLICATION_PATH . '/helpers', '');
        $view->headMeta()->appendHttpEquiv('Content-type', 'text/html;charset=utf-8')
                ->appendName('description', 'Zend Framework');
        $view->headTitle()->setSeparator(' - ');
        $view->setScriptPath(APPLICATION_PATH . '/themes/admin');

        return $view;
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
                        ),
                        'email' => array(
                            'path' => 'emails/',
                            'namespace' => 'My_Mail_'
                        ),
                        'navigation' => array(
                            'path' => 'navigation/',
                            'namespace' => 'My_Navigation_'
                        )
                    )
                ));

        $resourceLoader->addResourceType('validate', 'validators/', 'My_Validate_');
        $resourceLoader->addResourceType('loader', 'loaders/', 'My_Loader_');
        $resourceLoader->addResourceType('authAdapter', 'auth/', 'My_Auth_');
        $resourceLoader->addResourceType('controller', 'controllers/', 'My_Controller_');
        $resourceLoader->addResourceType('acl', 'acl/', 'My_');
        $resourceLoader->addResourceType('openidextension', 'openid/extension/', 'My_OpenId_Extension');


        $autoLoader->pushAutoloader($resourceLoader);

        $autoLoader->pushAutoloader(new My_Loader_Autoloader_PhpThumb());

        $resourceLoader_hs = new Zend_Loader_Autoloader_Resource(array(
                    'basePath' => APPLICATION_PATH . '/../library',
                    'namespace' => 'My_',
                ));

        $resourceLoader_hs->addResourceType('houseshare', 'Houseshare/', 'Houseshare_');

        $autoLoader->pushAutoloader($resourceLoader_hs);
        $autoLoader->registerNamespace('ZC_');
    }

    protected function _initDoctype() {
        $this->bootstrap('view');
        /* @var $view Zend_View */
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers/', 'My_View_Helper');


       // Zend_Navigation_Page::setDefaultPageType('My_Navigation_Page_Mvc');
        
        $container = new Zend_Navigation(
                        new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav')
        );




        $view->navigation()->setContainer($container);
    }

    protected function _initLocale() {
        // define locale
        $locale = new Zend_Locale('en');

        $cache = Zend_Cache::factory(
                        'Core', 'File', array('automatic_serialization' => true), array('cache_dir' => APPLICATION_PATH . '/../tmp')
        );

        $locale->setCache($cache);

        // register it so that it can be used all over the website
        Zend_Registry::set('Zend_Locale', $locale);
    }

    protected function _initMyRoutes() {
        $this->bootstrap('frontcontroller');
        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();

        // get cache for config files
        $cacheManager = $this->bootstrap('cachemanager')->getResource('cachemanager');
        $cache = $cacheManager->getCache('configFiles');
        $cacheId = 'routesini';

        # $t1 = microtime(true);
        $myRoutes = $cache->load($cacheId);

        if (!$myRoutes) {
            $myRoutes = new Zend_Config_Ini(APPLICATION_PATH . '/configs/routes.ini');
            $cache->save($myRoutes, $cacheId);
        }
        #$t2 = microtime(true);
        #echo ($t2-$t1);

        $router->addConfig($myRoutes, 'routes');
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

        Zend_Registry::set('Zend_Translate', $translate);
    }

    protected function _initAclControllerPlugin() {
        $this->bootstrap('frontcontroller');
        $front = Zend_Controller_Front::getInstance();

        // get cache for config files
        $cacheManager = $this->bootstrap('cachemanager')->getResource('cachemanager');
        $cache = $cacheManager->getCache('generic');
        $cacheId = 'acl';


        $aclArray = $cache->load($cacheId);
        $acl = $aclArray[0];
        $aclPlugin = $aclArray[1];

        if (!$aclArray) {
            $aclConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/acl.ini');

            $acl = new My_Acl($aclConfig);

            $aclPlugin = new My_Controller_Plugin_Acl($acl);
            $cache->save(array($acl, $aclPlugin), $cacheId);
        }



        $front->registerPlugin($aclPlugin);

        Zend_View_Helper_Navigation_HelperAbstract::setDefaultAcl($acl);
        Zend_View_Helper_Navigation_HelperAbstract::setDefaultRole('guest');
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

        defined('PHOTOS_NUMBER')
                || define('PHOTOS_NUMBER', (int) $imagePaths['photosNumber']);
    }

    protected function _initAppKeysToRegistry() {


        $appkeys = null;

        $file = APPLICATION_PATH . '/configs/appkeys.ini';

        if (file_exists($file)) {
            $appkeys = new Zend_Config_Ini($file);
        }

        Zend_Registry::set('keys', $appkeys);
    }

    protected function _initSetDefaultKeywords() {
        $view = $this->bootstrap('view')->getResource('view');
        $view->keywords = 'sharehouse, rooms for rent, appartments, students';
    }

    protected function _initSetZendMail() {


        // get cache for config files
        $cacheManager = $this->bootstrap('cachemanager')->getResource('cachemanager');
        $cache = $cacheManager->getCache('generic');
        $cacheId = 'mail';



        $tr = $cache->load($cacheId);

        if (!$tr) {

            $file = APPLICATION_PATH . '/configs/mailsmtp.ini';

            if (file_exists($file)) {
                $smtp = new Zend_Config_Ini($file);
            } else {
                throw new Zend_Mail_Exception('No mailsmtp.ini found');
            }

            $tr = new Zend_Mail_Transport_Smtp(
                            $smtp->mail->host, $smtp->mail->toArray()
            );

            $cache->save($tr, $cacheId);
        }


        Zend_Mail::setDefaultTransport($tr);
    }

    protected function _initPutChacesIntoRegistry() {
        $this->bootstrap('cachemanager');
        $cacheManager = $this->getResource('cachemanager');

        Zend_Registry::set('recentAdvertsCache', $cacheManager->getCache('recentAdverts'));
        Zend_Registry::set('outputCache', $cacheManager->getCache('myviewcache'));
        Zend_Registry::set('genericCache', $cacheManager->getCache('generic'));
    }

}
