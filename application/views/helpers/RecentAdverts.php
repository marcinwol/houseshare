<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecentAdverts
 *
 * @author marcin
 */
class My_View_Helper_RecentAdverts extends Zend_View_Helper_Abstract {
    /**
     * Number of newest accommodations to return
     */
    const NO_OF_ACCS = 10;

    /**
     * View instance
     *
     * @var  Zend_View_Interface
     */
    public $view;

    public function recentAdverts($page = 1, $ajax = false) {

        $cache = $this->getCache();

        $cacheId = 'recentAdverts_' . $page;
        $html = $cache->load($cacheId);

        if (!$html) {
            $lastAccs = $this->_getLastAccommodations($page);
           
            
            $html = $this->view->partial(
                            '_partials/_recentAdverts.phtml', null, array(
                        'accommodations' => $lastAccs,
                        'title' => 'Recent advertisements',
                        'isAjax' => $ajax
                            )
            );
                                    
             $cache->save($html, $cacheId, array('adverts'));             
        }

        return $html;
    }

    /**
     *
     * @return Zend_Paginator Zend_Paginator
     */
    protected function _getLastAccommodations($page = 1) {
        $accModel = new My_Model_Table_Accommodation();
        $paginator = $accModel->getLastAccommodations($page, self::NO_OF_ACCS);
        return $paginator;
    }

    /**
     * Get Zend_View instance
     *
     * @param Zend_View_Interface $view
     */
    public function setView(Zend_View_Interface $view) {
        $this->view = $view;
    }

    /**
     *
     * Get recentAdverts cache
     * 
     * @return  Zend_Cache_Core
     */
    public function getCache() { 
        return Zend_Registry::get('recentAdvertsCache');
    }

}

?>
