<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccUrl
 *
 * @author marcin
 */
class My_View_Helper_AccUrl extends Zend_View_Helper_Abstract {

    /**
     * View instance
     *
     * @var  Zend_View_Interface
     */
    public $view;

    /**
     * Make an url to acc using route
     *
     * @param My_Houseshare_Accommodation $acc
     * @return string url to /acc/show
     */
    public function accUrl(My_Houseshare_Accommodation $acc, $route = 'showacc') {

        $type   = lcfirst($acc->getTypeAsString());
        $city   = strtolower($acc->city);
        $acc_id = $acc->acc_id;
        $title  = strtolower($acc->title); 
        
        $url = $this->view->url(array('city' => $city, 'type'=>$type, 'id' => $acc_id, 'title' => "$title"), $route);

        return $url;
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
