<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DbTable
 *
 * @author marcin
 */
class My_Auth_Adapter_DbTable extends Zend_Auth_Adapter_DbTable {

    protected $_tableName           = 'VIEW_USER_FOR_AUTH';
    protected $_identityColumn      = 'email';
    protected $_credentialColumn    = 'password';
    protected $_credentialTreatment = 'MD5(?)';


    public function __construct() {
      
        $zendDb = Zend_Db_Table::getDefaultAdapter();
        $this->_setDbAdapter($zendDb);

    }

    /**
     * Set Identity and Credentail to be chacked.
     *
     * @param string $email
     * @param string $password
     */
    public function setEmailAndPass($email, $password) {
        $this->setIdentity($email);
        $this->setCredential($password);
    }

}
?>
