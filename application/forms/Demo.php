<?php


class My_Form_Demo extends Zend_Form {

    public function init() {
        $this
            ->setMethod('post');

        $this
        ->addElement('text', 'username', array(
            'label' => 'USERNAME',
            'required' => true,
            'value' => '',
            'filters'    => array('StringTrim'),
            'decorators' => array('ViewHelper')
            ))
        ->addElement('password', 'password', array(
            'label' => 'PASSWORD',
            'required' => true,
            'value' => '',
            'decorators' => array('ViewHelper')
            ))
        ->addElement('submit', 'submit', array(
            'label' => 'LOG_INTO',
            'ignore' => true,
            ));
    }

}

?>
