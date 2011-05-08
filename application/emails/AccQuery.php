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
    const TEMPLATE = '_templates/AccQuery.tpl';

    /**
     *
     * @var My_Houseshare_Accommodation 
     */
    private $_acc;
    /**
     *
     * @var string
     */
    private $_emailTo;
    private $_emailFrom;
    private $_message;

    public function __construct(My_Houseshare_Accommodation $acc, $emailFrom, $message) {
        parent::__construct();
        $this->_acc = $acc;
        $this->_emailTo = $acc->user->email;
        $this->_emailFrom = $emailFrom;
        $this->_message = $message;
        $this->_init();
    }

    protected function _init() {
        $this->addTo($this->_emailTo);
        $this->setSubject('[ShareHouse] A query about your advertisment');
               
        $username    = $this->_acc->user->nickname;
        $advertTitle = $this->_acc->title;
        $advertUrl = $this->_acc->url;
        $message     = $this->_message;
        $fromMail    = $this->_emailFrom;

        ob_start();

        include APPLICATION_PATH . '/emails/' . My_Mail_AccQuery::TEMPLATE;
      
        $content = ob_get_contents();
        ob_end_clean();

        $this->setBodyText($content);
    }

}

?>
