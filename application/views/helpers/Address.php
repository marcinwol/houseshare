<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Address
 *
 * @author marcin
 */
class My_View_Helper_Address extends Zend_View_Helper_Abstract {

      
    public function address(My_Houseshare_Accommodation $acc) {
            
        $address = '';
        
        $address = $acc->address->street;
        $unit_no = $acc->address->unit_no;
        
        if (true == $acc->street_address_public) {
             $address .= " {$acc->address->street_no}";
             if (!empty($unit_no)) {
                 $address .= " m. {$acc->address->unit_no}";
             }
        }
                
        $address .=", {$acc->address->city} ";
        
        return $address;
      
    }
    
    
  

}

?>
