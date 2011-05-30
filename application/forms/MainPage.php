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

//        $acctype =  new Zend_Form_Element_Select('acctype');
//        $acctype->addMultiOptions(array(
//            '1' => 'place in a room',
//            '2' => 'room',
//            '3' => 'appartment'
//        ));
//     //   $acctype->setLabel('I need');
//        //$acctype->setValue('2');      
//       // $this->addElement($acctype);

        $cities = My_Model_Table_Accommodation::getDistinctCities();

        $citiesOption = array();
        
        /* @var $addrRow My_Model_Table_Row_Address */
        foreach ($cities as $city) {
            $citiesOption[$city['city_id']] = $city['name'];
        }

        $cities = new Zend_Form_Element_Select('i_city');
        $cities->addMultiOptions($citiesOption);
        $cities->setLabel('I need accommodation in');
        $cities->setValue('156'); //156 is and id of Wroclaw
       // $cities->setRequired(true);
        $this->addElement($cities);


        // add element
        $maxPrice = new Zend_Form_Element_Select('maxprice');
        $maxPrice->setLabel(' for max ');
        // $maxPrice->setAttrib('id', 'paxprice-select');

        $priceOptions = array();
        //$priceOptions["0"] = "less than";

        for ($p = 200; $p <= 1000; $p+=100) {
            $priceOptions[$p] = (string) $p;
        }
        
         for ($p = 1200; $p <= 2000; $p+=200) {
            $priceOptions[$p] = (string) $p;
        }
        
          for ($p = 2500; $p <= 3000; $p+=500) {
            $priceOptions[$p] = (string) $p;
        }

        $maxPrice->addMultiOptions(array($priceOptions));
       // $maxPrice->setRequired(true);
        $maxPrice->setValue('1000');
        $maxPrice->addDecorator('AnyMarkup', array(
            'markup' => '<span>PLN</span>',
            'placement' => 'append'
                )
        );
        $this->addElement($maxPrice);

        $submit = $this->createElement('submit', 'submit', array('label' => 'Go'));
        $submit->setAttrib('id', 'main-page-submit');
        $submit->removeDecorator('Label');
        $this->addElement($submit);
        
//        $data = array(
//            'renditaImpianti' => 12,
//            'renditaAggiunte' => 32
//        );
//        
//        $t = new My_Form_Element_TabellaRendite('somename', array('modificabile' =>'1'));
//        $t->setValue($data);        
//        
//        $this->addElement($t);

        
        
    }

}

?>
