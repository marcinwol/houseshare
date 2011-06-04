<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SendEmail
 *
 * @author marcin
 */
class My_Form_SendEmail extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        //  $this->setAttrib('style', 'display:none');
        $this->setAttrib('id', 'form-sendemail');

        // add an email field
        $email = $this->createElement('text', 'email');
        $email->setLabel('Your email');
        $email->setRequired()->addValidator('EmailAddress');
        $email->removeDecorator('Errors');
       

        // ad a textarea with a body of the email
        $body = $this->createElement('textarea', 'message');
        $body->setLabel('Your query');
        $body->setRequired();
        $body->removeDecorator('Errors');
        $body->addValidator('StringLength', array('min' => 30, 'max' => 256));
    

        $accID = $this->createElement('hidden','acc_id');        
        $accID->removeDecorator('Label');
        $this->addElement($accID);
        
        
        //$captcha = $this->_makeRecaptchaElement2();

        $send = $this->createElement('submit', 'send');
        $send->setLabel('Send');

        $this->addElements(array($email, $body, $send));
    }
    
    public function prefillMessage(My_Houseshare_Accommodation $acc) {
        
        $msg = 'Is your offer titled "%value%" still avaliable?';
                        
        $msg = $this->getTranslator()->translate($msg);
                
        $msg = str_replace('%value%', $acc->title, $msg);
        
        $this->message->setValue($msg);
        
    }

    /**
     * Create a ReCaptcha element
     * 
     * @return Zend_Form_Element_Captcha 
     */
    protected function _makeRecaptchaElement() {

        $keys = Zend_Registry::get('keys');

        $publickey = $keys->recaptcha->key->public;
        $privatekey = $keys->recaptcha->key->private;

        $recaptcha = new Zend_Service_ReCaptcha($publickey, $privatekey);
        $recaptcha->setOptions(array('theme' => 'clean'));


        $captcha = new Zend_Form_Element_Captcha('captcha',
                        array(
                            'captcha' => 'ReCaptcha',
                            'captchaOptions' => array(
                                'captcha' => 'ReCaptcha',
                                'service' => $recaptcha
                            ),
                            'ignore' => true
                        )
        );


        return $captcha;
    }

    /**
     * Create a captcha image element
     * 
     * @return Zend_Form_Element_Captcha 
     */
    protected function _makeRecaptchaElement2() {

        $captcha = new Zend_Form_Element_Captcha('captcha', array(
                    'label' => "Security code",
                    'captcha' => 'image',
                    'captchaOptions' => array(
                        'captcha' => 'image',
                        'font' => APPLICATION_PATH . '/fonts/FreeSans.ttf',
                        'imgDir' => APPLICATION_PATH . '/../public/captchas/',
                        'imgUrl' => '/houseshare/public/captchas/',
                        'dotNoiseLevel' => 12,
                        'lineNoiseLevel' => 0.5,
                        'wordLen' => 6,
                        'fsize' => 24,
                        'height' => 60
                        )
                ));


        return $captcha;
    }

}

?>
