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
        $basicSubFrm = $this->makeAccBasicDescSubForm();
        $this->addSubForm($basicSubFrm,'sf_basic_info');
    }

    protected function makeAccBasicDescSubForm() {
        $accInfoSubForm = new Zend_Form_SubForm();
        $accInfoSubForm->setLegend('Description');

        // create new element
        $titleInput = $this->createElement('text', 'name');
        $titleInput->setRequired(true)->setLabel('Title');
        $titleInput->setFilters(array('stripTags','stringTrim'));

        //@todo Add more elements.

        $accInfoSubForm->addElements(array($titleInput));
        return $accInfoSubForm;
    }

}
?>
