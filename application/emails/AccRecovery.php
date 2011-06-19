<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Mail_AccRecovery
 *
 * @author marcin
 */
class My_Mail_AccRecovery extends My_Mail_Abstract {
    
    const TEMPLATE = '_templates/AccRecovery.tpl';

    protected function _init() {
        $this->addTo($this->_emailTo);

        $title = '[ShareHouse] Account recovery';

        $this->setSubject($this->_tr->translate($title));       
                
        $username    = $this->_acc->user->nickname;
        $advertTitle = $this->_acc->title;
        $advertUrl   = $this->_acc->url;
        
        $fromMail    = $this->_emailFrom;
        
        $template = $this->getTemplatePath();
        
        
        ob_start();

        include APPLICATION_PATH . '/emails/' . $template;
      
        $content = ob_get_contents();
        ob_end_clean();

        $this->setBodyText($content);        
        
    }

}

?>
