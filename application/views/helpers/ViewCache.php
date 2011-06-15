<?php

class My_View_Helper_ViewCache extends Zend_View_Helper_Abstract {

    /**
     *
     * @return Zend_Cache_Frontend_Output 
     */
    public function viewCache() {
        return Zend_Registry::get('outputCache');
    }

}

?>
