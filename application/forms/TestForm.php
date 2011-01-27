<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class My_Form_TestForm extends Zend_Form {

    public function init() {

        $file = new Zend_Form_Element_File('file');
        $file->setDestination(PHOTO_DIR_NAME);
        $file->addValidator('Size', false, 10000000);
        $file->setMaxFileSize(10000000);
        $this->addElement($file);

//        $hash = new Zend_Form_Element_Hash('hash');
//        $hash->setIgnore(true)
//                ->setSalt('mysalt');
//        $this->addElement($hash);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Test')
                ->setIgnore(true);
        $this->addElement($submit);

        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setMethod('post');
    }

}

?>
