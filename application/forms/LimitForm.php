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




        // accommodation type selection
        $accTypeBed = $this->createElement('checkbox', "bed");
        $accTypeBed->setLabel('A place in a room')->setChecked(false);
        $accTypeBed->setCheckedValue('1');
        $this->addElement($accTypeBed);


        // accommodation type selection
        $accTypeRoom = $this->createElement('checkbox', "room");
        $accTypeRoom->setLabel('Room')->setChecked(false);
        $accTypeRoom->setCheckedValue('2');
        $this->addElement($accTypeRoom);

        // accommodation type selection
        $accTypeAppart = $this->createElement('checkbox', "appartment");
        $accTypeAppart->setLabel('Appartment')->setChecked(false);
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
        // create hidden element with deafulat max price
        $defMaxPrice = $this->createElement('hidden', 'max-price-default');
        $defMaxPrice->setValue(3000);
        $defMaxPrice->removeDecorator('Label')->removeDecorator('HtmlTag');
        $this->addElement($defMaxPrice);

        // create hidden element with current page number
        $pageNo = $this->createElement('hidden', 'page');
        $pageNo->setValue('1');
        $pageNo->removeDecorator('Label')->removeDecorator('HtmlTag');
        $this->addElement($pageNo);

        // create hidden element with current city
        $city = $this->createElement('hidden', 'city');
        $city->setValue('');
        $city->removeDecorator('Label')->removeDecorator('HtmlTag');
        $this->addElement($city);
        


        $limit = $this->createElement('button', 'limit', array('label' => 'Limit'));
        $limit->removeDecorator('Label');
        $this->addElement($limit);


        $this->setDecorators(
                array(
                     new My_Form_Decorator_FormElements(array('separator' => '<br />')) ,                  
                    'Form'
                )
        );
    }
    
}

?>
