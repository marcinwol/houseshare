<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccQuery
 *
 * @author marcin
 */
class My_Mail_AccQuery extends My_Mail_Abstract {
    
    const TEMPLATE = '_templates/AccQuery.tpl';    
   

    protected function _init() {
        $this->addTo($this->_emailTo);
        
        $title = '[ShareHouse] A query about your advertisment';
        
        $this->setSubject($this->_tr->translate($title));
               
        $username    = $this->_acc->user->nickname;
        $advertTitle = $this->_acc->title;
        $advertUrl   = $this->_acc->url;
        $message     = $this->_message;
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
