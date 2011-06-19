<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Abstract
 *
 * @author marcin
 */
class My_Mail_Abstract extends Zend_Mail {        

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
    private $_tr;
    private $_options = array();

    public function __construct(My_Houseshare_Accommodation $acc, $emailFrom, 
                    $message = "", $options = array()) {
        parent::__construct();
        $this->_acc = $acc;
        $this->_emailTo = $acc->user->email;
        $this->_emailFrom = $emailFrom;
        $this->_message = $message;
        $this->_options = $options;
        
        $this->_tr = Zend_Registry::get('Zend_Translate');
        
        $this->_init();
    }

    abstract protected function __init();

    /**
     * Get email template for current locale.
     * 
     * 
     * @return string path to email template file
     */
    protected function getTemplatePath() {

        $template = My_Mail_AccQuery::TEMPLATE;

        $lang = Zend_Registry::get('Zend_Locale')->getLanguage();

        if ('en' != $lang) {
            $template = str_replace('.tpl', "-$lang.tpl'", $template);
        }

        $templatePath = APPLICATION_PATH . '/emails/' . $template;

        // if no template for a current lang, then return default one.
        if (!file_exists($templatePath)) {
            $templatePath = APPLICATION_PATH . '/emails/' . My_Mail_AccQuery::TEMPLATE;
        }

        return $templatePath;
    }

}

?>
