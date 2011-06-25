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
    
    protected $_template = '_templates/AccQuery.tpl';


    /**
     *
     * @var My_Houseshare_Accommodation 
     */
    protected $_acc;

    public function __construct(
    My_Houseshare_Accommodation $acc, $emailFrom, $message = "", $options = array()
    ) {


        $this->_acc = $acc;
        $this->_emailTo = $acc->user->email;
        $this->_emailFrom = $emailFrom;
        $this->_message = $message;
        $this->_options = $options;

        parent::__construct();
    }

    protected function _init() {

        $this->addTo($this->_emailTo);

        $title = '[ShareHouse] A query about your advertisment';

        $this->setSubject($this->_tr->translate($title));

        // prepare variables used in a template file
        $vars = array(
            'username' => $this->_acc->user->nickname,
            'advertTitle' => $this->_acc->title,
            'advertUrl' => $this->_acc->url,
            'message' => $this->_message,
            'fromMail' => $this->_emailFrom,
        );

        $template = $this->_getTemplatePath();

        $content = $this->_getEmailBody($template, $vars);

        $this->setBodyHtml($content, 'utf8');
    }

}

?>
