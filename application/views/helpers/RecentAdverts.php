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

    public function recentAdverts() {

        $lastAccs = $this->_getLastAccommodations();        

        return $this->view->partial(
                '_partials/_recentAdverts.phtml', null, 
                array(
                    'accommodations' => $lastAccs,
                    'title'   => 'Recent advertisements'
                    )
        );
    }
    
    
    protected function _getLastAccommodations() {
        $accModel = new My_Model_Table_Accommodation();
        $lastAccs = $accModel->getLastAccommodations(self::NO_OF_ACCS);
        return $lastAccs->toModels();
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
