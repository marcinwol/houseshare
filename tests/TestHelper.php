<?php
error_reporting(E_ALL | E_STRICT);

// Define path to application directory
defined('APPLICATION_PATH')
        || define('APPLICATION_PATH',
                realpath(dirname(__FILE__) . '/../application'));

// Define testing application environment
define('APPLICATION_ENV', 'testing');

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
            realpath(APPLICATION_PATH . '/../library'),
            get_include_path(),
        )));


require_once('application/ControllerTestCase.php');
require_once('application/ModelTestCase.php');
require_once('application/ValidatorTestCase.php');