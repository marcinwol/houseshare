<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('Zend/Application.php');

require_once('Zend/Test/PHPUnit/ControllerTestCase.php');

/**
 * Description of ControllerTestCase
 *
 * @author marcin
 */
abstract class ControllerTestCase extends Zend_Test_PHPUnit_ControllerTestCase {

    /**
     * Database table authentication adapter
     * Note: To be setUp-ed in child classes, e.g. UserControllerTest.php
     *
     * @var My_Auth_Adapter_DbTable
     */
    protected $_adapter;
    

    /**
     *
     * @var Zend_Application
     */
    public $application;

    public function setUp() {

        $this->application = new Zend_Application(
                        APPLICATION_ENV,
                        APPLICATION_PATH . '/configs/application.ini'
        );

        $this->setupDatabase();

        $this->bootstrap = array($this, 'appBootstrap');
        parent::setUp();
    }

    public function tearDown() {
        
       $db = Zend_Db_Table_Abstract::getDefaultAdapter();
         
       foreach ($db->listTables() as $table) {
            if (strpos($table, 'VIEW_') == 0 ) {
                continue;
            }
            $db->query("TRUNCATE TABLE $table;");
        }
        

        
        Zend_Controller_Front::getInstance()->resetInstance();
        $this->resetRequest();
        $this->resetResponse();

        $this->request->setPost(array());
        $this->request->setQuery(array());
    }

    public function appBootstrap() {
        $this->application->bootstrap();
    }

    public function setupDatabase() {

        $options = $this->application->getOption('resources');

        $db = Zend_Db::factory('Pdo_Mysql', $options['db']['params']);

        $connection = new Zend_Test_PHPUnit_Db_Connection(
                        $db, 'houseshare_test'
        );

        $databaseTester = new Zend_Test_PHPUnit_Db_SimpleTester($connection);

        $databaseFixture =
                new PHPUnit_Extensions_Database_DataSet_FlatXmlDataSet(
                        dirname(__FILE__) . '/_files/database_seed.xml'
        );
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
        
        $databaseTester->setupDatabase($databaseFixture);                        
    }

    protected function _setupAuthAdapter() {
        $this->_adapter = new My_Auth_Adapter_DbTable();
    }

    protected function _clearAuth() {
         Zend_Auth::getInstance()->clearIdentity();
    }

    /**
     * Authenticate a user uzing DbTable adapter and Zend_Auth.
     *
     * @param string $identity
     * @param string $credentials
     */
    protected function _authUser($identity, $credentials) {

        $auth = Zend_Auth::getInstance();
        
        $this->_adapter->setEmailAndPass($identity,$credentials);
        $result = $auth->authenticate($this->_adapter);        
        
        if ($result->isValid()) {
            $userData = $this->_adapter->getResultRowObject(null, 'password');            
            $toStore = (object) array('identity' => $auth->getIdentity());
            $toStore->property = $userData;            
            $auth->getStorage()->write($toStore);           
        } 
    }



}

?>
