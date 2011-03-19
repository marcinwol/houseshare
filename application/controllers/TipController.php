<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tipController
 *
 * @author marcin
 */
class TipController extends Zend_Controller_Action {

    public function init() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }
    
    public function getAction() { 
        
            $tips = array(
                'cities' => "Wroclaw </br> Wroclaw, Dolnyslask",
                'acctype' => "<b>Room:</b> a room is not shared with other roomates<br/>
                    <b>Bed:</b> a single place in a shared room. 
                    "
            );
        
            $whatTip = $this->getRequest()->getParam('which','');            
            
            if (isset($tips[$whatTip])) {
                echo $tips[$whatTip];                     
            } else {
                echo "No information avaliable";            
            }
            
            exit;
    }
    
}

?>
