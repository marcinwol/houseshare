<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Form_AddAccommodation
 * @todo Make Add Accomodation Abstract and dependant forms.
 * @author marcin
 */
abstract class My_Form_Abstract_AccommodationAbstract extends Zend_Form {

    public function init() {
        $this->setMethod('post');       
    }

    protected function makeAccBasicDescSubForm() {
        $accInfoSubForm = new Zend_Form_SubForm();
        $accInfoSubForm->setLegend('Basic description');


        // add element
        $accTypeChoice = new Zend_Form_Element_Select('acc_type');
        $accTypeChoice->setLabel('Accommodation type');
        $accTypeChoice->addMultiOptions(
                array(
                    '0' => "Room",
                    '1' => "Bed",
                )
        );
        $accTypeChoice->setRequired(true);
        $accTypeChoice->setValue('0');


        // create new element
        $titleInput = $this->createElement('text', 'name');
        $titleInput->setRequired(true)->setLabel('Title');
        $titleInput->setFilters(array('stripTags','stringTrim'));

         // create new element
        $descriptionInput = $this->createElement('textarea', 'description');
        $descriptionInput->setRequired(true)->setLabel('Advertisment description');
        $descriptionInput->setFilters(array('stripTags','stringTrim'));
        $descriptionInput->setAttribs(array('cols' => 20,'rows' => 5));

         // create new element
        $dateAvaliableInput = $this->createElement('text', 'date_avaliable');
        $dateAvaliableInput->setRequired(true);
        $dateAvaliableInput-> setLabel('Avaliable from (dd/mm/yyyy)');
        $dateAvaliableInput->setFilters(array('stripTags','stringTrim'));
        $dateAvaliableInput->addValidator('date',
                array('format'=>'dd/MM/yyyy')
                );

         // create new element
        $priceInput = $this->createElement('text', 'price');
        $priceInput->setRequired(true);
        $priceInput-> setLabel('Price per month (e.g. 300)');
        $priceInput->setFilters(array('stripTags','stringTrim'));
        $priceInput->addValidator('int');

        

        $accInfoSubForm->addElements(array(
                    $accTypeChoice, $titleInput, $descriptionInput,
                    $dateAvaliableInput, $priceInput)
                );

        return $accInfoSubForm;
    }

}
?>
