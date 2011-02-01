<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class My_Filter_Identical implements Zend_Filter_Interface {

    /**
     * Token with witch input is compared.
     *
     * @var string
     */
    protected $_token;

    /**
     * Set token
     *
     * @param  string
     * @return void
     */
    public function __construct($token = '') {
        $this->_token = $token;
    }

    /**
     *
     * @param string $value value of input filed
     * @return string
     */
    public function filter($value) {

        if ($value !== $this->_token) {
            return $value;
        }

        return '';
    }

}

?>
