<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class My_Form_TestForm extends Zend_Form {

    public function __construct($options = null) {

        parent::__construct($options);

        // Set the method for the display form to POST
        $this->setMethod('post');

        $elements = array();
        
        $options['columns'] = array('test','test1','test2');
        

        // Get user input to create elements
        $fields = $options['columns'];

        // Create form elements
        for ($i = 0; $i < count($fields); $i++) {
            $element = $this->createElement('text', 'field' . $i);
            $element->setLabel($fields[$i]['name']);
            $elements[] = $element;
        }

        $this->addElements($elements);
        $this->setElementDecorators(array('ViewHelper'));
       // $this->setDecorators(array(array('ViewScript', array('viewScript' => 'myform-form.phtml'))));
    }

// end class

    public function init() {

        
    }

}

?>
