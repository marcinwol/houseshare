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
class My_Mail_AccRecovery extends Zend_Mail {
    
      public function __construct($charset = null) {
          parent::__construct($charset);
          $this->_init();
      }
      
      protected function _init() {
          $this->setSubject('Houseshare: account recovery');          
          $this->setBodyText('This is the text of the mail.');
      }
}

?>
