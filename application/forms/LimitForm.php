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
        
        $this->setAttrib('id', 'limit-form');
        $this->setAttrib('name', 'limit-form');

        $maxPrice = $this->createElement('text', 'maxprice');
        $maxPrice->setRequired(false)->setLabel('Max price per month: ');
        $maxPrice->setAttrib('style', 'border: 0px; width:50px;');
  
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
        
        // create hidden element with current page number
        $pageNo = $this->createElement('hidden','page');
        $pageNo->setValue('1');
        $pageNo->removeDecorator('Label');
        $this->addElement($pageNo);
        
        // create hidden element with current city
        $city = $this->createElement('hidden','city');
        $city->setValue('');
        $city->removeDecorator('Label');
        $this->addElement($city);
        
        
        // accommodation type selection
        $accTypeBed = $this->createElement('checkbox', "bed");
        $accTypeBed->setLabel('Place in a room')->setChecked(true);
        $accTypeBed->setCheckedValue('1');  
        $this->addElement($accTypeBed);
        
        // accommodation type selection
        $accTypeRoom = $this->createElement('checkbox', "room");
        $accTypeRoom->setLabel('Room')->setChecked(true);
        $accTypeRoom->setCheckedValue('2');         
        $this->addElement($accTypeRoom);
        
         // accommodation type selection
        $accTypeAppart = $this->createElement('checkbox', "appartment");
        $accTypeAppart->setLabel('Appartment')->setChecked(true);
        $accTypeAppart->setCheckedValue('3');         
        $this->addElement($accTypeAppart);
        
        
        // have internet
        $internet = $this->createElement('checkbox', "internet");
        $internet->setLabel('Internet must be present')->setChecked(false);
        $internet->setCheckedValue('1');         
        $this->addElement($internet);

        //$submit = $this->createElement('submit', 'submit', array('label' => 'Limit'));
        //$submit->removeDecorator('Label');        
        //$this->addElement($submit);
        
        $limit = $this->createElement('button', 'limit', array('label' => 'Limit'));
        $limit->removeDecorator('Label');        
        $this->addElement($limit);
        
       
    }

}

?>
