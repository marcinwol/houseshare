<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * My set of various methods that may be handy.
 *
 * @author marcin
 */
class My_Houseshare_Tools {
    
    /**
     * Add DIRECTORY_SEPARATOR to the end of string if not there.
     * 
     * @param string $str input string
     * @return string  
     */
    static function addDirSeperator($str) {

        if ($str[strlen($str)-1] !== DIRECTORY_SEPARATOR) {
            $str .= DIRECTORY_SEPARATOR;
        }

        return $str;
    }

    /**
     * Get values of econd level (SL) arrays of 2D array.
     *
     * @param array $data
     * @param string $key key in SL arrays.
     * @return array values in SL array with $key
     */
    static function getSLValsInArray(array $data, $key) {
        $vals = array();

        foreach ($data as $k => $d) {
            $vals [] = $d[$key];
        }

        return $vals;
    }

}
?>
