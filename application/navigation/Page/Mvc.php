<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mvc
 *
 * @author marcin
 */
class My_Navigation_Page_Mvc extends Zend_Navigation_Page_Mvc {

    protected $_name = null;

    /**
     * Sets page name 
     *     
     *
     * @param  string $name             page name
     * @return Zend_Navigation_Page_Mvc   fluent interface, returns self
     * @throws Zend_Navigation_Exception  if invalid $action is given
     */
    public function setName($name) {
        if (null !== $name && !is_string($name)) {
            require_once 'Zend/Navigation/Exception.php';
            throw new Zend_Navigation_Exception(
                    'Invalid argument: $action must be a string or null');
        }

        $this->_name = $name;
        return $this;
    }

    /**
     * Returns name of the page
     *
     * @see getHref()
     *
     * @return string|null  action name
     */
    public function getName() {
        return $this->_name;
    }

}

?>
