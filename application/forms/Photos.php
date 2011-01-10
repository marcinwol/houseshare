<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Photos
 *
 * @author marcin
 */
class My_Form_Photos extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->_makeElements();
    }

    protected function _makeElements() {
        $photos = new Zend_Form_Element_File('photo');
        $photos->setLabel('Upload image: ');

        $photos->setDestination(PHOTOS_PATH);
        //$element->addValidator('Count', false, 1);

        // limit to 1M     
        $photos->addValidator('Size', false, 1024000);
        $photos->addValidator('Extension', false, 'jpg,png,gif');
        $photos->addValidator('IsImage', false);
        $photos->setMultiFile(3);
        
        // photos will be reveived manualy
        $photos->setValueDisabled(true);
        
        $this->addElements(array($photos));
        $this->addElement('submit', 'Submit');
    }

}

?>
