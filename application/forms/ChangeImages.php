<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChangeImages
 *
 * @author marcin
 */
class My_Form_ChangeImages extends Zend_Form {

    protected $_images = array();

    public function init2() {

        $checkBoxes = $this->_makeMultiImgMultiOptions();

        $images = new Zend_Form_Element_MultiCheckbox('images',
                        array(
                            'multiOptions' => $checkBoxes,
                            'escape' => false
                        )
        );


        $cancel = new Zend_Form_Element_Submit('cancel', 'Cancel');
        
        if (count($checkBoxes) > 0) {
            $this->addElements(array($images));
            $delete = new Zend_Form_Element_Submit('delete', 'Delete');
            $this->addElement($delete);
//            $change = new Zend_Form_Element_Submit('change', 'Change');
//            $this->addElement($change);
        }
                
        if (count($checkBoxes) < 3) {
            $add = new Zend_Form_Element_Submit('add', 'Add');
            $this->addElement($add);
        } 
        
        $this->addElement($cancel);
    }

    public function setImages(array $imgs) {
        $this->_images = $imgs;
    }

    protected function _makeMultiImgMultiOptions() {

        $opts = array();

        foreach ($this->_images as $photo_id => $url) {
            $opts[$photo_id] = '<img src="' . $url . '" alt="photo" />';
        }

        return $opts;
    }

}

?>
