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
class My_Form_MainPage extends Zend_Form {

    public function init() {

        $this->setMethod('post');
        
        $this->setAttrib('id','main-search-form');

        // add what do you want to do radio button
//        $mainChoice = new Zend_Form_Element_Radio('rd_what_to_do');
//        $mainChoice->addMultiOptions(
//                array(
//                    '0' => "I need a room in ...",
//                    '1' => "I have a room in ...",
//                )
//        );
//        $mainChoice->removeDecorator('Label');
//        $mainChoice->setRequired(true);
//        $mainChoice->setValue('0');
//        $this->addElement($mainChoice);


        //create new element
        $cities1 = $this->createElement('text', 'i_city');
        $cities1->setRequired(false)->setLabel('I need accommodation in');
        $cities1->setAttrib('class', 'help tipped');
        $cities1->setAttrib('title', ' give a city name');
        $cities1->setFilters(array('stripTags', 'stringTrim'));
       // $cities1->removeDecorator('Label');
//        $cities1->addDecorator(new My_Form_Decorator_Jtip(
//                        array(
//                            'tipurl' => '/tip/get/which/cities',
//                            'tipname' => 'Example values',
//                        )
//        ));

        $this->addElement($cities1);
//
//        $maxPrice = $this->createElement('text', 'maxprice');
//        $maxPrice->setRequired(true)->setLabel('Maximum price per month: ');
//        $maxPrice->setAttrib('style', 'border: 0px; width:30px;');
//  
//        $slider = create_function(
//                '$content, $element, array $options', 'return "<div id=\"slider\"></div>";'
//        );
//
//        $maxPrice->setDecorators(array(
//            'ViewHelper',
//            'Label',
//            array('Callback', array('callback' => $slider, 'placement' => 'APPEND')),
//            array('HtmlTag', array('tag' => 'dd', 'id' => 'maxprice-element'))
//        ));
//        
//        $this->addElement($maxPrice);


        $submit = $this->createElement('submit', 'submit', array('label' => 'Search'));
        $submit->removeDecorator('Label');        
        $this->addElement($submit);
       
    }

}

?>
