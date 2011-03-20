<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of MainPageForm
 *
 * This is the form on the main page that is used for selecting searching
 * accomodation or indicating that you have an accomodation to share.
 *
 * @author marcin
 */
class My_Form_LimitForm extends Zend_Form {

    public function init() {

        $this->setMethod('post');
        

        $maxPrice = $this->createElement('text', 'maxprice');
        $maxPrice->setRequired(true)->setLabel('Maximum price per month: ');
        $maxPrice->setAttrib('style', 'border: 0px; width:30px;');
  
        $slider = create_function(
                '$content, $element, array $options', 'return "<div id=\"slider\"></div>";'
        );

        $maxPrice->setDecorators(array(
            'ViewHelper',
            'Label',
            array('Callback', array('callback' => $slider, 'placement' => 'APPEND')),
            array('HtmlTag', array('tag' => 'dd', 'id' => 'maxprice-element'))
        ));
        
        $this->addElement($maxPrice);

        // create hidden element with deafulat max price
        $defMaxPrice = $this->createElement('hidden','max-price-default');
        $defMaxPrice->setValue(2000);
        $defMaxPrice->removeDecorator('Label');
        $this->addElement($defMaxPrice);

        $submit = $this->createElement('submit', 'submit', array('label' => 'Limit'));
        $submit->removeDecorator('Label');        
        $this->addElement($submit);
       
    }

}

?>
