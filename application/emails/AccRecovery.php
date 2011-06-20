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
    
    protected $_template = '_templates/AccRecovery.tpl';
    
    
    /**
     *
     * @var My_Model_Table_Row_User 
     */
    protected $_user;
    
     public function __construct(
            My_Model_Table_Row_User $user, $emailTo = '', $options = array()
            ) {

       
        $this->_user = $user;
        $this->_emailTo = $emailTo;
        $this->_options = $options;

        parent::__construct();
    }
    
    

    protected function _init() {
        
        $this->addTo($this->_emailTo);

        $title = '[ShareHouse] Account recovery';

        $this->setSubject($this->_tr->translate($title)); 
        
        $passwordLogin = false;
        $newPassword = null;
        $provider_type = null;
        $auth_key = null;
        
        
        // first check if user has a password
        $passRow = $this->_user->getPassword();
        $authRow = $this->_user->getAuthProvider();
        
        if ($passRow instanceof My_Model_Table_Row_Password) {
            $passwordLogin = true;
            //need some logic to reset user password
            $newPassword = $passRow->resetPassword();
            
        } else {
            //get info about auth provider
            $provider_type = $authRow->provider_type;
            $auth_key = $authRow->key;
        }
                        
        
        // prepare variables used in a template file
        $vars = array(         
            'username'    => $this->_user->nickname,
            'emailTo'       => $this->_emailTo,
            'loginUrl'    => $this->getLinkTo('/login'),
            'passwordLogin' => $passwordLogin,
            'newPassword' => $newPassword,
            'provider_type' => $provider_type,
            'auth_key' => $auth_key,            
        );
        
        
        $template = $this->_getTemplatePath();
        
        $content = $this->_getEmailBody($template, $vars);

        $this->setBodyText($content);        
        
    }
    
    

}

?>
