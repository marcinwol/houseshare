<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailHide
 *
 * @author marcin
 */
class My_View_Helper_MailHide extends Zend_View_Helper_Abstract {

    /**
     * View instance
     *
     * @var  Zend_View_Interface
     */
    public $view;

    /**
     *  Hide email addresses using reCAPTCHA.
     *
     * @param string $email email to hide     
     * @return string link for hidden email
     */
    public function mailHide($email) {

        $mailHide = $this->_setupReCaptcha();
        
        $mailHide->setEmail($email);
        
        return (string) $mailHide;
    }
    
    protected function _setupReCaptcha() {
        
        $keys = Zend_Registry::get('keys');
        
        $mailHide = new Zend_Service_ReCaptcha_MailHide();
        $mailHide->setPublicKey($keys->mailhide->key->public);
        $mailHide->setPrivateKey($keys->mailhide->key->private);
        
        return $mailHide;
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
