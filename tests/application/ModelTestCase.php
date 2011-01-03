<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


require_once('Zend/Application.php');
require_once('Zend/Test/PHPUnit/DatabaseTestCase.php');

/**
 * Description of ModelTestCase
 *
 * @author marcin
 */
class ModelTestCase extends Zend_Test_PHPUnit_DatabaseTestCase {

    private $_connectionMock;
    public $application;

    public function setUp() {

        $this->application = new Zend_Application(
                        APPLICATION_ENV,
                        APPLICATION_PATH . '/configs/application.ini'
        );
        $this->appBootstrap();
        parent::setUp();
    }

    public function appBootstrap() {
        $this->application->bootstrap();
    }

    public function getConnection() {

        $options = $this->application->getOption('resources');

        if ($this->_connectionMock == null) {

            $db = Zend_Db::factory('Pdo_Mysql', $options['db']['params']);

            $this->_connectionMock = $this->createZendDbConnection(
                            $db, 'houseshare_test');

            Zend_Db_Table_Abstract::setDefaultAdapter($db);
        }
        return $this->_connectionMock;
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet() {
        return $this->createFlatXmlDataSet(
                dirname(__FILE__) . '/_files/database_seed.xml'
        );
    }

    public function tearDown() {
        $this->_connectionMock->close();
        parent::tearDown();
    }

}

?>
