<?php

class My_View_Helper_ViewCache extends Zend_View_Helper_Abstract {

    /**
     *
     * @var Zend_Cache_Frontend_Output
     */
    private $_cache = null;

    public function viewCache() {

        if (null == $this->_cache) {

            $this->_cache = Zend_Controller_Front::getInstance()
                    ->getParam('bootstrap')
                    ->getResource('cachemanager')
                    ->getCache('myviewcache');
        }              

        return $this->_cache;
    }

}

?>
