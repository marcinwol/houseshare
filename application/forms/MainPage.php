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

        $this->addElementPrefixPath(
                'My_Form_Decorator', APPLICATION_PATH . '/forms/Decorator/', 'decorator'
        );

        $this->setMethod('post');

        $this->setAttrib('id', 'main-search-form');


        $cities = My_Model_Table_Accommodation::getDistinctCities();

        $citiesOption = array();

        /* @var $addrRow My_Model_Table_Row_Address */
        foreach ($cities as $city) {
            $citiesOption[$city['city_id']] = $city['name'];
        }

        $cities = new Zend_Form_Element_Select('i_city');
        $cities->addMultiOptions($citiesOption);
        $cities->setLabel('I need accommodation in');
        $cities->setValue('Wroclaw');
        $cities->setRequired(true);
        $this->addElement($cities);


        // add element
        $maxPrice = new Zend_Form_Element_Select('maxprice');
        $maxPrice->setLabel(' for less than ');
        // $maxPrice->setAttrib('id', 'paxprice-select');

        $priceOptions = array();
        //$priceOptions["0"] = "less than";

        for ($p = 200; $p <= 2000; $p+=100) {
            $priceOptions[$p] = (string) $p;
        }

        $maxPrice->addMultiOptions(array($priceOptions));
        $maxPrice->setRequired(true);
        $maxPrice->setValue('1000');
        $maxPrice->addDecorator('AnyMarkup', array(
            'markup' => '<span>PLN</span>',
            'placement' => 'append'
                        )
        );
        $this->addElement($maxPrice);
        
        $this->addElement('hidden', 'id', 2);

        $submit = $this->createElement('submit', 'submit', array('label' => 'Go'));
        $submit->removeDecorator('Label');
        $this->addElement($submit);
    }

}

?>
