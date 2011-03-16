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
class My_Mail_AccQuery extends Zend_Mail {
    
      public function __construct($charset = null) {
          parent::__construct($charset);
          $this->_init();
      }
      
      protected function _init() {
          $this->setSubject('Question regarding houseshare advertisment ???');          
          $this->setBodyText('This is the text of the mail.');
      }
}

?>
