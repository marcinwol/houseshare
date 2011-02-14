<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acl
 *
 * @author marcin
 */
class My_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract {

    /**
     *
     * @var Zend_Auth
     */
    protected $_auth;
    /**
     *
     * @var My_CMS_Acl
     */
    protected $_acl;
    protected $_action;
    protected $_controller;
    protected $_currentRole;

    public function __construct(Zend_Acl $acl, array $options = array()) {
        $this->_auth = Zend_Auth::getInstance();
        $this->_acl = $acl;
       
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        $this->_init($request);        

        // if the current user role is not allowed to do something
        if (!$this->_acl->isAllowed($this->_currentRole, $this->_controller, $this->_action)) {
            
            if ('guest' == $this->_currentRole) {
                $request->setControllerName('user');
                $request->setActionName('login');
            } else {
                $request->setControllerName('error');
                $request->setActionName('noauth');
            }
        }
    }

    protected function _init($request) {
        $this->_action = $request->getActionName();
        $this->_controller = $request->getControllerName();
        $this->_currentRole = $this->_getCurrentUserRole();
    }

    protected function _getCurrentUserRole() {      

        if ($this->_auth->hasIdentity()) {
            $identity = $this->_auth->getIdentity();
            $role = strtolower($identity->privilage);
        } else {
            $role = 'guest';
        }

        return $role;
    }

}

?>
