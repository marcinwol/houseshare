<?php

// Initialize the application path and autoloading
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../'));

set_include_path(implode(PATH_SEPARATOR, array(
    APPLICATION_PATH . '/../library',
    get_include_path(),
)));

require_once APPLICATION_PATH . '/../library/Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();