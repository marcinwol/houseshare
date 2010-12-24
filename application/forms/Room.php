<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Room
 *
 * @author marcin
 */
class My_Form_Room extends My_Form_Abstract_AccommodationAbstract {
    //put your code here
    
    public function init() {
        $accInfoSubForm = $this->makeAccBasicDescSubForm();

        $this->addSubForm($accInfoSubForm, 'Basic info');

        // Create a submit button.
        $this->addElement('submit', 'Submit');

    }

}
?>
