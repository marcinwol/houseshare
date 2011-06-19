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
abstract class My_Mail_Abstract extends Zend_Mail {

    /**
     * Relative path to template
     * 
     * @var string 
     */
    protected $_template;
    
    /**
     * Mail character set
     * @var string
     */
    protected $_charset = 'utf8';
   
    /**
     *
     * @var string
     */
    protected $_emailTo;
    protected $_emailFrom;
    protected $_message;
    protected $_tr;
    protected $_options = array();

    public function __construct() {

        $this->setFrom('marcinwol@gmail.com', SITE_NAME);

        $this->_tr = Zend_Registry::get('Zend_Translate');

        $this->_init();
    }

    abstract protected function _init();

    /**
     * Get email template for current locale.
     * 
     * 
     * @return string path to email template file
     */
    protected function _getTemplatePath() {

        $template = $this->_template;
              

        $lang = Zend_Registry::get('Zend_Locale')->getLanguage();

        if ('en' != $lang) {
            $template = str_replace('.tpl', "-$lang.tpl", $template);
        }

        $templatePath = APPLICATION_PATH . '/emails/' . $template;

        // if no template for a current lang, then return default one.
        if (!file_exists($templatePath)) {
            $templatePath = APPLICATION_PATH . '/emails/' . $this->_template;
        }



        return $templatePath;
    }

    /**
     * Get an email body from template.
     * 
     * 
     * @param string $template path to the template
     * @return body of the email 
     */
    protected function _getEmailBody($template, $vars = array()) {

        
        extract($vars);
        
        ob_start();

        include $template;

        $content = ob_get_contents();
        ob_end_clean();
        
        return $content;
    }

}

?>
