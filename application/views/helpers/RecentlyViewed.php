<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecentlyViewed
 *
 * @author marcin
 */
class My_View_Helper_RecentlyViewed extends Zend_View_Helper_Abstract {

    /**
     * View instance
     *
     * @var  Zend_View_Interface
     */
    public $view;

    public function recentlyViewed($limit = 5) {

        $cache = Zend_Registry::get('frontsidebarCache');
        $html = $cache->load('recentlyViewd');
        
        if (!$html) {
            $html = '<ul class="top-cities">';
            
            $accModel = new My_Model_Table_Accommodation();

            $results = $accModel->getRecentlyViewed($limit)->toModels();
            
            foreach ($results as $acc) {                
                $title = $this->view->truncate(ucfirst(strtolower($acc->title)), 0, 25);
                $html .= '<li><a href="' . $this->view->accUrl($acc) . '">' . $title . ' <span>(' . $acc->city . ')</span></a></li>';
            }

            $html .= '</ul>';
            $cache->save($html, 'recentlyViewd');
        }
        
        return $html;
    }

    /**
     * Get Zend_View instance
     *
     * @param Zend_View_Interface $view
     */
    public function setView(Zend_View_Interface $view) {
        $this->view = $view;
    }

}

?>
