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

    protected $_noOfPhotos;
    
      /**
     * Constructor
     *
     * Registers form view helper as decorator
     *
     * @param mixed $options
     * @return void
     */
    public function __construct($noOfPhotos = 3, $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        } elseif ($options instanceof Zend_Config) {
            $this->setConfig($options);
        }
        
        $this->_noOfPhotos = $noOfPhotos;

        // Extensions...
        $this->init();

        $this->loadDefaultDecorators();
    }

    
    
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
        // $photos->setMaxFileSize(1024000);
        $photos->addValidator('Extension', false, 'jpg,png,gif');
       // $photos->addValidator('IsImage', false);
        $photos->setMultiFile($this->_noOfPhotos);

        if ('testing' === APPLICATION_ENV) {
            // for unit tests we need to disable these validatoras.
            $photos->removeValidator('upload');
            $photos->removeValidator('IsImage');
            $photos->removeValidator('Extension');
        }

        // photos will be reveived manualy
        $photos->setValueDisabled(true);

        $this->addElements(array($photos));
        $this->addElement('submit', 'Submit');
        $skipButton = new Zend_Form_Element_Submit('skip', 'Skip');
        $this->addElement($skipButton);
    }

}

?>
