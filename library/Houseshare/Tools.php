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

}
?>
