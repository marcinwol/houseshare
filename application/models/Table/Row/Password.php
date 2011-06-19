<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Password
 *
 * @author marcin
 */
class My_Model_Table_Row_Password extends Zend_Db_Table_Row_Abstract {

    /**
     * Reset password using random one.
     * 
     * @param int $length password length (default 6)
     * @return string new password 
     */
   public function resetPassword($length = 6) {
       
       $newPass = My_Houseshare_Tools::createPassword($length);
       
       $this->password = md5($newPass);
       
       if (!is_numeric($this->save())) {
           throw new Zend_Db_Statement_Exception('Cannot reset password');
       }
       
       return $newPass;       
   }

}
?>
