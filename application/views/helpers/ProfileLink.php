<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * ProfileLink helper
 *
 * Call as $this->profileLink() in your layout script
 */
class My_View_Helper_ProfileLink extends Zend_View_Helper_Abstract {


     /**
     * View instance
     *
     * @var  Zend_View_Interface
     */
    public $view;


    public function profileLink()  {

        $baseUrl = $this->view->baseUrl();
        
        $auth = Zend_Auth::getInstance();

        $html = '<a href="'.$baseUrl.'/user/login"> Login </a>';

        if ($auth->hasIdentity()) { 
            $identity = $auth->getIdentity();        
            //$gravatar = $this->view->gravatar($identity->property->email, array('imgSize' => 30, 'defaultImg' => 'identicon')); 
            $fname = $identity->property->nickname; 
            $url = $this->view->baseUrl('/user/index/');
            $fnameLink = "<a href=\"$url\"/>$fname</a>";
            $html = $fnameLink . ' <span>|</span> <a href="'.$baseUrl.'/user/logout"> Logout </a>'
            ;
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
